<?php
class Controller_Login extends Controller
{
    public function __construct()
    {
        session_start();
        $this->model = new Model_Login();
        $this->view = new View();
        $this->config = new Config("error_config");
    }

    public function action_index()
    {
        if(isset($_SESSION["pswd_lp"])) unset($_SESSION["pswd_lp"]);
        $this->view->generate("admin/login_view.php", "admin/hid_template.php");
    }

    public function action_auth()
    {
            try
            {

                if(empty($_POST["lp_login"]) || empty($_POST["lp_pswd"]))
                    throw new Exception($this->config->config{"DATA_EMPTY_ERROR"});

                $login = trim($_POST["lp_login"]);
                $pswd = trim($_POST["lp_pswd"]);
                $pre = "lpdp";

                if($this->checkLogin($login) && $this->checkPassword($pswd))
                {
                    $data = $this->model->get_data(array(md5(md5(trim($pre . $pswd)))));

                    if(md5(md5(trim($pre . $pswd))) === addslashes($data["auth"]["lp_password"]) &
                        strtolower($login) === addslashes(strtolower($data["auth"]["lp_login"])))
                    {
                        $_SESSION["adm_lp"] = strtolower($login);
                        $_SESSION["name_lp"] = $data["auth"]["name"];
                        $_SESSION["pswd_lp"] = md5(md5(trim($pre . $pswd)));
                        echo true;
                    }
                    else throw new Exception($this->config->config{"ERROR_LOGIN"});
                }
                else throw new Exception($this->config->config{"DATA_VALIDATION_ERROR"});
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }
}