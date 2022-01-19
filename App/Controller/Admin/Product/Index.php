<?php

namespace App\Controller\Admin\Product;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Product as ProductRepository;
use App\ViewModel\View;

class Index extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $products = ProductRepository::getProducts();
        View::render('admin/product-list.phtml', compact('products'));
    }
}
