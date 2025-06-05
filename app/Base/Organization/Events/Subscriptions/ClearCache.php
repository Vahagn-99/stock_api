<?php

declare(strict_types=1);

namespace App\Base\Organization\Events\Subscriptions;

use App\Base\Activity\Events\{
    ActivityDeleted,
    ActivitySaved,
};
use App\Base\Organization\Repositories\CacheKeys;
use App\Base\Building\Events\{
    BuildingDeleted,
    BuildingSaved,
};
use App\Base\Organization\Events\{
    OrganizationDeleted,
    OrganizationSaved,
};
use App\Listener\QueueableListener;
use Cache;
use Illuminate\Events\Dispatcher;

final class ClearCache extends QueueableListener
{
    /**
     * Очистка кэша при сохранении активности и удалении.
     *
     * @param \App\Base\Activity\Events\ActivitySaved|\App\Base\Activity\Events\ActivityDeleted $event
     * @return void
     */
    public function handleActivity(ActivitySaved|ActivityDeleted $event) : void
    {
        $this->clearCache('get_by_activity_id', $event->id);

        $this->clearSearchCache();
    }

    /**
     * Очистка кэша при сохранении здания и удалении.
     *
     * @param \App\Base\Building\Events\BuildingSaved|\App\Base\Building\Events\BuildingDeleted $event
     * @return void
     */
    public function handleBuilding(BuildingSaved|BuildingDeleted $event) : void
    {
        $this->clearCache('get_by_building_id', $event->id);

        $this->clearSearchCache();
    }

    /**
     * Очистка кэша при сохранении организации и удалении.
     *
     * @param \App\Base\Organization\Events\OrganizationSaved|\App\Base\Organization\Events\OrganizationDeleted $event
     * @return void
     */
    public function handleOrganization(OrganizationSaved|OrganizationDeleted $event) : void
    {
        $this->clearSearchCache();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @return array<string, string>
     */
    public function subscribe(Dispatcher $events) : array
    {
        return [
            ActivitySaved::class => "handleActivity",
            ActivityDeleted::class => "handleActivity",
            BuildingSaved::class => "handleBuilding",
            BuildingDeleted::class => "handleBuilding",
            OrganizationSaved::class => "handleOrganization",
            OrganizationDeleted::class => "handleOrganization",
        ];
    }

    //****************************************************************
    //************************** Support *****************************
    //****************************************************************

    /**
     * Очистка кэша репозитория организацией.
     *
     * @param string $cache_method_name
     * @param int|null $id
     * @return void
     */
    private function clearCache(string $cache_method_name, ?int $id=null) : void
    {
        Cache::tags([$cache_method_name.'_tag'])->forget(CacheKeys::$cache_method_name($id));
    }

    /**
     * Очистка кэша поиска организаций.
     *
     * @return void
     */
    public function clearSearchCache(): void
    {
        Cache::tags(['organization_search'])->flush();
    }
}
