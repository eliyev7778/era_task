<?php

namespace Modules\Campaign\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="CampaignListResponse",
 *     type="object",
 *     @OA\Property(property="data", type="array",
 *         @OA\Items(ref="#/components/schemas/CampaignStatsResponse")
 *     ),
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(property="per_page", type="integer", example=15),
 *     @OA\Property(property="total", type="integer", example=100),
 *     @OA\Property(property="last_page", type="integer", example=7)
 * )
 */
class CampaignListSchema {}
