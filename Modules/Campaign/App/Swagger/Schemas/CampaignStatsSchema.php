<?php

namespace Modules\Campaign\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="CampaignStatsResponse",
 *     type="object",
 *     @OA\Property(property="total_recipients", type="integer", example=1000),
 *     @OA\Property(property="sent_count", type="integer", example=800),
 *     @OA\Property(property="error_count", type="integer", example=5),
 *     @OA\Property(property="status", type="string", example="sending")
 * )
 */
class CampaignStatsSchema {}
