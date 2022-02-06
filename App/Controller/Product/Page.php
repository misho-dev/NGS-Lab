<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\Image;
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
            View::render('contact.phtml'); // TODO: 404 page
        } else {
            $image = Image::getImageById($product->getImage()) ?? new \App\Model\Image();
            $logo = Image::getImageById($product->getLogo()) ?? new \App\Model\Image();
            View::render('product-page.phtml', compact('product', 'image', 'logo'));
        }
    }
}
