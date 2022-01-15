<?php

namespace App\Controller;

use App\ViewModel\View;

class Index implements ControllerAction
{
    public function execute()
    {
        View::render('index.html');
    }
}