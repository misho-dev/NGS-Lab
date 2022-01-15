<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\User as UserRepository;
use App\Model\Repository\Product as ProductRepository;
use App\ViewModel\View;

class Owner implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        $userId = $_GET['id'];
        if ($userId && $user = UserRepository::getUserById($userId)) {
            $products = ProductRepository::getProductsOwnedByUser($userId);
            View::render('product-owner-page.phtml', compact('user', 'products'));
        } else {
            View::render('contact.html'); // TODO: 404 page
        }
    }
}
