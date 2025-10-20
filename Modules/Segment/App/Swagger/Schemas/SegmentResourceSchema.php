<?php

namespace Modules\Segment\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="SegmentResource",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Active Users Segment"),
 *     @OA\Property(property="filter_json", type="object", example={"email_verified": true, "marketing_opt_in": true}),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-19T12:34:56Z")
 * )
 */
class SegmentResourceSchema {}
