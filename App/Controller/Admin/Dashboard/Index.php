<?php

namespace App\Controller\Admin\Dashboard;

use App\ViewModel\View;
use App\Controller\ControllerAction;

class Index implements ControllerAction
{
    public function execute()
    {
        View::render('admin/dashboard.html');
    }
}