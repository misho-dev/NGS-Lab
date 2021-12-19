<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Index implements ControllerAction
{
    public function execute()
    {
        $users = UserRepository::getUsers();
        View::render('admin/user-list.phtml', compact('users'));
    }
}
