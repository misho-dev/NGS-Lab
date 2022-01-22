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
            'short_description' => $product->getShortDescription(),
            'description' => $product->getDescription(),
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
        // TODO
        $dal = DAL::getInstance();
        $data = [
            'name="' . $product->getName(),
            'short_description="' . $product->getShortDescription(),
            'description="' . $product->getDescription(),
            'owner_id="' . $product->getOwnerId(),
        ];

        $sql = "UPDATE `product_entity` SET " . implode('", ', $data) . '" WHERE entity_id=' . $productId;

        return $dal->query($sql);
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
     * @return array
     */
    protected static function buildProducts($products)
    {
        $result = [];
        foreach ($products as $product) {
            $result[] = new ProductModel($product);
        }

        return $result;
    }
}