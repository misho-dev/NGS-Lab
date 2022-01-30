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
    const TABLE_TO_PROJECT = 'user_to_project';

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
            'position' => $user->getPosition(),
            'meta_title' => $user->getMetaTitle(),
            'meta_keyword' => $user->getMetaKeyword(),
            'meta_description' => $user->getMetaDescription(),
            'social_facebook' => $user->getSocials()['facebook'],
            'social_linkedin' => $user->getSocials()['linkedin'],
            'social_instagram' => $user->getSocials()['instagram'],
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
            'position' => $updatedUser->getPosition(),
            'meta_title' => $updatedUser->getMetaTitle(),
            'meta_keyword' => $updatedUser->getMetaKeyword(),
            'meta_description' => $updatedUser->getMetaDescription(),
            'social_facebook' => $updatedUser->getSocials()['facebook'],
            'social_linkedin' => $updatedUser->getSocials()['linkedin'],
            'social_instagram' => $updatedUser->getSocials()['instagram'],
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
     * @param $userId
     * @param $projectIds
     * @return mixed
     * @throws Exception
     */
    public static function setProjects($userId, $projectIds)
    {
        $relationTable = DAL::builder()->table(self::TABLE_TO_PROJECT);

        $deleted = $relationTable->delete()
            ->where('user_id', (int) $userId)
            ->execute();

        $insertData = [];
        foreach ($projectIds as $projectId) {
            $insertData[] = [
                'user_id' => $userId,
                'project_id' => $projectId
            ];
        }

        return $relationTable->insert($insertData)->execute();
    }

    public static function getProjects($userId)
    {
        $queryResult = DAL::builder()
            ->table(self::TABLE_TO_PROJECT . ' as utp')
            ->select()
            ->join(Project::TABLE_NAME . ' as p', 'utp.project_id', '=', 'p.entity_id')
            ->where('utp.user_id', (int) $userId)
            ->execute();

        return Project::buildProjects($queryResult);
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