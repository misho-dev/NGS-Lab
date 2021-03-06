<?php

namespace App\Controller\Admin\Product;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\ImageUploader;
use App\Helper\Url;
use App\Model\Repository\Product as ProductRepository;

class Upload extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $product = ProductRepository::getProductById($_GET['id']);
        if (!$product) {
            throw new \Exception('Product with given ID (' . $_GET['id'] . ') does not exist');
        }

        $this->uploadImage();
        $this->uploadLogo();

        Url::redirect('/admin/product/edit?id=' . $_GET['id']);
    }

    /**
     * @throws \Exception
     */
    protected function uploadImage()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['product_pic_id'],
            'product_pic',
            $_POST['product_pic_title'],
            $_POST['product_pic_alt']
        );

        if ($imageId) {
            ProductRepository::updateImage($imageId, $_GET['id']);
        }
    }

    /**
     * @throws \Exception
     */
    protected function uploadLogo()
    {
        $imageId = ImageUploader::uploadAndSaveImage(
            $_POST['product_logo_id'],
            'product_logo',
            $_POST['product_logo_title'],
            $_POST['product_logo_alt']
        );

        if ($imageId) {
            ProductRepository::updateLogo($imageId, $_GET['id']);
        }
    }
}
