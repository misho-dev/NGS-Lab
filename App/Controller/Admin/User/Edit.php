<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit implements ControllerAction
{
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
