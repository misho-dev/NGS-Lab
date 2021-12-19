<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\Product as ProductModel;

class Product
{
    /**
     * @return array
     */
    public static function getProducts()
    {
        $productsQuery = "SELECT * FROM product_entity pe";

        return self::buildProductsFromQuery($productsQuery);
    }

    /**
     * @return array
     */
    public static function getProductsOwnedByUser($userId)
    {
        $userId = DAL::getInstance()->escapeString($userId);

        $sql = "SELECT pe.*
                FROM user_entity ue
                JOIN product_entity pe
                ON pe.owner_id=ue.entity_id
                WHERE ue.entity_id = ('$userId')";

        return self::buildProductsFromQuery($sql);
    }

    /**
     * @param $id
     * @return ProductModel|null
     */
    public static function getProductById($id)
    {
        $id = DAL::getInstance()->escapeString($id);

        $sql = "SELECT *
                FROM product_entity pe
                WHERE entity_id = ('$id')";

        $user = self::buildProductsFromQuery($sql);
        if (!count($user)) {
            return null;
        }

        return $user[0];
    }
    public static function addProduct(ProductModel $product)
    {
        $dal = DAL::getInstance();
        $name = $dal->escapeString($product->getName());
        $shortDescription = $dal->escapeString($product->getShortDescription());
        $description = $dal->escapeString($product->getDescription());
        $isOwner = $product->getOwnerId();

        $sql = "INSERT
                INTO `product_entity` (`name`, `short_description`, `description`, `owner_id`)
                VALUES ('$name', '$shortDescription', '$description', $isOwner)";

        return $dal->query($sql);
    }

    public static function updateProduct(ProductModel $product, $productId)
    {
        $dal = DAL::getInstance();
        $data = [
            'name="' . $dal->escapeString($product->getName()),
            'short_description="' . $dal->escapeString($product->getShortDescription()),
            'description="' . $dal->escapeString($product->getDescription()),
            'owner_id="' . $dal->escapeString($product->getOwnerId()),
        ];

        $sql = "UPDATE `product_entity` SET " . implode('", ', $data) . '" WHERE entity_id=' . $productId;

        return $dal->query($sql);
    }

    public static function unsetOwnerForProducts($ownerId)
    {
        $dal = DAL::getInstance();
        $sql = "UPDATE product_entity SET owner_id=NULL WHERE owner_id=" . $dal->escapeString($ownerId);

        return $dal->query($sql);
    }

    /**
     * @param $query
     * @return array
     */
    private static function buildProductsFromQuery($query)
    {
        $dal = DAL::getInstance();

        $result = [];
        foreach ($dal->query($query) as $user) {
            $result[] = new ProductModel($user);
        }

        return $result;
    }
}