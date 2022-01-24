<?php

namespace App\Controller\Admin\Login;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\AdminSession;
use App\Helper\Url;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    public function execute()
    {
        if (AdminSession::isLoggedIn()) {
            Url::redirect('/admin');
        } else {
            View::render('admin/login.phtml');
        }
    }
}
