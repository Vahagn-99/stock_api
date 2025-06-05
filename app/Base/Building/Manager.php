<?php

declare(strict_types=1);


namespace App\Base\Building;

use App\Base\Organization\Repositories\CachedRepository as OrganizationCachedRepository;
use App\Models\Organization as OrganizationModel;
use Illuminate\Database\Eloquent\Collection;

class Manager
{
    /**
     * @param \App\Base\Building\Repository $building_repository
     * @param \App\Base\Organization\Repositories\CachedRepository $cached_organization_repository
     */
    public function __construct(
        private readonly Repository $building_repository,
        private readonly OrganizationCachedRepository $cached_organization_repository
    ) {
        //
    }

    /**
     * Получить все записи зданий.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll() : Collection
    {
        return $this->building_repository->getAll();
    }

    /**
     * Поиск организаций по id здания
     *
     * @param int $building_id
     * @return \Illuminate\Support\Collection<OrganizationModel>
     */
    public function getOrganizationsById(int $building_id): Collection
    {
        return $this->cached_organization_repository->getByBuildingId($building_id);
    }
}
