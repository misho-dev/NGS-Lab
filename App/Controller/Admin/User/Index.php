<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $users = UserRepository::getUsers();
        View::render('admin/user-list.phtml', compact('users'));
    }
}
