<?php
namespace Modules\Segment\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="SegmentPreviewResponse",
 *     @OA\Property(property="total_recipients", type="integer", example=2841),
 *     @OA\Property(
 *         property="sample",
 *         type="array",
 *         @OA\Items(
 *             @OA\Property(property="id", type="integer", example=123),
 *             @OA\Property(property="name", type="string", example="Aylin M."),
 *             @OA\Property(property="email", type="string", example="aylin@example.com")
 *         )
 *     )
 * )
 */
class SegmentPreviewSchema {}
