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
            'title' => $blog->getTitle('en'),
            'title_ka' => $blog->getTitle('ka'),
            'description' => $blog->getDescription('en'),
            'description_ka' => $blog->getDescription('ka'),
            'body' => $blog->getBody('en'),
            'body_ka' => $blog->getBody('ka'),
            'meta_title' => $blog->getMetaTitle('en'),
            'meta_keyword' => $blog->getMetaKeyword('en'),
            'meta_description' => $blog->getMetaDescription('en'),
            'meta_title_ka' => $blog->getMetaTitle('ka'),
            'meta_keyword_ka' => $blog->getMetaKeyword('ka'),
            'meta_description_ka' => $blog->getMetaDescription('ka'),
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
            'title' => $updatedBlog->getTitle('en'),
            'title_ka' => $updatedBlog->getTitle('ka'),
            'description' => $updatedBlog->getDescription('en'),
            'description_ka' => $updatedBlog->getDescription('ka'),
            'body' => $updatedBlog->getBody('en'),
            'body_ka' => $updatedBlog->getBody('ka'),
            'meta_title' => $updatedBlog->getMetaTitle('en'),
            'meta_keyword' => $updatedBlog->getMetaKeyword('en'),
            'meta_description' => $updatedBlog->getMetaDescription('en'),
            'meta_title_ka' => $updatedBlog->getMetaTitle('ka'),
            'meta_keyword_ka' => $updatedBlog->getMetaKeyword('ka'),
            'meta_description_ka' => $updatedBlog->getMetaDescription('ka'),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($newData)
            ->where('entity_id', (int) $blogId)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $blogId
     * @return mixed
     * @throws \Exception
     */
    public static function updateImage($imageId, $blogId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['image' => $imageId])
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