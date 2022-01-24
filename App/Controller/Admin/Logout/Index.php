<?php

namespace App\Controller\Admin\Logout;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\AdminSession;
use App\Helper\Url;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    public function execute()
    {
        AdminSession::reset();
        Url::redirect('/admin');
    }
}
