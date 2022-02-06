<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\Image;
use App\Model\Repository\Product as ProductRepository;
use App\ViewModel\View;

class Catalog implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $products = ProductRepository::getProducts();

        $productLogos = [];
        foreach ($products as $product) {
            $productLogos[$product->getId()] = Image::getImageById($product->getLogo()) ?? new \App\Model\Image();
        }

        View::render('catalog.phtml', compact('products', 'productLogos'));
    }
}
