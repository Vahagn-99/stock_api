<?php

declare(strict_types=1);


namespace App\Base\Activity;

use App\Models\Organization as OrganizationModel;
use App\Base\Organization\Repositories\CachedRepository as OrganizationCachedRepository;
use Illuminate\Support\Collection;

class Manager
{
    /**
     * @param \App\Base\Organization\Repositories\CachedRepository $cached_organization_repository
     */
    public function __construct(
        private readonly OrganizationCachedRepository $cached_organization_repository
    ) {
        //
    }

    /**
     * Поиск организаций по id деятельности
     *
     * @param int $activity_id
     * @return Collection<OrganizationModel>
     */
    public function getOrganizationsById(int $activity_id): Collection
    {
        return $this->cached_organization_repository->getByActivityId($activity_id);
    }
}
