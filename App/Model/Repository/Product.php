<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\Product as ProductModel;

class Product
{
    const TABLE_NAME = 'product_entity';

    /**
     * @return array
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getProducts()
    {
        $products = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->get();

        return self::buildProducts($products);
    }

    /**
     * @param $id
     * @return ProductModel|null
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getProductById($id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $product = self::buildProducts($result);
        if (!count($product)) {
            return null;
        }

        return $product[0];
    }

    /**
     * @return array
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getProductsOwnedByUser($userId)
    {
        $products = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('owner_id', (int) $userId)
            ->get();

        return self::buildProducts($products);
    }

    /**
     * @throws \Exception
     */
    public static function addProduct(ProductModel $product)
    {
        $newProduct = [
            'name' => $product->getName(),
            'page_html' => $product->getPageHtml(),
            'short_description' => $product->getShortDescription(),
            'description' => $product->getDescription(),
            'name_ka' => $product->getName('ka'),
            'page_html_ka' => $product->getPageHtml('ka'),
            'short_description_ka' => $product->getShortDescription('ka'),
            'description_ka' => $product->getDescription('ka'),
            'meta_title' => $product->getMetaTitle(),
            'meta_keyword' => $product->getMetaKeyword(),
            'meta_description' => $product->getMetaDescription(),
            'meta_title_ka' => $product->getMetaTitle('ka'),
            'meta_keyword_ka' => $product->getMetaKeyword('ka'),
            'meta_description_ka' => $product->getMetaDescription('ka'),
            'owner_id' => $product->getOwnerId()
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newProduct)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $productId
     * @return mixed
     * @throws \Exception
     */
    public static function updateImage($imageId, $productId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['image' => $imageId])
            ->where('entity_id', (int) $productId)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $productId
     * @return mixed
     * @throws \Exception
     */
    public static function updateLogo($imageId, $productId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['logo' => $imageId])
            ->where('entity_id', (int) $productId)
            ->execute();
    }

    public static function updateProduct(ProductModel $product, $productId)
    {
        $data = [
            'name' => $product->getName(),
            'page_html' => $product->getPageHtml(),
            'short_description' => $product->getShortDescription(),
            'description' => $product->getDescription(),
            'name_ka' => $product->getName('ka'),
            'page_html_ka' => $product->getPageHtml('ka'),
            'short_description_ka' => $product->getShortDescription('ka'),
            'description_ka' => $product->getDescription('ka'),
            'meta_title' => $product->getMetaTitle(),
            'meta_keyword' => $product->getMetaKeyword(),
            'meta_description' => $product->getMetaDescription(),
            'meta_title_ka' => $product->getMetaTitle('ka'),
            'meta_keyword_ka' => $product->getMetaKeyword('ka'),
            'meta_description_ka' => $product->getMetaDescription('ka'),
            'owner_id' => $product->getOwnerId(),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($data)
            ->where('entity_id', (int) $productId)
            ->execute();
    }

    /**
     * @throws \Exception
     */
    public static function deleteProduct($productId)
    {
        $deleted = DAL::builder()
            ->table(self::TABLE_NAME)
            ->delete()
            ->where('entity_id', $productId)
            ->execute();

        return $deleted;
    }

    /**
     * @throws \Exception
     */
    public static function unsetOwnerForProducts($ownerId)
    {
        return DAL::builder()
            ->table('product_entity')
            ->update(['owner_id' => null])
            ->where('owner_id', (int) $ownerId)
            ->execute();
    }

    /**
     * @param $products
     * @return \App\Model\Product[]
     */
    public static function buildProducts($products)
    {
        $result = [];
        foreach ($products as $product) {
            $result[] = new ProductModel($product);
        }

        return $result;
    }
}