<?php

require_once("interface/iconfig.php");

class Config implements IConfig
{
    public $config = array();

    public function __construct($file_config)
    {
        $this->config = self::getConfig($file_config);
    }

    private function getConfig($file)
    {
        try{
            $file_json = file_get_contents(dirname(dirname(__FILE__)) .
                DIRECTORY_SEPARATOR . "config" .
                DIRECTORY_SEPARATOR . $file . ".json");

            $decode_json = json_decode($file_json, true);
            return $decode_json;
        }
        catch(ErrorException $e){
            die("Parse JSON ERROR: ".$e->getMessage());
        }
    }
}