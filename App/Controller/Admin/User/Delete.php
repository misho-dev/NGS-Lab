<?php

namespace App\Controller\Admin\User;

use App\Controller\ControllerAction;
use App\Model\Helper\Url as UrlHelper;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Delete implements ControllerAction
{
    public function execute()
    {
        UserRepository::deleteUser($_GET['id']);
        UrlHelper::redirect("/admin/user");
    }
}
