<?php

namespace App\Controller\Blog;

use App\Controller\ControllerAction;
use App\Model\Image;
use App\Model\Repository\Blog;
use App\Model\Repository\Image as ImageRepository;
use App\ViewModel\View;

class Page implements ControllerAction
{

    public function execute()
    {
        $blog = Blog::getBlogById($_GET['id']);

        if (!$blog) {
            View::render('contact.phtml'); // TODO: 404 page
        } else {
            $image = ImageRepository::getImageById($blog->getImage()) ?? new Image();

            View::render('blog-page.phtml', compact('image'));
        }
    }
}
