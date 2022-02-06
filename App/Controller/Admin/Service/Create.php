<?php


namespace App\Controller\Admin\Service;


use App\Controller\Admin\AbstractAdminAction;
use App\Model\Service;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Create extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_SERVICE;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $service = new Service();
        View::render('admin/service-edit.phtml', compact('service'));
    }
}