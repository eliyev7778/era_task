<?php

namespace Modules\Campaign\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="CampaignResponse",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Holiday Promo"),
 *     @OA\Property(property="subject", type="string", example="Special Discount!"),
 *     @OA\Property(property="template_key", type="string", example="promotion"),
 *     @OA\Property(property="from_email", type="string", example="marketing@example.com"),
 *     @OA\Property(property="segment_id", type="integer", example=5),
 *     @OA\Property(property="status", type="string", example="draft"),
 *     @OA\Property(property="total_recipients", type="integer", example=1000),
 *     @OA\Property(property="sent_count", type="integer", example=0),
 *     @OA\Property(property="error_count", type="integer", example=0),
 *     @OA\Property(property="created_at", type="string", example="2025-10-20T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", example="2025-10-20T12:00:00Z")
 * )
 */
class GetCampaignSchema {}
