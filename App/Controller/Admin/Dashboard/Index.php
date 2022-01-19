<?php

namespace App\Controller\Admin\Dashboard;

use App\ViewModel\View;
use App\Controller\Admin\AbstractAdminAction;

class Index extends AbstractAdminAction
{
    public function execute()
    {
        View::render('admin/dashboard.phtml');
    }
}