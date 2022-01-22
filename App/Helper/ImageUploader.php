<?php

namespace App\Helper;

use App\Model\Image;
use App\Model\Repository\Image as ImageRepository;
use Bulletproof\Image as BulletproofImage;

class ImageUploader
{
    const IMAGE_DIR = '/media';
    const IMAGE_PERMISSION = 0777;

    /**
     * @param $imgName
     * @return BulletproofImage|false
     * @throws \Exception
     */
    public static function uploadImage($imgName)
    {
        if (!isset($_FILES[$imgName])) {
            return false;
        }

        $image = new BulletproofImage($_FILES[$imgName]);
        $image->setLocation($_SERVER['DOCUMENT_ROOT'] . self::IMAGE_DIR, self::IMAGE_PERMISSION);

        $upload = $image->upload();

        if ($upload) {
            return $upload;
        } else {
            throw new \Exception($image->getError());
        }
    }

    /**
     * @param $imageId
     * @param $fileName
     * @param $title
     * @param $alt
     * @return int|mixed|string
     * @throws \Exception
     */
    public static function uploadAndSaveImage($imageId, $fileName, $title, $alt)
    {
        $isNew = false;
        $image = ImageRepository::getImageById($imageId);
        if (!$image) {
            $image = new Image();
            $isNew = true;
        }

        $image->setTitle($title);
        $image->setAlt($alt);

        if (isset($_FILES[$fileName]) && $_FILES[$fileName]['size'] > 0) {
            $uploadedImage = ImageUploader::uploadImage($fileName);

            if ($uploadedImage) {
                $path = substr($uploadedImage->getFullPath(), strlen($_SERVER['DOCUMENT_ROOT']));

                $image->setValue($path);
            }
        }

        if ($isNew) {
            return ImageRepository::addImage($image);
        }

        ImageRepository::updateImage($image, $image->getId());
        return $image->getId();
    }
}