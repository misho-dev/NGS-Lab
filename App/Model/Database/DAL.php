<?php

namespace App\Model\Database;

use \mysqli;
use \PDO;
use Config\Database;

class DAL
{
    /** @var ?DAL $instance Singleton instance of DAL */
    private static ?DAL $instance = null;

    /**
     * @deprecated
     * @var mysqli $mysqli
     */
    private mysqli $mysqli;

    /** @var \ClanCats\Hydrahon\Query\Sql $queryBuilder */
    private $queryBuilder;

    public function __construct()
    {
        $this->dbConnect();
        $this->initQueryBuilder();
    }

    /**
     * Connect to database and initiate query builder
     * @throws \ClanCats\Hydrahon\Exception
     */
    private function initQueryBuilder()
    {
        $connection = new PDO(
            'mysql:host=' . Database::HOST . ';dbname=' . Database::NAME . ';charset=utf8',
            Database::USER,
            Database::PASSWORD
        );

        $this->queryBuilder = new \ClanCats\Hydrahon\Builder('mysql', function ($query, $queryString, $queryParameters) use ($connection) {
            $statement = $connection->prepare($queryString);
            $statement->execute($queryParameters);

            if ($statement->errorCode() != '00000') {
                $error = $statement->errorInfo();
                throw new \Exception($error[2], $error[1]);
            }

            // when the query is fetchable return all results and let hydrahon do the rest
            // (there's no results to be fetched for an update-query for example)
            if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface) {
                return $statement->fetchAll(\PDO::FETCH_ASSOC);
            } // when the query is a instance of a insert return the last inserted id
            elseif ($query instanceof \ClanCats\Hydrahon\Query\Sql\Insert) {
                return $connection->lastInsertId();
            }
            // when the query is not a instance of insert or fetchable then
            // return the number os rows affected
            else {
                return $statement->rowCount();
            }
        });
    }

    /**
     * @return DAL
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DAL();
        }

        return self::$instance;
    }

    /**
     * Public wrapper for getting query builder
     * @return \ClanCats\Hydrahon\Query\Sql
     * @throws \Exception
     */
    public static function builder()
    {
        return self::getInstance()->getBuilder();
    }

    /**
     * @return \ClanCats\Hydrahon\Query\Sql
     */
    public function getBuilder()
    {
        return $this->queryBuilder;
    }

    /**
     * @deprecated
     */
    private function dbConnect()
    {
        $this->mysqli = new mysqli(
            Database::HOST,
            Database::USER,
            Database::PASSWORD,
            Database::NAME
        ) or die ("<br/>Could not connect to MySQL server");
    }

    /**
     * @param string $sql
     * @return array|bool|null
     * @deprecated
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
            } else {
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
     * @param $var
     * @return mixed
     * @deprecated
     */
    public function escapeString($var)
    {
        return $this->mysqli->real_escape_string($var);
    }
}
