<?php

namespace App\Http\Controllers;

use App\Base\Organization\Manager as OrganizationManager;
use App\Base\Organization\Search\SearchDto;
use App\Http\Resources\Organization as OrganizationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use OpenApi\Annotations as OA;

class OrganizationController extends Controller
{
    /**
     * @param OrganizationManager $organization_manager
     */
    public function __construct(
        private readonly OrganizationManager $organization_manager
    ) {
        //
    }

    /**
     * @OA\Get(
     *       path="/api/organizations/{id}",
     *       summary="Получить организацию по ID",
     *       description="Возвращает организацию по ID",
     *       operationId="getOrganizationById",
     *       tags={"Organizations"},
     *       security={{"ApiKeyAuth":{}}},
     *
     *       @OA\Parameter(
     *           name="id",
     *           in="path",
     *           description="ID организации",
     *           required=true,
     *           @OA\Schema(type="integer", example=1)
     *       ),
     *
     *       @OA\Response(
     *           response=200,
     *           description="Организация",
     *           @OA\JsonContent(
     *               type="array",
     *               @OA\Items(ref="#/components/schemas/Organization")
     *           )
     *       ),
     *       @OA\Response(
     *           response=401,
     *           description="Неавторизован",
     *           @OA\JsonContent(
     *               @OA\Property(property="message", type="string", example="API key required")
     *           )
     *       )
     *   )
     *
     * Возвращает организацию по id.
     *
     * @param int $id
     * @return \App\Http\Resources\Organization
     */
    public function item(int $id): OrganizationResource
    {
        if (empty($organization = $this->organization_manager->getById($id))) {
            abort(404);
        }

        return OrganizationResource::make($organization);
    }


    /**
     * @OA\Get(
     *     path="/api/organizations/search",
     *     summary="Поиск организаций",
     *     description="Поиск организаций по тексту, координатам, адресу здания и активности.",
     *     operationId="getOrganizationsBySearch",
     *     tags={"Organizations"},
     *     security={{"ApiKeyAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         description="Поисковый текст (например, часть названия)",
     *         required=false,
     *         @OA\Schema(type="string", example="Поликлиника")
     *     ),
     *     @OA\Parameter(
     *         name="coordinates[latitude]",
     *         in="query",
     *         description="Широта для геопоиска",
     *         required=false,
     *         @OA\Schema(type="number", format="float", example=40.1792)
     *     ),
     *     @OA\Parameter(
     *         name="coordinates[longitude]",
     *         in="query",
     *         description="Долгота для геопоиска",
     *         required=false,
     *         @OA\Schema(type="number", format="float", example=44.4991)
     *     ),
     *     @OA\Parameter(
     *         name="coordinates[radius]",
     *         in="query",
     *         description="Радиус поиска в метрах",
     *         required=false,
     *         @OA\Schema(type="integer", example=1000)
     *     ),
     *     @OA\Parameter(
     *         name="building[address]",
     *         in="query",
     *         description="Адрес здания",
     *         required=false,
     *         @OA\Schema(type="string", example="ул. Пушкина, д. 10")
     *     ),
     *     @OA\Parameter(
     *         name="activity[name]",
     *         in="query",
     *         description="Название вида деятельности",
     *         required=false,
     *         @OA\Schema(type="string", example="Медицина")
     *     ),
     *     @OA\Parameter(
     *         name="activity[deep_search]",
     *         in="query",
     *         description="Глубокий поиск по видам деятельности",
     *         required=false,
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
     *     @OA\Response(
     *         response=401,
     *         description="Неавторизован",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="API key required")
     *         )
     *     )
     * )
     */
    public function search(Request $request): AnonymousResourceCollection
    {
        return OrganizationResource::collection($this->organization_manager->search(SearchDto::validateAndCreate($request->all())));
    }
}
