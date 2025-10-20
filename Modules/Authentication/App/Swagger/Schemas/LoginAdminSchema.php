<?php

namespace Modules\Authentication\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="LoginAdminRequest",
 *     required={"email", "password"},
 *     @OA\Property(property="email", type="string", example="admin@example.com"),
 *     @OA\Property(property="password", type="string", example="password123")
 * )
 *
 * @OA\Schema(
 *     schema="LoginAdminResponse",
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
 *     schema="LoginErrorResponse",
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Invalid credentials")
 * )
 */
class LoginAdminSchema {}
