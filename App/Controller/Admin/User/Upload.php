<?php

namespace App\Controller\Admin\User;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ImageUploader;
use App\Helper\Url;
use App\Model\Repository\User as UserRepository;

class Upload extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_USER;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $user = UserRepository::getUserById($_GET['id']);
        if (!$user) {
            throw new \Exception('User with given ID (' . $_GET['id'] . ') does not exist');
        }

        $image = ImageUploader::uploadImage('user_pic');
        $path = substr($image->getFullPath(), strlen($_SERVER['DOCUMENT_ROOT']));
        UserRepository::updateImage($path, $_GET['id']);

        if ($user->getImage()) {
            $oldImage = $_SERVER['DOCUMENT_ROOT'] . $user->getImage();
            if (is_file($oldImage)) {
                unlink($oldImage);
            }
        }

        Url::redirect('/admin/user/edit?id=' . $_GET['id']);
    }
}
