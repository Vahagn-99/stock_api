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
        return md5(serialize($search));
    }

    /**
     * Получить ключ кэша для поиска организаций по id здания
     *
     * @param int $building_id
     * @return string
     */
    public static function get_by_building_id(int $building_id) : string
    {
        return md5("$building_id");
    }

    /**
     * Получить ключ кэша для поиска организаций по id деятельности
     *
     * @param int $activity_id
     * @return string
     */
    public static function get_by_activity_id(int $activity_id) : string
    {
        return md5("$activity_id");
    }

    //****************************************************************
    //************************** TAGS *****************************
    //****************************************************************

    /**
     * Получить тег кэша для поиска организаций
     *
     * @return string
     */
    public static function search_tag() : string
    {
        return 'organizations_search';
    }

    /**
     * Получить тег кэша для поиска организаций по id здания
     *
     * @return string
     */
    public static function get_by_building_id_tag() : string
    {
        return 'organizations_by_building_id';
    }

    /**
     * Получить тег кэша для поиска организаций по id деятельности
     *
     * @return string
     */
    public static function get_by_activity_id_tag() : string
    {
        return 'organizations_by_activity_id';
    }
}
