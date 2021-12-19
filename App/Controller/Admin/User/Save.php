<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\User as UserModel;
use App\Model\Repository\User as UserRepository;

class Save implements ControllerAction
{
    public function execute()
    {
        $user = new UserModel([
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
            die ('hard'); // TODO: What here?
        }
    }

    private function createUser($user)
    {
        UserRepository::addUser($user);
        $this->redirect("/admin/user");
    }

    private function updateUser($user)
    {
        UserRepository::updateUser($user, $_GET['id']);
        $this->redirect("/admin/user");
    }

    private function redirect(string $url)
    {
        ob_start();
        while (ob_get_status()) {
            ob_end_clean();
        }

        header("Location: $url");
    }
}