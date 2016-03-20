<?php

require_once("interface/icontroller.php");

class Controller implements IController
{
    public $model;
    public $view;
    public $config;

    public function __construct()
    {
        $this->setStatCookie("visit", 24);
        $this->setStatCookie("userhash", 0x6FFFFFFF, uniqid());
        $this->view = new View();
        $this->model = new Model();
    }

    public function action_index()
    {
        self::StatCookie();
    }

    /* CHECKERS */

    protected function checkLogin($login)
    {
        $login = trim($login);
        $login = htmlspecialchars($login);
        $login = strtolower($login);

        if(!preg_match("/^[a-z0-9_-]{3,16}$/",$login))
            return false;
        else
            return true;
    }

    protected function checkPassword($pswd)
    {
        $pswd = trim($pswd);
        $pswd = htmlspecialchars($pswd);

        if(!preg_match('/^[A-Za-z0-9_]{5,20}$/', $pswd))
            return false;
        else
            return true;
    }

    /* END CHECKERS */

    public function setStatCookie($name, $die_time, $val = null)
    {
        if($val)
        {
            if(!isset($_COOKIE[$name]))
            {
                $_COOKIE[$name] = $val;
                setcookie($name, $val, $die_time);
            }
        }

        if(!$val)
        {
            if(!isset($_COOKIE[$name]))
            {
                setcookie($name, 1, time() + $die_time);
                $_COOKIE[$name] = 1;
                setcookie($name, 1, time() + $die_time);
            }else $_COOKIE[$name] = 0;
        }
    }

    protected function StatCookie()
    {
        if($_COOKIE["visit"] == 1)
        {
            $this->model->updateData("lp_visit_statistic",
                array("today", "yesterday", "month", "total"),
                array($_COOKIE["visit"],$_COOKIE["visit"],$_COOKIE["visit"],$_COOKIE["visit"], 1), true ,"id");
        }
    }
}



