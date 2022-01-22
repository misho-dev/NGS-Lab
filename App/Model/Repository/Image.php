<?php

namespace App\Model\Repository;

use App\Model\Image as ImageModel;
use App\Model\Database\DAL;
use App\Model\Repository\Product as ProductRepository;
use ClanCats\Hydrahon\Query\Sql\Exception as HydrahonException;
use Exception;

class Image
{
    const TABLE_NAME = 'image_entity';

    /**
     * @param string $id
     * @return ImageModel|null
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getImageById(string $id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $image = self::buildImagesFromQueryResult($result);
        if (!count($image)) {
            return null;
        }

        return $image[0];
    }

    /**
     * @param ImageModel $image
     * @return mixed
     * @throws Exception
     */
    public static function addImage(ImageModel $image)
    {
        $newImage = [
            'value' => $image->getValue(),
            'title' => $image->getTitle(),
            'alt' => $image->getAlt(),
            'type' => $image->getType(),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newImage)
            ->execute();
    }

    /**
     * @throws Exception
     */
    public static function updateImage(ImageModel $updatedImage, $imageId)
    {
        $oldImage = self::getImageById($imageId);

        $newData = [
            'value' => $updatedImage->getValue(),
            'title' => $updatedImage->getTitle(),
            'alt' => $updatedImage->getAlt(),
            'type' => $updatedImage->getType(),
        ];

        $updated = DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($newData)
            ->where('entity_id', (int) $imageId)
            ->execute();

        if ($updated) {
            if ($oldImage->getValue() != $updatedImage->getValue()) {
                $oldImageFile = $_SERVER['DOCUMENT_ROOT'] . $oldImage->getValue();
                if (is_file($oldImageFile)) {
                    unlink($oldImageFile);
                }
            }
        }

        return $updated;
    }

    /**
     * @throws HydrahonException
     * @throws Exception
     */
    public static function deleteImage($imageId)
    {
        $image = self::getImageById($imageId);

        $updated =  DAL::builder()
            ->table(self::TABLE_NAME)
            ->delete()
            ->where('entity_id', $imageId)
            ->execute();

        if ($updated) {
            if ($image->getValue()) {
                $oldImageFile = $_SERVER['DOCUMENT_ROOT'] . $image->getValue();
                if (is_file($oldImageFile)) {
                    unlink($oldImageFile);
                }
            }
        }
    }

    /**
     * @param $images
     * @return array
     */
    protected static function buildImagesFromQueryResult($images): array
    {
        $result = [];
        foreach ($images as $image) {
            $result[] = new ImageModel($image);
        }

        return $result;
    }
}