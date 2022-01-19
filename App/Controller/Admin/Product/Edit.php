<?php

namespace App\Controller\Admin\Product;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Product as ProductRepository;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $product = ProductRepository::getProductById($_GET['id']);
        if (!$product){
            throw new \Exception('Product with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            $productOwners = UserRepository::getProductOwners();
            View::render('admin/product-edit.phtml', compact('product', 'productOwners'));
        }
    }
}
