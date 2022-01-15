<?php

namespace App\Model\Helper;

use Bulletproof\Image;

class ImageUploader
{
    const IMAGE_DIR = '/media';
    const IMAGE_PERMISSION = 0777;

    /**
     * @param $imgName
     * @return Image|false
     * @throws \Exception
     */
    public static function uploadImage($imgName)
    {
        if (!isset($_FILES[$imgName])) {
            return false;
        }

        $image = new Image($_FILES[$imgName]);
        $image->setLocation($_SERVER['DOCUMENT_ROOT'] . self::IMAGE_DIR, self::IMAGE_PERMISSION);

        $upload = $image->upload();

        if ($upload) {
            return $upload;
        } else {
            throw new \Exception($image->getError());
        }
    }
}