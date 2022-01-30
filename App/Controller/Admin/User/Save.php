<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\User as UserModel;
use App\Model\Repository\User as UserRepository;

class Save extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $user = $this->createUserFromPostRequest();

        if (isset($_POST['create_user'])) {
            $userId = UserRepository::addUser($user);
            UserRepository::setProjects($userId, $_POST['projects'] ?? []);
        } else if (isset($_POST['update_user']) && $_GET['id']) {
            UserRepository::updateUser($user, $_GET['id']);
            UserRepository::setProjects($_GET['id'], $_POST['projects'] ?? []);
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
            'position' => $_POST['position'],
            'meta_title' => $_POST['meta_title'],
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],
            'socials' => [
                'facebook' => $_POST['social_fb'],
                'instagram' => $_POST['social_ig'],
                'linkedin' => $_POST['social_in'],
            ],
            'is_owner' => $_POST['is_owner'] == 'on',
        ]);
    }
}
