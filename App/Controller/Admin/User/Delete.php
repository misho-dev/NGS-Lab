<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Helper\Url as UrlHelper;
use App\Model\Repository\User as UserRepository;

class Delete implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        UserRepository::deleteUser($_GET['id']);
        UrlHelper::redirect("/admin/user");
    }
}
