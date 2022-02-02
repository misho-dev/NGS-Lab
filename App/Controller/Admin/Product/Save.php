<?php

namespace App\Controller\Admin\Product;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Product as ProductModel;
use App\Model\Repository\Product as ProductRepository;

class Save extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $product = $this->createProductFromPostRequest();

        if (isset($_POST['create_product'])) {
            ProductRepository::addProduct($product);
        } else if (isset($_POST['update_product']) && $_GET['id']) {
            ProductRepository::updateProduct($product, $_GET['id']);
        } else {
            throw new \Exception('Unexpected error occurred. Please try again.');
        }

        UrlHelper::redirect("/admin/product");
    }

    protected function createProductFromPostRequest()
    {
        $ownerId = (int) $_POST['owner_id'];
        return new ProductModel([
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
            'meta_title' => $_POST['meta_title'],
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],
            'owner_id' => $ownerId == -1 ? null : $ownerId,
        ]);
    }
}