<?php

namespace App\Controller\Admin\Product;

use App\Controller\ControllerAction;
use App\Model\Product as ProductModel;
use App\Model\Repository\Product as ProductRepository;

class Save implements ControllerAction
{
    public function execute()
    {
        $product = new ProductModel([
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'short_description' => $_POST['short_description'],
            'owner_id' => $_POST['owner_id'],
        ]);

        if (isset($_POST['create_product'])) {
            $this->createProduct($product);
        } else if (isset($_POST['update_product']) && $_GET['id']) {
            $this->updateProduct($product);
        } else {
            die ('hard'); // TODO: What here?
        }
    }

    private function createProduct($user)
    {
        ProductRepository::addProduct($user);
        $this->redirect("/admin/product");
    }

    private function updateProduct($user)
    {
        ProductRepository::updateProduct($user, $_GET['id']);
        $this->redirect("/admin/product");
    }

    private function redirect(string $url)
    {
        ob_start();
        while (ob_get_status()) {
            ob_end_clean();
        }

        header("Location: $url");
    }
}