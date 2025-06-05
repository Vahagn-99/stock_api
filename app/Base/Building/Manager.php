<?php

declare(strict_types=1);


namespace App\Base\Building;

use Illuminate\Database\Eloquent\Collection;

class Manager
{
    /**
     * @param \App\Base\Building\Repository $organization_repository
     */
    public function __construct(
        private readonly Repository $building_repository
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
}
