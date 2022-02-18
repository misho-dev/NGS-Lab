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
            UserRepository::setServices($userId, $_POST['services'] ?? []);
        } else if (isset($_POST['update_user']) && $_GET['id']) {
            UserRepository::updateUser($user, $_GET['id']);
            UserRepository::setProjects($_GET['id'], $_POST['projects'] ?? []);
            UserRepository::setServices($_GET['id'], $_POST['services'] ?? []);
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
            'full_name_ka' => $_POST['name_ka'],
            'description_ka' => $_POST['description_ka'],
            'short_description_ka' => $_POST['short_description_ka'],
            'position_ka' => $_POST['position_ka'],
            'meta_title' => $_POST['meta_title'],
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],
            'meta_title_ka' => $_POST['meta_title_ka'],
            'meta_keyword_ka' => $_POST['meta_keyword_ka'],
            'meta_description_ka' => $_POST['meta_description_ka'],
            'socials' => [
                'facebook' => $_POST['social_fb'],
                'instagram' => $_POST['social_ig'],
                'linkedin' => $_POST['social_in'],
            ],
            'is_owner' => $_POST['is_owner'] == 'on',
        ]);
    }
}
