<?php

namespace App\Controller\Admin\Logout;

use App\Controller\ControllerAction;
use App\Model\Helper\Url;
use App\ViewModel\View;

class Index implements ControllerAction
{
    public function execute()
    {
        unset($_SESSION['admin']);
        Url::redirect('/admin');
    }
}
