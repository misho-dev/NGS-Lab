<?php

namespace App\Controller\Contact;

use App\Controller\ControllerAction;
use App\Model\Repository\Image;
use App\Model\Repository\User;
use App\ViewModel\View;

class Index implements ControllerAction
{
    /**
     * @throws \Exception
     */
    public function execute()
    {
        View::render('contact.phtml');
    }
}
