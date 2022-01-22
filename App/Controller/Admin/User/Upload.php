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

        $this->uploadImage();
        $this->uploadGif();

        Url::redirect('/admin/user/edit?id=' . $_GET['id']);
    }

    /**
     * @throws \Exception
     */
    protected function uploadImage()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['user_pic_id'],
            'user_pic',
            $_POST['user_pic_title'],
            $_POST['user_pic_alt']
        );

        if ($imageId) {
            UserRepository::updateImage($imageId, $_GET['id']);
        }
    }

    /**
     * @throws \Exception
     */
    protected function uploadGif()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['user_gif_id'],
            'user_gif',
            $_POST['user_gif_title'],
            $_POST['user_gif_alt']
        );

        if ($imageId) {
            UserRepository::updateGif($imageId, $_GET['id']);
        }
    }
}
