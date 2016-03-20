<?php
class Model_Main extends Model
{

    public function __construct()
    {

    }

    public function get_data(array $arr = null)
    {
        $link = $this->query("SELECT * FROM pages");

        return array(
            "link" => $link,
        );
    }

}