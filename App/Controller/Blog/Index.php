<?php

namespace App\Controller\Blog;

use App\Controller\ControllerAction;
use App\Model\Repository\Blog;
use App\ViewModel\View;

class Index implements ControllerAction
{

    public function execute()
    {
        $blogs = Blog::getEnabledBlogs();
        View::render('blog-list.phtml', compact('blogs'));
    }
}
