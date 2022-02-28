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
            'page_html' => $_POST['page_html'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
            'name_ka' => $_POST['name_ka'],
            'page_html_ka' => $_POST['page_html_ka'],
            'description_ka' => $_POST['description_ka'],
            'short_description_ka' => $_POST['short_description_ka'],
            'meta_title' => $_POST['meta_title'],
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],
            'meta_title_ka' => $_POST['meta_title_ka'],
            'meta_keyword_ka' => $_POST['meta_keyword_ka'],
            'meta_description_ka' => $_POST['meta_description_ka'],
            'owner_id' => $ownerId == -1 ? null : $ownerId,
        ]);
    }
}