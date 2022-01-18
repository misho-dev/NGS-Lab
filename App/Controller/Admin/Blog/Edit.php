<?php

namespace App\Controller\Admin\Blog;

use App\Controller\Admin\AbstractAdminAction;
use App\Model\Repository\Blog as BlogRepository;
use App\ViewModel\View;

class Edit extends AbstractAdminAction
{
    public const ACTION_PERMISSION = self::PERMISSION_BLOG;

    /**
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     */
    public function execute()
    {
        $blog = BlogRepository::getBlogById($_GET['id']);
        if (!$blog){
            throw new \Exception('Blog with given ID (' . $_GET['id'] . ') does not exist');
        } else {
            View::render('admin/blog-edit.phtml', compact('blog'));
        }
    }
}
