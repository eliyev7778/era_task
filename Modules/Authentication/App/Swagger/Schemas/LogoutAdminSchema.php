<?php

namespace Modules\Authentication\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="LogoutAdminResponse",
 *     @OA\Property(property="success", type="boolean", example=true)
 * )
 *
 * @OA\Schema(
 *     schema="LogoutErrorResponse",
 *     @OA\Property(property="message", type="string", example="Unauthenticated.")
 * )
 */
class LogoutAdminSchema {}
