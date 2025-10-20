<?php

namespace Modules\Campaign\App\Swagger\Schemas;

/**
 * @OA\Schema(
 *     schema="TestSendCampaignRequest",
 *     required={"email"},
 *     @OA\Property(property="email", type="string", format="email", example="test@example.com")
 * )

* @OA\Schema(
 *     schema="TestSendCampaignResponse",
 *     @OA\Property(property="success", type="boolean", example=true),
 *     @OA\Property(property="message", type="string", example="Test email sent successfully")
* )
 */
class TestSendCampaignRequestSchema {}
