<?php

require_once("interface/iview.php");

class View implements IView
{
    public function generate($content_view, $template_view, $data = null)
    {
        $file_path = "application/views/" . $template_view;

        if(file_exists($file_path))
        {
            include($file_path);
        }
    }
}