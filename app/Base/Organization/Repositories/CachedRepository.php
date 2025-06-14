<?php

declare(strict_types=1);


namespace App\Base\Organization\Repositories;

use App\Base\Organization\Search\SearchDto;
use Cache;
use Illuminate\Database\Eloquent\Collection;

class CachedRepository extends Repository
{
    /**
     * Найти организации по поиску
     *
     * @param \App\Base\Organization\Search\SearchDto $search
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Organization>
     */
    public function search(SearchDto $search) : Collection
    {
        return Cache::tags(CacheKeys::search_tag())->remember(CacheKeys::search($search), now()->addDays(30), function () use ($search) {
            return parent::search($search);
        });
    }

    /**
     * Поиск организаций по id здания
     *
     * @param int $building_id
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Organization>
     */
    public function getByBuildingId(int $building_id) : Collection
    {
        return Cache::tags(CacheKeys::get_by_building_id_tag())->remember(CacheKeys::get_by_building_id($building_id), now()->addDays(30), function () use ($building_id) {
            return parent::getByBuildingId($building_id);
        });
    }

    /**
     * Поиск организаций по id деятельности
     *
     * @param int $activity_id
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Organization>
     */
    public function getByActivityId(int $activity_id) : Collection
    {
        return Cache::tags(CacheKeys::get_by_activity_id_tag())->remember(CacheKeys::get_by_activity_id($activity_id), now()->addDays(30), function () use ($activity_id) {
            return parent::getByActivityId($activity_id);
        });
    }
}
