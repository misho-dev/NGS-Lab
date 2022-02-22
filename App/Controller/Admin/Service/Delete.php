<?php

namespace App\Controller\Admin\Service;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url;
use App\Model\Repository\Service;

class Delete extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_SERVICE;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        Service::deleteService($_GET['id']);
        Url::redirect("/admin/service");
    }
}
