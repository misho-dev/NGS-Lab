<?php

namespace App\Controller\Product;

use App\Controller\ControllerAction;
use App\Model\Repository\User as UserRepository;
use App\ViewModel\View;

class Page implements ControllerAction
{
    public function execute()
    {
        View::render('product-page.html');
    }
}
