<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    public function execute()
    {
        $user = UserRepository::getUserById($_GET['id']);
        if (!$user){
            throw new \Exception('User with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            View::render('admin/user-edit.phtml', compact('user'));
        }
    }
}
