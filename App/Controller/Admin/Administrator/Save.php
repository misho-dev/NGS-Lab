<?php

namespace App\Controller\Admin\Administrator;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Administrator as AdministratorModel;
use App\Model\Repository\Administrator as AdministratorRepository;

class Save extends AbstractAdminAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $administrator = $this->createAdministratorFromPostRequest();

        if (isset($_POST['create_administrator'])) {
            AdministratorRepository::addAdministrator($administrator);
        } else if (isset($_POST['update_administrator']) && $_GET['id']) {
            AdministratorRepository::updateAdministrator($administrator, $_GET['id']);
        } else {
            throw new \Exception('Unexpected error occurred. Please try again.');
        }

        UrlHelper::redirect("/admin/administrator");
    }

    protected function createAdministratorFromPostRequest()
    {
        $admin = new AdministratorModel(['username' => $_POST['username'],]);

        $admin->setPermissions([
            $_POST['permission_user'] == 'on' ? AbstractAdminAction::PERMISSION_USER : '',
            $_POST['permission_product'] == 'on' ? AbstractAdminAction::PERMISSION_PRODUCT : '',
            $_POST['permission_project'] == 'on' ? AbstractAdminAction::PERMISSION_PROJECT : '',
            $_POST['permission_blog'] == 'on' ? AbstractAdminAction::PERMISSION_BLOG : '',
        ]);

        if ($_POST['password']) {
            $admin->setPassword($_POST['password']);
        }

        return $admin;
    }
}
