<?php

namespace App\Model\Repository;

use App\Model\Database\DAL;
use App\Model\Service as ServiceModel;

class Service
{
    const TABLE_NAME = 'service_entity';

    /**
     * @return \App\Model\Service[]
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getServices()
    {
        $services = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->get();

        return self::buildServices($services);
    }

    /**
     * @param $id
     * @return ServiceModel|null
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getServiceById($id)
    {
        $result = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('entity_id', (int) $id)
            ->get();

        $service = self::buildServices($result);
        if (!count($service)) {
            return null;
        }

        return $service[$id];
    }

    /**
     * @return array
     * @throws \ClanCats\Hydrahon\Query\Sql\Exception
     * @throws \Exception
     */
    public static function getServicesOwnedByUser($userId)
    {
        // TODO
        $services = DAL::builder()
            ->table(self::TABLE_NAME)
            ->select()
            ->where('owner_id', (int) $userId)
            ->get();

        return self::buildServices($services);
    }

    /**
     * @throws \Exception
     */
    public static function addService(ServiceModel $service)
    {
        $newService = [
            'title' => $service->getTitle(),
            'title_ka' => $service->getTitle('ka'),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->insert($newService)
            ->execute();
    }

    /**
     * @param $imageId
     * @param $serviceId
     * @return mixed
     * @throws \Exception
     */
    public static function updateImage($imageId, $serviceId)
    {
        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update(['image' => $imageId])
            ->where('entity_id', (int) $serviceId)
            ->execute();
    }

    public static function updateService(ServiceModel $service, $serviceId)
    {
        $data = [
            'title' => $service->getTitle(),
            'title_ka' => $service->getTitle('ka'),
        ];

        return DAL::builder()
            ->table(self::TABLE_NAME)
            ->update($data)
            ->where('entity_id', (int) $serviceId)
            ->execute();
    }

    /**
     * @throws \Exception
     */
    public static function unsetOwnerForServices($ownerId)
    {
        // TODO ?
        return DAL::builder()
            ->table('service_entity')
            ->update(['owner_id' => null])
            ->where('owner_id', (int) $ownerId)
            ->execute();
    }

    /**
     * @param $services
     * @return array
     */
    public static function buildServices($services)
    {
        $result = [];
        foreach ($services as $service) {
            $result[$service['entity_id']] = new ServiceModel($service);
        }

        return $result;
    }
}