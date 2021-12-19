<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\User as UserModel;

class User
{
    /**
     * @return array
     */
    public static function getUsers()
    {
        $users_query = "SELECT *
                FROM user_entity";

        return self::buildUsersFromQuery($users_query);
    }

    /**
     * @return array|bool|null
     */
    public static function getProductOwners()
    {
        $sql = "SELECT *
                FROM user_entity ue
                WHERE ue.is_owner IS TRUE";

        return self::buildUsersFromQuery($sql);
    }

    /**
     * @param string $id
     * @return UserModel|null
     */
    public static function getUserById(string $id)
    {
        $dal = DAL::getInstance();

        $id = $dal->escapeString($id);
        $sql = "SELECT *
                FROM user_entity ue
                WHERE entity_id = ('$id')";

        $user = self::buildUsersFromQuery($sql);
        if (!count($user)) {
            return null;
        }

        return $user[0];
    }

    public static function addUser(UserModel $user)
    {
        $dal = DAL::getInstance();
        $name = $dal->escapeString($user->getName());
        $shortDescription = $dal->escapeString($user->getShortDescription());
        $description = $dal->escapeString($user->getDescription());
        $isOwner = $user->isProductOwner() ? 'TRUE' : 'FALSE';

        $sql = "INSERT
                INTO `user_entity` (`full_name`, `short_description`, `description`, `is_owner`)
                VALUES ('$name', '$shortDescription', '$description', $isOwner)";

        return $dal->query($sql);
    }

    public static function updateUser(UserModel $user, $userId)
    {
        $oldUser = self::getUserById($userId);

        $dal = DAL::getInstance();
        $data = [
            'full_name="' . $dal->escapeString($user->getName()),
            'short_description="' . $dal->escapeString($user->getShortDescription()),
            'description="' . $dal->escapeString($user->getDescription()),
            'is_owner="' . ($user->isProductOwner() ? '1' : '0')
        ];

        $sql = "UPDATE `user_entity` SET " . implode('", ', $data) . '" WHERE entity_id=' . $userId;

        if ($dal->query($sql)) {
            if ($oldUser->isProductOwner() && !$user->isProductOwner()) {
                Product::unsetOwnerForProducts($userId);
            }
        }
    }

    /**
     * @param $query
     * @return array
     */
    private static function buildUsersFromQuery($query)
    {
        $dal = DAL::getInstance();

        $result = [];
        foreach ($dal->query($query) as $user) {
            $result[] = new UserModel($user);
        }

        return $result;
    }

    private static function escapeUserData($user)
    {
        $dal = DAL::getInstance();
        return [
            'full_name' => $dal->escapeString($user->getName()),
            'short_description' => $dal->escapeString($user->getShortDescription()),
            'description' => $dal->escapeString($user->getDescription()),
            'is_owner' => $user->isProductOwner() ? 'TRUE' : 'FALSE'
        ];
    }
}