<?php

namespace App\Controller\Admin\Administrator;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Administrator as AdministratorRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    public function execute()
    {
        $administrator = AdministratorRepository::getAdministratorById($_GET['id']);
        if (!$administrator){
            throw new \Exception('Administrator with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            View::render('admin/administrator-edit.phtml', compact('administrator'));
        }
    }
}
