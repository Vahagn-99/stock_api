<?php

namespace App\Http\Controllers;

use App\Base\Organization\Manager as OrganizationManager;
use App\Http\Resources\Organization as OrganizationResource;
use OpenApi\Annotations as OA;

class ActivityController extends Controller
{
    /**
     * @param \App\Base\Organization\Manager $organization_manager
     */
    public function __construct(
        private readonly OrganizationManager $organization_manager,
    ) {
        //
    }

    /**
     * @OA\Get(
     *     path="/api/activities/{id}/organizations",
     *     summary="Получить список организаций по ID вида деятельности",
     *     description="Возвращает список организаций, связанных с указанной деятельностью",
     *     operationId="getOrganizationsByActivity",
     *     tags={"Activities"},
     *     security={{"ApiKeyAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID вида деятельности",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Organization")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="API key required")
     *         )
     *     )
     * )
     */
    public function organizations(int $id)
    {
        return OrganizationResource::collection($this->organization_manager->getByActivityId($id));
    }
}
