<?php

class Route
{

    public function __construct()
    {
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        $mobile = strpos($_SERVER['HTTP_USER_AGENT'],"Mobile");
        $symb = strpos($_SERVER['HTTP_USER_AGENT'],"Symbian");
        $operam = strpos($_SERVER['HTTP_USER_AGENT'],"Opera M");
        $htc = strpos($_SERVER['HTTP_USER_AGENT'],"HTC_");
        $fennec = strpos($_SERVER['HTTP_USER_AGENT'],"Fennec/");
        $winphone = strpos($_SERVER['HTTP_USER_AGENT'],"WindowsPhone");
        $wp7 = strpos($_SERVER['HTTP_USER_AGENT'],"WP7");
        $wp8 = strpos($_SERVER['HTTP_USER_AGENT'],"WP8");
        if ( $iphone
            || $android
            || $palmpre
            || $ipod
            || $berry
            || $mobile
            || $symb
            || $operam
            || $htc
            || $fennec
            || $winphone
            || $wp7
            || $wp8 === true)
        {
            header('Location: http://m.lp.test/');
        }
    }

    public static function Start()
    {

        $controller = "Main";
        $action = "index";
        $params = array();

        if($_SERVER['REQUEST_URI'] == '/')
        {
            try
            {
                $model = "Model_".ucfirst($controller);
                $controller = "Controller_".ucfirst($controller);
                $action = "action_".ucfirst($action);

                self::incFile($model, "application/models/");
                self::incFile($controller, "application/controllers/");

                self::actFile($controller, $action);

            }
            catch(Exception $e)
            {

            }
        }

        if($_SERVER['REQUEST_URI'] != '/')
        {
            try
            {
                $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                $url_path = explode('/', trim($url_path, ' /'));

                if (count($url_path) % 2 && count($url_path) != 1) {
                    self::ErrorPage404();
                    exit();
                }

                $controller = array_shift($url_path);
                $action = array_shift($url_path);

                for ($i = 0; $i < count($url_path); $i++) {
                    $params[$url_path[$i]] = $url_path[++$i];
                }

                $_REQUEST = array_merge($_REQUEST, $params);

                $model = "Model_".ucfirst($controller);
                $controller = "Controller_".ucfirst($controller);
                if(empty($action)) $action = "index";
                $action = "action_".$action;

                self::incFile($model, "application/models/");
                self::incFile($controller, "application/controllers/");

                self::actFile($controller, $action);

            }
            catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    private static function incFile($name, $source_path)
    {
        $file = strtolower($name).'.php';
        $path = $source_path.$file;
        if(file_exists($path))
        {
            include $path;
        }
    }

    private static function actFile($controller, $action)
    {


        if(method_exists($controller, $action))
        {
            $controller = new $controller;
            $controller->$action();
        }
        else
        {
            self::ErrorPage404();
        }
    }

    private static function ErrorPage404()
    {
        $controller = "Controller_404";
        self::incFile($controller, "application/controllers/");

        $controller = new $controller;
        $controller->action_index();
    }
}