<?php


namespace App\Controller\Admin\Product;


use App\Controller\ControllerAction;
use App\Model\Product;
use App\ViewModel\View;

class Create implements ControllerAction
{

    public function execute()
    {
        $product = new Product([]);
        View::render('admin/product-edit.phtml', compact('product'));
    }
}