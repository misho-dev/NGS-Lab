<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Helper\Url as UrlHelper;
use App\Model\User as UserModel;
use App\Model\Repository\User as UserRepository;

class Save implements ControllerAction
{
    public function execute()
    {
        $user = new UserModel([
            'enabled' => $_POST['enabled'] == 'on',
            'full_name' => $_POST['name'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
            'is_owner' => $_POST['is_owner'] == 'on',
        ]);

        if (isset($_POST['create_user'])) {
            $this->createUser($user);
        } else if (isset($_POST['update_user']) && $_GET['id']) {
            $this->updateUser($user);
        } else {
            throw new Exception('Unexpected error occurred. Please try again.');
        }
    }

    private function createUser($user)
    {
        UserRepository::addUser($user);
        UrlHelper::redirect("/admin/user");
    }

    private function updateUser($user)
    {
        UserRepository::updateUser($user, $_GET['id']);
        UrlHelper::redirect("/admin/user");
    }
}