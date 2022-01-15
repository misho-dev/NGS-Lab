<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\Product as ProductRepository;
use App\ViewModel\View;

class Page implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $product = ProductRepository::getProductById($_GET['id']);
        if (!$product) {
            View::render('contact.html'); // TODO: 404 page
        } else {
            View::render('product-page.phtml', compact('product'));
        }
    }
}
