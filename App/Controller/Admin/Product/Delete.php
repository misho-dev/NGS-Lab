<?php

namespace App\Controller\Admin\Product;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url;
use App\Model\Repository\Product;

class Delete extends AbstractAdminAction
{
    const ACTION_PERMISSION = self::PERMISSION_PRODUCT;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        Product::deleteProduct($_GET['id']);
        Url::redirect("/admin/product");
    }
}
