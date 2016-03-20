<?php
class Controller_404 extends Controller
{
    public function __construct()
    {
        $this->view = new View();
    }

    public function action_index()
    {
        $this->view->generate("home/404_view.php", "home/index.php");
    }
}