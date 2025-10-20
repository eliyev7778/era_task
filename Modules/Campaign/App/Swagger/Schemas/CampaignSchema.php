<?php

namespace Modules\Campaign\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="CreateCampaignRequest",
 *     required={"subject", "template_key"},
 *     @OA\Property(property="name", type="string", example="New Year Promo"),
 *     @OA\Property(property="subject", type="string", example="Happy New Year!"),
 *     @OA\Property(property="template_key", type="string", example="discount"),
 *     @OA\Property(property="from_email", type="string", example="admin@example.com"),
 *     @OA\Property(property="segment_id", type="integer", example=1),
 *     @OA\Property(property="filter_json", type="object", example={})
 * )
 *
 * @OA\Schema(
 *     schema="CreateCampaignResponse",
 *     @OA\Property(property="id", type="integer", example=10),
 *     @OA\Property(property="status", type="string", example="draft"),
 *     @OA\Property(property="total_recipients", type="integer", example=2841)
 * )
 */
class CampaignSchema {}
