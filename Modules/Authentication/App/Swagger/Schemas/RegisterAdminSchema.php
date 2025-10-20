<?php

namespace Modules\Authentication\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="RegisterAdminRequest",
 *     required={"name", "email", "password"},
 *     @OA\Property(property="name", type="string", example="Sadig Bahlulzada"),
 *     @OA\Property(property="email", type="string", example="admin@example.com"),
 *     @OA\Property(property="password", type="string", example="password123")
 * )
 *
 * @OA\Schema(
 *     schema="RegisterAdminResponse",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="token", type="string", example="1|abcde12345"),
 *     @OA\Property(property="data", type="object",
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Sadig Bahlulzada"),
 *         @OA\Property(property="email", type="string", example="admin@example.com")
 *     )
 * )
 *
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Something went wrong"),
 *     @OA\Property(property="error", type="string", example="Server Error")
 * )
 */
class RegisterAdminSchema {}
