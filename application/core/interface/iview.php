<?php
interface IView
{
    public function generate($content_view, $template_view, $data = null);
}