<?php
namespace App\ViewModel;

class View
{
    public static function render($page, array $params = [])
    {
        extract($params, EXTR_SKIP);
        require_once "templates/pages/$page";
    }

    public static function renderComponent($component, array $params = [])
    {
        extract($params, EXTR_SKIP);
        require "templates/componenetns/$component";
    }
}
