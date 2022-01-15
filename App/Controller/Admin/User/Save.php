<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Helper\Url as UrlHelper;
use App\Model\User as UserModel;
use App\Model\Repository\User as UserRepository;

class Save implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $user = $this->createUserFromPostRequest();

        if (isset($_POST['create_user'])) {
            UserRepository::addUser($user);
        } else if (isset($_POST['update_user']) && $_GET['id']) {
            UserRepository::updateUser($user, $_GET['id']);
        } else {
            throw new \Exception('Unexpected error occurred. Please try again.');
        }

        UrlHelper::redirect("/admin/user");
    }

    protected function createUserFromPostRequest()
    {
        return new UserModel([
            'enabled' => $_POST['enabled'] == 'on',
            'full_name' => $_POST['name'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
            'is_owner' => $_POST['is_owner'] == 'on',
        ]);
    }
}
