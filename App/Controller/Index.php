<?php

namespace App\Controller;

use App\Model\Repository\Image;
use App\Model\Repository\User;
use App\ViewModel\View;

class Index implements ControllerAction
{
    public function execute()
    {
        $productOwners = User::getProductOwners();
        $productOwnerImages = [];
        $productOwnerGifs = [];
        foreach ($productOwners as $productOwner) {
            $productOwnerImages[$productOwner->getId()] = Image::getImageById($productOwner->getImage());
            $productOwnerGifs[$productOwner->getId()] = Image::getImageById($productOwner->getGif());
        }

        View::render('index.phtml', compact('productOwners', 'productOwnerGifs', 'productOwnerImages'));
    }
}
