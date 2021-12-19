<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\ViewModel\View;

class Owner implements ControllerAction
{
    public function execute()
    {
        View::render('product-owner-page.html');
    }
}
