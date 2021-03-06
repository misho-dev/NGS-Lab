<?php

namespace App\Controller\Admin\Administrator;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Repository\Administrator as AdministratorRepository;

class Delete extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_ADMIN;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        AdministratorRepository::deleteAdministrator($_GET['id']);
        UrlHelper::redirect("/admin/administrator");
    }
}
