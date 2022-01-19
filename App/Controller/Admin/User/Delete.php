<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Repository\User as UserRepository;

class Delete extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        UserRepository::deleteUser($_GET['id']);
        UrlHelper::redirect("/admin/user");
    }
}
