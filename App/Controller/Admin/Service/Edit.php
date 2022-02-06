<?php

namespace App\Controller\Admin\Service;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Image;
use App\Model\Repository\Service as ServiceRepository;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_SERVICE;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $service = ServiceRepository::getServiceById($_GET['id']);
        if (!$service){
            throw new \Exception('Service with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            $image = Image::getImageById($service->getImage());
            if (!$image) {
                $image = new \App\Model\Image();
            }

            View::render('admin/service-edit.phtml', compact('service', 'image'));
        }
    }
}
