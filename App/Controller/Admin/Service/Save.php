<?php

namespace App\Controller\Admin\Service;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Service as ServiceModel;
use App\Model\Repository\Service as ServiceRepository;

class Save extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_SERVICE;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $service = $this->createServiceFromPostRequest();

        if (isset($_POST['create_service'])) {
            ServiceRepository::addService($service);
        } else if (isset($_POST['update_service']) && $_GET['id']) {
            ServiceRepository::updateService($service, $_GET['id']);
        } else {
            throw new \Exception('Unexpected error occurred. Please try again.');
        }

        UrlHelper::redirect("/admin/service");
    }

    protected function createServiceFromPostRequest()
    {
        return new ServiceModel([
            'title' => $_POST['title'],
            'title_ka' => $_POST['title_ka'],
        ]);
    }
}
