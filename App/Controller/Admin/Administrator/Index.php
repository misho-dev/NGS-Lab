<?php

namespace App\Controller\Admin\Administrator;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Administrator as AdministratorRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_ADMIN;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $administrators = AdministratorRepository::getAdministrators();
        View::render('admin/administrator-list.phtml', compact('administrators'));
    }
}
