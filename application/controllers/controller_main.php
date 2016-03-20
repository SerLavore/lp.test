<?php
class Controller_Main extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Model_Main();
        $this->view = new View();
    }

    public function action_index()
    {
        parent::action_index();
        $data = $this->model->get_data();

        $this->view->generate("home/main_view.php", "home/index.php", $data);
    }
}