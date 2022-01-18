<?php

namespace App\Model\Repository;

use App\Model\Blog as BlogModel;
use App\Model\Database\DAL;
use App\Model\Repository\Product as ProductRepository;
use ClanCats\Hydrahon\Query\Sql\Exception as HydrahonException;
use Exception;

class Blog
{
    const TABLE_NAME = 'blog_entity';

    /**
     * @return array
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getBlogs()
    {
        $blogs = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->get();

        return self::buildBlogsFromQueryResult($blogs);
    }

    /**
     * @return array
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getEnabledBlogs()
    {
        $enabledBlogs = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('enabled', true)
            ->get();

        return self::buildBlogsFromQueryResult($enabledBlogs);
    }

    /**
     * @param string $id
     * @return BlogModel|null
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getBlogById(string $id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $blog = self::buildBlogsFromQueryResult($result);
        if (!count($blog)) {
            return null;
        }

        return $blog[0];
    }

    /**
     * @param BlogModel $blog
     * @return mixed
     * @throws Exception
     */
    public static function addBlog(BlogModel $blog)
    {
        $newBlog = [
            'enabled' => (int) $blog->isEnabled(),
            'title' => $blog->getTitle(),
            'body' => $blog->getBody(),
            'meta_keys' => $blog->getMetaKeys(),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newBlog)
            ->execute();
    }

    /**
     * @throws Exception
     */
    public static function updateBlog(BlogModel $updatedBlog, $blogId)
    {
        $newData = [
            'enabled' => (int) $updatedBlog->isEnabled(),
            'title' => $updatedBlog->getTitle(),
            'body' => $updatedBlog->getBody(),
            'meta_keys' => $updatedBlog->getMetaKeys(),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($newData)
            ->where('entity_id', (int) $blogId)
            ->execute();
    }

    /**
     * @throws HydrahonException
     * @throws Exception
     */
    public static function deleteBlog($blogId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->delete()
            ->where('entity_id', $blogId)
            ->execute();
    }

    /**
     * @param $blogs
     * @return array
     */
    protected static function buildBlogsFromQueryResult($blogs): array
    {
        $result = [];
        foreach ($blogs as $blog) {
            $result[] = new BlogModel($blog);
        }

        return $result;
    }
}