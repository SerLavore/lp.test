<?php
class Controller_Admin_Products extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->view = new View();
        $this->model = new Model_Admin_Products();
        $this->config = new Config("error_config");
    }

    public function action_index()
    {
        if(!isset($_SESSION["adm_lp"]) ||
            !isset($_SESSION["pswd_lp"]) ||
            !isset($_SESSION["name_lp"]))
        {
            header('Location:/login');
        }
        else
        {
            $data = $this->model->get_data();
            $this->view->generate("admin/products_view.php", "admin/index.php", $data);
        }
    }

    public function action_upload_images()
    {
        echo $_POST["files"];
    }

    public function action_delete()
    {
        $this->model->delete_product(array("id" => $_REQUEST["id"]));
        echo true;
    }

    public function action_update_element()
    {
        $main_data = $this->model->get_data_by_id($_GET["id"]);

        $response = '';


    }

    public function action_insert()
    {
        try
        {
            if(empty($_POST["name"]) ||
                empty($_POST["description"]) ||
                empty($_POST["meta_title"]) ||
                empty($_POST["meta_description"]) ||
                empty($_POST["category"]) ||
                empty($_POST["subcategory"]) ||
                empty($_POST["main_photo"])
            )
                    throw new Exception($this->config->config{"DATA_EMPTY_ERROR"});

            $main_photo = explode("/", $_POST["main_photo"]);
            $image = array_pop($main_photo);
            $name = trim(addslashes($_POST["name"]));
            $description = trim(addslashes($_POST["description"]));
            $title = trim(addslashes($_POST["meta_title"]));
            $meta_description = trim(addslashes($_POST["meta_description"]));

            if($this->model->insert_product(array($name, $description, $title, $meta_description, $_POST["category"], $_POST["subcategory"], $image, $_POST["secondary_photos"])))
                echo true;
            else throw new Exception($this->config->config{"DATA_ADD_ERROR"});
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function action_get_image_folder()
    {
        try
        {
            $images = $this->model->get_image_folder();
            if(!$images)
                throw new Exception($this->config->config{"DATA_DOWNLOAD_ERROR"});
            else
            {
                $response = "";

                foreach($images["imgs"] as $imgs)
                {
                    $response .= '<td>';
                    $response .= '<div class = "selected_images choose_img">';
                    $response .= '<span class = "select_element"><img src="/content/images/ok-white.png"/></span>';
                    $response .= '<img src="'.$imgs["path"].'" class = "img_fldr"/>';
                    $response .= '<input type = "hidden" name = "id" value = "' .$imgs["id"]. '" class = "img_folder_id"/>';
                    $response .= '<input type = "hidden" name = "arr_el" value = "" class = "arr_el"/>';
                    $response .= '</div>';
                    $response .= '</td>';
                }

                echo(json_encode($response));
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function action_add_subcat()
    {
        try
        {
            if(isset($_GET["option"]) && !empty($_GET["option"]))
            {

                $data = $this->model->get_subcategory($_GET["option"]);
                $response = '';

                foreach($data["subcat"] as $subcat)
                {
                    $response .= '<option value = '. $subcat["tag"] .'>' . $subcat["name"] . '</option>';
                }

                echo json_encode($response);
            }else throw new Exception($this->config->config{"CATEGORY_CHOOSE_ERROR"});
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }
}