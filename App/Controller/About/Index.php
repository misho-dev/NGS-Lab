<?php

namespace App\Controller\About;

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
        $users = User::getEnabledUsers();
        $userImages = [];
        $userGifs = [];

        foreach ($users as $user) {
            $userImages[$user->getId()] = Image::getImageById($user->getImage()) ?? new \App\Model\Image();
            $userGifs[$user->getId()] = Image::getImageById($user->getGif()) ?? new \App\Model\Image();
        }

        View::render('about.phtml', compact('users', 'userImages', 'userGifs'));
    }
}
