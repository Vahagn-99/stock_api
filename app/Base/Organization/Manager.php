<?php

declare(strict_types=1);


namespace App\Base\Organization;

use App\Models\Organization as OrganizationModel;
use App\Base\Organization\Repositories\{
    CachedRepository,
    Repository,
};
use App\Base\Organization\Search\SearchDto;
use Illuminate\Support\Collection;

class Manager
{
    /**
     * @param Repository $organization_repository
     * @param \App\Base\Organization\Repositories\CachedRepository $cached_organization_repository
     */
    public function __construct(
        private readonly Repository $organization_repository,
        private readonly CachedRepository $cached_organization_repository
    ) {
        //
    }

    /**
     * Найти организацию по id
     *
     * @param int $id
     * @return \App\Models\Organization|null
     */
    public function getById(int $id): ?OrganizationModel
    {
        /** @var OrganizationModel */
        return $this->organization_repository->find($id);
    }

    /**
     * Поиск организаций
     *
     * @param \App\Base\Organization\Search\SearchDto $search
     * @return Collection<OrganizationModel>
     */
    public function search(SearchDto $search): Collection
    {
        return $this->cached_organization_repository->search($search);
    }
}
