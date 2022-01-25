<?php

namespace App\Controller;

use App\Model\Database\DAL;
use App\Model\Repository\Image as ImageRepository;
use App\Model\Image;
use App\Model\Repository\Product;
use App\Model\Repository\Project;
use App\Model\Repository\User;
use App\ViewModel\View;

class Index implements ControllerAction
{
    const PRODUCT_COUNT = 4;
    const PROJECT_COUNT = 5;

    public function execute()
    {
        $productQueryResult = DAL::builder()
            ->table(Product::TABLE_NAME)
            ->select()
            ->orderBy('entity_id', 'desc')
            ->limit(self::PRODUCT_COUNT)
            ->get();

        $products = Product::buildProducts($productQueryResult);
        $productImages = [];
        $productLogos = [];
        foreach ($products as $product) {
            $productImages[$product->getId()] = ImageRepository::getImageById($product->getImage()) ?? new Image();
            $productLogos[$product->getId()] = ImageRepository::getImageById($product->getLogo()) ?? new Image();
        }

        $productOwners = User::getProductOwners();
        $productOwnerImages = [];
        foreach ($productOwners as $productOwner) {
            $productOwnerImages[$productOwner->getId()] = ImageRepository::getImageById($productOwner->getImage()) ?? new Image();
        }

        $projectQueryResult = DAL::builder()
            ->table(Project::TABLE_NAME)
            ->select()
            ->orderBy('entity_id', 'desc')
            ->limit(self::PROJECT_COUNT)
            ->get();

        $projects = Project::buildProjects($projectQueryResult);

        View::render('index.phtml', compact([
            'products', 'productImages', 'productLogos',
            'productOwners', 'productOwnerImages',
            'projects',
        ]));
    }
}
