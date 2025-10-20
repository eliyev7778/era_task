<?php

namespace Modules\Segment\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="CreateSegmentSchema",
 *     title="Create Segment",
 *     description="Yeni bir seqment yaratmaq üçün məlumat strukturu",
 *     required={"name", "filter_json"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Aktiv istifadəçilər"
 *     ),
 *     @OA\Property(
 *         property="filter_json",
 *         type="object",
 *         example={
 *             "user": {
 *                 "email_verified": true,
 *                 "marketing_opt_in": false
 *             },
 *             "product": {
 *                 "price_min": 10,
 *                 "price_max": 100
 *             }
 *         }
 *     )
 * )
 */
class CreateSegmentSchema {}
