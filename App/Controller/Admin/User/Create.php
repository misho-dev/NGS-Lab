<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\User;
use App\ViewModel\View;

class Create implements ControllerAction
{
    public function execute()
    {
        $user = new User([]);
        View::render('admin/user-edit.phtml', compact('user'));
    }
}