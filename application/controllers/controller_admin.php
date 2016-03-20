<?php
class Controller_Admin extends Controller
{
    public function __construct()
    {
        session_start();
        parent::__construct();
        $this->view = new View();
        $this->model = new Model_Admin();
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
            parent::action_index();
            $data = $this->model->get_data();
            $this->view->generate("admin/admin_view.php", "admin/index.php", $data);
        }
    }

    public function action_stats()
    {
        //SHOULD DELETE PARENT AFTER TEST
        //parent::action_index();
        $u_stats = $this->model->get_updated_data();
        $response = '';

        $response .= '<tr>';
        $response .= '<td></td>';
        $response .= '<td class = "td-main">Сегодня</td>';
        $response .= '<td class = "td-main">Вчера</td>';
        $response .= '<td class = "td-main">Месяц</td>';
        $response .= '<td class = "td-main">Всего</td>';
        $response .= '</tr>';

        foreach($u_stats["visit"] as $visit)
        {
            $response .= '<tr>';
            $response .= '<td class = "td-main">' . $visit["name"] .'</td>';
            $response .= '<td>' . $visit["today"] .'</td>';
            $response .= '<td>' . $visit["yesterday"] .'</td>';
            $response .= '<td>' . $visit["month"] .'</td>';
            $response .= '<td>' . $visit["total"] .'</td>';
            $response .= '</tr>';
        }

        echo(json_encode($response));

    }

    public function action_logout()
    {
        unset($_SESSION["pswd_lp"], $_SESSION["adm_lp"], $_SESSION["name_lp"]);
        header('Location:/login');
    }
}