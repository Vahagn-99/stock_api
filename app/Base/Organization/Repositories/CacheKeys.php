<?php

declare(strict_types=1);


namespace App\Base\Organization\Repositories;

use App\Base\Organization\Search\SearchDto;

class CacheKeys
{
    /**
     * Получить ключ кэша для поиска организаций
     *
     * @param \App\Base\Organization\Search\SearchDto $search
     * @return string
     */
    public static function search(SearchDto $search) : string
    {
        return md5($search.'organization_search');
    }

    /**
     * Получить ключ кэша для поиска организаций по id здания
     *
     * @param int $building_id
     * @return string
     */
    public static function getByBuildingId(int $building_id) : string
    {
        return md5($building_id.'organization_by_building_id');
    }

    /**
     * Получить ключ кэша для поиска организаций по id деятельности
     *
     * @param int $activity_id
     * @return string
     */
    public static function getByActivityId(int $activity_id) : string
    {
        return md5($activity_id.'organization_by_activity_id');
    }
}
