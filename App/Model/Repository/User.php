<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\User as UserModel;
use App\Model\Repository\Product as ProductRepository;
use ClanCats\Hydrahon\Query\Sql\Exception as HydrahonException;
use Exception;

class User
{
    const TABLE_NAME = 'user_entity';

    /**
     * @return array
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getUsers()
    {
        $users = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->get();

        return self::buildUsersFromQueryResult($users);
    }

    /**
     * @return array
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getEnabledUsers()
    {
        $enabledUsers = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('enabled', true)
            ->get();

        return self::buildUsersFromQueryResult($enabledUsers);
    }

    /**
     * @return UserModel[]
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getProductOwners()
    {
        $enabledUsers = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('is_owner', true)
            ->where('enabled', true)
            ->get();

        return self::buildUsersFromQueryResult($enabledUsers);
    }

    /**
     * @param string $id
     * @return UserModel|null
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getUserById(string $id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $user = self::buildUsersFromQueryResult($result);
        if (!count($user)) {
            return null;
        }

        return $user[0];
    }

    /**
     * @param UserModel $user
     * @return mixed
     * @throws Exception
     */
    public static function addUser(UserModel $user)
    {
        $newUser = [
            'enabled' => (int) $user->isEnabled(),
            'full_name' => $user->getName(),
            'short_description' => $user->getShortDescription(),
            'description' => $user->getDescription(),
            'is_owner' => (int) $user->isProductOwner()
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newUser)
            ->execute();
    }

    /**
     * @throws Exception
     */
    public static function updateUser(UserModel $updatedUser, $userId)
    {
        $oldUser = self::getUserById($userId);

        $newData = [
            'full_name' => $updatedUser->getName(),
            'enabled' => (int) $updatedUser->isEnabled(),
            'short_description' => $updatedUser->getShortDescription(),
            'description' => $updatedUser->getDescription(),
            'is_owner' => (int) $updatedUser->isProductOwner()
        ];

        $updated = DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($newData)
            ->where('entity_id', (int) $userId)
            ->execute();

        if ($updated) {
            if ($oldUser->isProductOwner() && !$updatedUser->isProductOwner()) {
                return Product::unsetOwnerForProducts($userId);
            }
        }

        return $updated;
    }

    /**
     * @param $imageId
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public static function updateImage($imageId, $userId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['image' => $imageId])
            ->where('entity_id', (int) $userId)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $userId
     * @return mixed
     * @throws \Exception
     */
    public static function updateGif($imageId, $userId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['gif' => $imageId])
            ->where('entity_id', (int) $userId)
            ->execute();
    }

    /**
     * @throws HydrahonException
     * @throws Exception
     */
    public static function deleteUser($userId)
    {
        $deleted = DAL::builder()
            ->table(self::TABLE_NAME)
            ->delete()
            ->where('entity_id', $userId)
            ->execute();

        if ($deleted) {
            return ProductRepository::unsetOwnerForProducts($userId);
        }

        return $deleted;
    }

    /**
     * @param $users
     * @return array
     */
    protected static function buildUsersFromQueryResult($users): array
    {
        $result = [];
        foreach ($users as $user) {
            $result[] = new UserModel($user);
        }

        return $result;
    }
}