<?php

namespace App\Controller\Admin\Login;

use App\Controller\ControllerAction;
use App\ViewModel\View;

class Index implements ControllerAction
{
    public function execute()
    {
        View::render('admin/login.phtml');
    }
}
