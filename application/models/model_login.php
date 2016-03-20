<?php
class Model_Login extends Model
{

    public function __construct()
    {

    }

    public function get_data(array $arr = null)
    {
        $auth = $this->query("SELECT lp_login, name, lp_password FROM lp_admins WHERE lp_password = ?", false, $arr);

        return array(
            "auth" => $auth,
        );
    }

}