<?php

namespace App\Controller\Blog;

use App\Controller\ControllerAction;
use App\Model\Repository\Blog;
use App\Model\Repository\Image;
use App\ViewModel\View;

class Index implements ControllerAction
{

    public function execute()
    {
        $blogs = Blog::getEnabledBlogs();

        $blogImages = [];
        foreach ($blogs as $blog) {
            $blogImages[$blog->getId()] = Image::getImageById($blog->getImage()) ?? new \App\Model\Image();
        }

        View::render('blog-list.phtml', compact('blogs', 'blogImages'));
    }
}
