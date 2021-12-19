<?php

namespace App\Controller\Admin\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\Product as ProductRepository;
use App\ViewModel\View;

class Index implements ControllerAction
{
    public function execute()
    {
        $products = ProductRepository::getProducts();
        View::render('admin/product-list.phtml', compact('products'));
    }
}
