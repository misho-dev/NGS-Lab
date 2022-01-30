<?php

namespace App\Controller\Blog;

use App\Controller\ControllerAction;
use App\Model\Repository\Blog;
use App\ViewModel\View;

class Page implements ControllerAction
{

    public function execute()
    {
        $blog = Blog::getBlogById($_GET['id']);

        if (!$blog) {
            View::render('contact.html'); // TODO: 404 page
        } else {
            View::render('blog-page.phtml', compact('blog'));
        }

    }
}
