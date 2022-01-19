<?php

namespace App\Controller\Admin\Administrator;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ImageUploader;
use App\Helper\Url;
use App\Model\Repository\Administrator as AdministratorRepository;

class Upload extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_ADMIN;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $administrator = AdministratorRepository::getAdministratorById($_GET['id']);
        if (!$administrator) {
            throw new \Exception('Administrator with given ID (' . $_GET['id'] . ') does not exist');
        }

        $image = ImageUploader::uploadImage('administrator_pic');
        $path = substr($image->getFullPath(), strlen($_SERVER['DOCUMENT_ROOT']));
        AdministratorRepository::updateImage($path, $_GET['id']);

        if ($administrator->getImage()) {
            $oldImage = $_SERVER['DOCUMENT_ROOT'] . $administrator->getImage();
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
        }

        Url::redirect('/admin/administrator/edit?id=' . $_GET['id']);
    }
}
