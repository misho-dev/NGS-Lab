<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\Administrator as AdministratorModel;
use App\Model\Repository\Product as ProductRepository;
use ClanCats\Hydrahon\Query\Sql\Exception as HydrahonException;
use Exception;

class Administrator
{
    const TABLE_NAME = 'administrator_entity';

    /**
     * @return array
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getAdministrators()
    {
        $administrators = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->get();

        return self::buildAdministratorsFromQueryResult($administrators);
    }

    /**
     * @param string $id
     * @return AdministratorModel|null
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getAdministratorById(string $id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $administrator = self::buildAdministratorsFromQueryResult($result);
        if (!count($administrator)) {
            return null;
        }

        return $administrator[0];
    }

    /**
     * @param string $username
     * @return AdministratorModel|null
     * @throws HydrahonException
     * @throws Exception
     */
    public static function getAdministratorByUsername(string $username)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('username', $username)
            ->get();

        $administrator = self::buildAdministratorsFromQueryResult($result);
        if (!count($administrator)) {
            return null;
        }

        return $administrator[0];
    }

    /**
     * @param AdministratorModel $administrator
     * @return mixed
     * @throws Exception
     */
    public static function addAdministrator(AdministratorModel $administrator)
    {
        $newAdministrator = [
            'username' => $administrator->getUsername(),
            'password' => $administrator->getPassword(),
            'permissions' => $administrator->getPermissions(),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newAdministrator)
            ->execute();
    }

    /**
     * @throws Exception
     */
    public static function updateAdministrator(AdministratorModel $updatedAdministrator, $administratorId)
    {
        $newData = [
            'permissions' => $updatedAdministrator->getPermissions(),
        ];

        if ($updatedAdministrator->getUsername() != '' && $updatedAdministrator->getPassword() != '') {
            $newData['username'] = $updatedAdministrator->getUsername();
            $newData['password'] = $updatedAdministrator->getPassword();
        }

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($newData)
            ->where('entity_id', (int) $administratorId)
            ->execute();
    }

    /**
     * @throws HydrahonException
     * @throws Exception
     */
    public static function deleteAdministrator($administratorId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->delete()
            ->where('entity_id', $administratorId)
            ->execute();
    }

    /**
     * @param $administrators
     * @return array
     */
    protected static function buildAdministratorsFromQueryResult($administrators): array
    {
        $result = [];
        foreach ($administrators as $administrator) {
            $result[] = new AdministratorModel($administrator);
        }

        return $result;
    }
}