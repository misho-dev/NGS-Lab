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
            $services = UserRepository::getServices($user->getId());

            $productLogos = [];
            foreach ($products as $product) {
                $productLogos[$product->getId()] = ImageRepository::getImageById($product->getLogo()) ?? new Image();
            }

            $serviceImages = [];
            foreach ($services as $service) {
                $serviceImages[$service->getId()] = ImageRepository::getImageById($service->getImage()) ?? new Image();
            }

            View::render('product-owner-page.phtml', compact('user', 'userImage', 'userGif',
                'products', 'projects', 'productLogos', 'services', 'serviceImages'));
        } else {
            View::render('contact.phtml'); // TODO: 404 page
        }
    }
}
