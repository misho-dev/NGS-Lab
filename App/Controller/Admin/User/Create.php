<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\User;
use App\ViewModel\View;

class Create extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    public function execute()
    {
        $user = new User();
        View::render('admin/user-edit.phtml', compact('user'));
    }
}