<?php

namespace App\Controller\Admin\Service;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Service as ServiceRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_SERVICE;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $services = ServiceRepository::getServices();
        View::render('admin/service-list.phtml', compact('services'));
    }
}
