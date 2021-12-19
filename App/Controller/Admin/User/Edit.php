<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit implements ControllerAction
{

    public function execute()
    {
        $user_id = $_GET['id'];
        $user = UserRepository::getUserById($user_id);
        if (!$user){
            //TODO: Invalid
            View::render('invalid.phtml');
            die('hard');
        } else {
            View::render('admin/user-edit.phtml', compact('user'));
        }
    }
}
