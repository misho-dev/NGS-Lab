<?php

namespace App\Controller\Admin\Login;

use App\Controller\ControllerAction;
use App\ViewModel\View;

class Login implements ControllerAction
{
    public function execute()
    {
        View::render('admin/login.phtml');
    }
}