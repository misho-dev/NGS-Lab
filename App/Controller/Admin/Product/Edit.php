<?php

namespace App\Controller\Admin\Product;

use App\Controller\ControllerAction;
use App\Model\Helper\Url as UrlHelper;
use App\Model\Repository\Product as ProductRepository;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Edit implements ControllerAction
{
    public function execute()
    {
        try {
            $product = ProductRepository::getProductById($_GET['id']);
            if (!$product){
                //TODO: Invalid
                View::render('invalid.phtml');
                die('hard');
            } else {
                $productOwners = UserRepository::getProductOwners();
                View::render('admin/product-edit.phtml', compact('product', 'productOwners'));
            }
        } catch (\Exception $e) {
            $_SESSION['error_log'] = $e;
            UrlHelper::redirect('/admin/product ');
        }
    }
}
