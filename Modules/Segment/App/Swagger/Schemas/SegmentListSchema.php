<?php

namespace Modules\Segment\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="SegmentListResponse",
 *     @OA\Property(property="current_page", type="integer", example=1),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Aktiv istifadəçilər"),
 *             @OA\Property(
 *                 property="filter_json",
 *                 type="object",
 *                 example={"email_verified":true, "marketing_opt_in":true}
 *             )
 *         )
 *     ),
 *     @OA\Property(property="first_page_url", type="string", example="/api/v1/segments?page=1"),
 *     @OA\Property(property="last_page", type="integer", example=5),
 *     @OA\Property(property="last_page_url", type="string", example="/api/v1/segments?page=5"),
 *     @OA\Property(property="next_page_url", type="string", example="/api/v1/segments?page=2"),
 *     @OA\Property(property="prev_page_url", type="string", example=null),
 *     @OA\Property(property="per_page", type="integer", example=10),
 *     @OA\Property(property="total", type="integer", example=50)
 * )
 */
class SegmentListSchema {}
