<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\Model\Image;
use App\Model\Repository\Image as ImageRepository;
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
        $user = UserRepository::getUserById($_GET['id']);
        if ($user) {
            $userImage = ImageRepository::getImageById($user->getImage()) ?? new Image();
            $userGif = ImageRepository::getImageById($user->getGif()) ?? new Image();
            $products = ProductRepository::getProductsOwnedByUser($user->getId());
            $projects = UserRepository::getProjects($user->getId());

            View::render('product-owner-page.phtml', compact('user', 'userImage', 'userGif', 'products', 'projects'));
        } else {
            View::render('contact.phtml'); // TODO: 404 page
        }
    }
}
