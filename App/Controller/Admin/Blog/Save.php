<?php

namespace App\Controller\Admin\Blog;

use App\Controller\Admin\AbstractAdminAction;
use App\Helper\Url as UrlHelper;
use App\Model\Blog as BlogModel;
use App\Model\Repository\Blog as BlogRepository;

class Save extends AbstractAdminAction
{
    public const ACTION_PERMISSION = self::PERMISSION_BLOG;

    /**
     * @throws \Exception
     */
    public function execute()
    {
        $blog = $this->createBlogFromPostRequest();

        if (isset($_POST['create_blog'])) {
            BlogRepository::addBlog($blog);
        } else if (isset($_POST['update_blog']) && $_GET['id']) {
            BlogRepository::updateBlog($blog, $_GET['id']);
        } else {
            throw new \Exception('Unexpected error occurred. Please try again.');
        }

        UrlHelper::redirect("/admin/blog");
    }

    protected function createBlogFromPostRequest()
    {
        return new BlogModel([
            'enabled' => $_POST['enabled'] == 'on',
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'body' => $_POST['blog_body'],
            'meta_title' => $_POST['meta_title'],
            'meta_keyword' => $_POST['meta_keyword'],
            'meta_description' => $_POST['meta_description'],

            'title_ka' => $_POST['title_ka'],
            'description_ka' => $_POST['description_ka'],
            'body_ka' => $_POST['blog_body_ka'],
            'meta_title_ka' => $_POST['meta_title_ka'],
            'meta_keyword_ka' => $_POST['meta_keyword_ka'],
            'meta_description_ka' => $_POST['meta_description_ka'],
        ]);
    }
}
