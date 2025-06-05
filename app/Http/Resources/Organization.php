<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Organization",
 *     title="Organization",
 *     required={"id", "name", "building_id"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="ООО Рога и Копыта"),
 *     @OA\Property(property="building_id", type="integer", example=4),
 *     @OA\Property(property="phones", type="array", @OA\Items(type="string", example="8-900-123-45-67")),
 *     @OA\Property(property="activities", type="array", @OA\Items(ref="#/components/schemas/Activity")),
 * )
 */
class Organization extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
