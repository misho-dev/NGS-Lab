<?php

namespace App\Controller\Admin\Service;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ImageUploader;
use App\Helper\Url;
use App\Model\Repository\Service as ServiceRepository;

class Upload extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_SERVICE;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $service = ServiceRepository::getServiceById($_GET['id']);
        if (!$service) {
            throw new \Exception('Service with given ID (' . $_GET['id'] . ') does not exist');
        }

        $this->uploadImage();

        Url::redirect('/admin/service/edit?id=' . $_GET['id']);
    }

    /**
     * @throws \Exception
     */
    protected function uploadImage()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['service_pic_id'],
            'service_pic',
            $_POST['service_pic_title'],
            $_POST['service_pic_alt']
        );

        if ($imageId) {
            ServiceRepository::updateImage($imageId, $_GET['id']);
        }
    }
}
