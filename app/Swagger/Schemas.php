<?php

namespace App\Swagger;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Stock api",
 *     version="1.0.0",
 *     description="REST API приложения для справочника Организаций, Зданий, Деятельности",
 *     @OA\Contact(
 *         email="vahagn99ghukasyan@gmail.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *      securityScheme="ApiKeyAuth",
 *      type="apiKey",
 *      in="header",
 *      name="Authorization",
 *      description="Авторизация по заголовку: Authorization: Api-Key {token}"
 *  )
 *
 */
class Schemas { }