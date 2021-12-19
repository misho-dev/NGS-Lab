<?php

namespace App\Controller\Admin\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\Product as ProductRepository;
use App\ViewModel\View;

class Edit implements ControllerAction
{

    public function execute()
    {
        $productId = $_GET['id'];
        $product = ProductRepository::getProductById($productId);
        if (!$product){
            //TODO: Invalid
            View::render('invalid.phtml');
            die('hard');
        } else {
            View::render('admin/product-edit.phtml', compact('product'));
        }
    }
}
