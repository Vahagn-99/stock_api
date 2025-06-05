<?php

declare(strict_types=1);


namespace App\Base\Building;

use App\Models\Building as BuildingModel;
use App\Repository\Base;

class Repository extends Base
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return BuildingModel::class;
    }
}
