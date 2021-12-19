<?php
namespace App\Model\Database;

use \mysqli;
use Config\Database;

class DAL
{
    private static $instance = null;
    private $mysqli = null;

    public function __construct()
    {
        $this->dbConnect();
    }

    private function dbConnect()
    {
        $this->mysqli = new mysqli(
            Database::HOST,
            Database::USER,
            Database::PASSWORD,
            Database::NAME
        ) or die ("<br/>Could not connect to MySQL server");
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DAL();
        }

        return self::$instance;
    }

    /**
     * @param string $sql
     * @return array|bool|null
     */
    public function query($sql)
    {
        $res = $this->mysqli->query($sql);

        if ($res) {
            if (strpos($sql, 'SELECT') === false) {
                return true;
            }
        } else {
            if (strpos($sql, 'SELECT') === false) {
                return false;
            }
            else {
                return null;
            }
        }

        $results = array();

        while ($row = $res->fetch_assoc()) {
            $results[] = $row;
        }

        return $results;
    }

    /**
     * @param int $user_id
     * @return array|bool|null
     */
    public function getProducts($user_id)
    {
        $this->dbConnect();

        $user_id = $this->escapeString($user_id);

        $sql = "SELECT *
                FROM user_entity ue
                JOIN product_entity pe
                ON pe.owner_id=ue.entity_id
                WHERE ue.entity_id = ('$user_id')";

        return $this->query($sql);
    }

    /**
     * @param int $id
     * @return array|bool|null
     */
    public function getProductById($id)
    {
        $this->dbConnect();

        $id = $this->escapeString($id);

        $sql = "SELECT *
                FROM product_entity pe
                WHERE entity_id = ('$id')";

        return $this->query($sql);
    }

    /**
     * @param int $product_id
     * @return array|bool|null
     */
    public function getProjects($product_id)
    {
        $this->dbConnect();

        $product_id = $this->escapeString($product_id);

        $sql = "SELECT *
                FROM product_entity pe
                JOIN project_entity pje
                ON pje.product_id=pe.entity_id
                WHERE pe.entity_id = ('$product_id')";
        return $this->query($sql);
    }

    /**
     * @param int $id
     * @return array|bool|null
     */
    public function getProjectById($id)
    {
        $this->dbConnect();

        $id = $this->escapeString($id);

        $sql = "SELECT *
                FROM project_entity pe
                WHERE entity_id = ('$id')";
        return $this->query($sql);
    }

    public function deleteProduct(string $sku)
    {
        $this->dbconnect();

        $sku = $this->escapeString($sku);
        $sql = "DELETE
                FROM products
                WHERE products.sku = ('$sku')";
        return $this->query($sql);
    }

    public function saveBook(Book $book)
    {
        $this->dbconnect();
        $result = $this->saveProduct($book);

        if ($result) {
            $sku = $this->escapeString($book->getSku());
            $weight = $this->escapeString($book->getWeight());
            $sql = "INSERT
                    INTO `books` (`sku`, `weight`)
                    VALUES ('$sku', '$weight')";
            $result = $this->query($sql);
        }

        return $result;
    }

    // It is assumed that connection is already made
    private function saveProduct($product)
    {
        $sku = $this->escapeString($product->getSku());
        $name = $this->escapeString($product->getName());
        $price = $this->escapeString($product->getPrice());
        $sql = "INSERT
                INTO `products` (`sku`, `name`, `price`)
                VALUES ('$sku', '$name', '$price')";
        return $this->query($sql);
    }

    public function escapeString($var)
    {
        return $this->mysqli->real_escape_string($var);
    }
}
