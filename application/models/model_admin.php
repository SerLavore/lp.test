<?php
class Model_Admin extends Model
{

    public function __construct()
    {

    }

    public function get_data(array $arr = null)
    {
        $menu = $this->query("SELECT * FROM lp_admin_menu");
        $stat = $this->query("SELECT * FROM lp_visit_statistic");

        return array(
            "menu" => $menu,
            "visit" => $stat,
        );
    }

    public function get_updated_data(array $arr = null)
    {
        $stat = $this->query("SELECT * FROM lp_visit_statistic");

        return array(
            "visit" => $stat,
        );
    }

}