<?php

namespace App\Http\Controllers;

use App\Base\Building\Manager as BuildingManager;
use App\Base\Organization\Manager as OrganizationManager;
use App\Http\Resources\Building as BuildingResource;
use App\Http\Resources\Organization as OrganizationResource;
use OpenApi\Annotations as OA;

class BuildingController extends Controller
{
    /**
     * @param BuildingManager $building_manager
     * @param \App\Base\Organization\Manager $organization_manager
     */
    public function __construct(
        private readonly BuildingManager $building_manager,
        private readonly OrganizationManager $organization_manager,
    ) {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/buildings",
     *      summary="Получить список всех зданий",
     *      description="Возвращает список зданий из справочника",
     *      operationId="getBuildings",
     *      tags={"Buildings"},
     *      security={{"ApiKeyAuth":{}}},
     *
     *      @OA\Response(
     *          response=200,
     *          description="Список зданий",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Building")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Неавторизован",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="API key required")
     *          )
     *      )
     *  )
     *
     * Возвращает список зданий.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function list()
    {
        return BuildingResource::collection($this->building_manager->getAll());
    }

    /**
     * @OA\Get(
     *      path="/api/buildings/{id}/organizations",
     *      summary="Получить организации по ID здания",
     *      description="Возвращает список организаций, находящихся в указанном здании",
     *      operationId="getOrganizationsByBuilding",
     *      tags={"Buildings"},
     *      security={{"ApiKeyAuth":{}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="ID здания",
     *          required=true,
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Список организаций",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Organization")
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Неавторизован",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="API key required")
     *          )
     *      )
     *  )
     *
     * Возвращает список организаций по id здания.
     *
     * @param int $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function organizations(int $id)
    {
        return OrganizationResource::collection($this->organization_manager->getByBuildingId($id));
    }
}
