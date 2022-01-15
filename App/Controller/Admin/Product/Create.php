<?php


namespace App\Controller\Admin\Product;


use App\Controller\ControllerAction;
use App\Model\Product;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Create implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $product = new Product([]);
        $productOwners = UserRepository::getProductOwners();
        View::render('admin/product-edit.phtml', compact('product', 'productOwners'));
    }
}