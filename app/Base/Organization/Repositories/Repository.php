<?php

declare(strict_types=1);


namespace App\Base\Organization\Repositories;

use App\Models\{
    Building as BuildingModel,
    Organization as OrganizationModel,
    Activity as ActivityModel,
};
use App\Repository\Base;
use App\Base\Organization\Search\SearchDto;
use DB;
use Illuminate\Database\Eloquent\Collection;

class Repository extends Base
{
    /**
     * Класс модели репозитория.
     *
     * @return string
     */
    protected function getModelClassName() : string
    {
        return OrganizationModel::class;
    }

    /**
     * Найти организации
     *
     * @param \App\Base\Organization\Search\SearchDto $search
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Organization>
     */
    public function search(SearchDto $search) : Collection
    {
        return $this->query()->select(OrganizationModel::TABLE.'.*')
            ->when($search->text, fn($query) => $query->where(OrganizationModel::TABLE.'.name', 'like', "%{$search->text}%"))
            ->when($search->activity, function ($query) use ($search) {
                $query->whereHas('activities', function ($query) use ($search) {
                    $query->where(ActivityModel::TABLE.'.name', 'like', "%{$search->activity->name}%");

                    if ($search->activity->deep_search) {
                        $query->orWhereHas('children', function ($query) use ($search) {
                            $query->where(ActivityModel::TABLE.'.name', 'like', "%{$search->activity->name}%")
                                ->orWhereHas('children', function ($query) use ($search) {
                                    $query->where(ActivityModel::TABLE.'.name', 'like', "%{$search->activity->name}%");
                                });
                        });
                    }
                });
            })
            ->when($search->building, fn($query) => $query->whereRelation('building',BuildingModel::TABLE.'.address', 'like', "%{$search->building->address}%"))
            ->when($search->coordinates, function ($query) use ($search) {
                $query->join(BuildingModel::TABLE, OrganizationModel::TABLE.'.building_id', '=', BuildingModel::TABLE.'.id')
                    ->addSelect(DB::raw("(
                    6371 * acos(
                        cos(radians(?)) *
                        cos(radians(".BuildingModel::TABLE.".latitude)) *
                        cos(radians(".BuildingModel::TABLE.".longitude) - radians(?)) +
                        sin(radians(?)) *
                        sin(radians(".BuildingModel::TABLE.".latitude))
                    )
                ) AS distance"))
                    ->addBinding([
                        $search->coordinates->latitude,
                        $search->coordinates->longitude,
                        $search->coordinates->latitude,
                    ], 'select')
                    ->having('distance', '<=', $search->coordinates->radius)
                    ->orderBy('distance');
            })
            ->get();
    }

    /**
     * Поиск организаций по id здания
     *
     * @param int $building_id
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Organization>
     */
    public function getByBuildingId(int $building_id) : Collection
    {
        return $this->query()->where('building_id', $building_id)->get();
    }

    /**
     * Поиск организаций по id деятельности с глубоким поиском
     *
     * @param int $activity_id
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Organization>
     */
    public function getByActivityId(int $activity_id) : Collection
    {
        return $this->query()->whereHas('activities', function ($query) use ($activity_id) {
            $query->where('activity_id', $activity_id);
            $query->orWhereHas('children', function ($query) use ($activity_id) {
                $query->where('activity_id', $activity_id);
                $query->orWhereHas('children', function ($query) use ($activity_id) {
                    $query->where('activity_id', $activity_id);
                });
            });
        })->get();
    }
}
