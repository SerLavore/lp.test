<?php
class Controller_Catalog extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->model = new Model_Catalog();
        $this->view = new View();
    }

    public function action_index()
    {
        parent::action_index();
        $data = $this->model->get_data();

        $this->view->generate("home/catalog_view.php", "home/index.php", $data);
    }
}