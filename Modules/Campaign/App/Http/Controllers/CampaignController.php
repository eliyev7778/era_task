<?php

namespace Modules\Campaign\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Modules\Campaign\App\Actions\CreateCampaignAction;
use Modules\Campaign\App\Actions\GetCampaignAction;
use Modules\Campaign\App\Actions\GetCampaignsAction;
use Modules\Campaign\App\Actions\GetCampaignStatusAction;
use Modules\Campaign\App\Actions\QueueCampaignAction;
use Modules\Campaign\App\Actions\TestSendCampaignAction;
use Modules\Campaign\App\Actions\UnsubscribeAction;
use Modules\Campaign\App\Http\Requests\CreateCampaignRequest;
use Modules\Campaign\App\Http\Requests\TestSendCampaignRequest;
use Modules\Campaign\App\resources\CampaignResource;


class CampaignController extends Controller
{
    public function __construct(
        protected readonly CreateCampaignAction $createCampaignAction,
        protected readonly QueueCampaignAction $queueCampaignAction,
        protected readonly UnsubscribeAction $unsubscribeAction,
        protected readonly GetCampaignAction $getCampaignAction,
        protected readonly GetCampaignStatusAction $getCampaignStatusAction,
        protected readonly GetCampaignsAction $getCampaignsAction,
        protected readonly TestSendCampaignAction $testSendCampaignAction,
    ) {}


    /**
     * @OA\Get(
     *     path="/api/v1/campaigns",
     *     summary="Get paginated list of campaigns",
     *     tags={"Campaigns"},
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *         description="Filter by status (draft|queued|sending|done|failed)",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=false,
     *         description="Page number for pagination",
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=false,
     *         description="Items per page",
     *         @OA\Schema(type="integer", default=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of campaigns",
     *         @OA\JsonContent(ref="#/components/schemas/CampaignListResponse")
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $filters = request()->only(['status', 'page', 'per_page']);
        $campaigns = $this->getCampaignsAction->execute($filters);

        return response()->json($campaigns);
    }


    /**
     * @OA\Post(
     *     path="/api/v1/campaigns",
     *     summary="Create a new campaign",
     *     tags={"Campaign"},
     *     security={{"passport": {}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateCampaignRequest")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Campaign created",
     *         @OA\JsonContent(ref="#/components/schemas/CreateCampaignResponse")
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(CreateCampaignRequest $request): JsonResponse
    {
        $idempotencyKey = request()->header('Idempotency-Key');
        if ($existing = Cache::get('campaign_'.$idempotencyKey)) {
            return response()->json($existing);
        }
        $campaign = $this->createCampaignAction->execute($request->validated());
        Cache::put('campaign_'.$idempotencyKey, $campaign, now()->addMinutes(5));
        return response()->json(CampaignResource::make($campaign));
    }

    /**
     * @OA\Post(
     *     path="/api/v1/campaigns/{id}/queue",
     *     summary="Queue a campaign to start sending emails",
     *     tags={"Campaign"},
     *     security={{"passport": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Campaign queued",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=10),
     *             @OA\Property(property="status", type="string", example="queued")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Campaign not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Campaign not found")
     *         )
     *     )
     * )
     */
    public function queue(int $id): JsonResponse
    {
        $campaign = $this->queueCampaignAction->execute($id);
        return response()->json([
            'id' => $campaign->id,
            'status' => $campaign->status,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/unsubscribe/{signed}",
     *     summary="Unsubscribe from marketing emails",
     *     tags={"Campaigns"},
     *     security={},
     *     @OA\Parameter(
     *         name="signed",
     *         in="path",
     *         required=true,
     *         description="Signed unsubscribe token",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successfully unsubscribed"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid or expired link"
     *     )
     * )
     */
    public function unsubscribe(string $signed): JsonResponse
    {
        $success = $this->unsubscribeAction->execute($signed);

        if ($success) {
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Invalid or expired link'], 400);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/campaigns/{id}",
     *     summary="Get a single campaign",
     *     tags={"Campaigns"},
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Campaign ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Campaign data",
     *         @OA\JsonContent(ref="#/components/schemas/CampaignResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Campaign not found"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $campaign = $this->getCampaignAction->execute($id);
        return response()->json(CampaignResource::make($campaign));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/campaigns/{id}/status",
     *     summary="Get campaign statistics",
     *     tags={"Campaigns"},
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Campaign ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Campaign stats",
     *         @OA\JsonContent(ref="#/components/schemas/CampaignStatsResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Campaign not found"
     *     )
     * )
     */
    public function status(int $id): JsonResponse
    {
        $stats = $this->getCampaignStatusAction->execute($id);
        return response()->json($stats);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/campaigns/{id}/test-send",
     *     summary="Send campaign template to a single email for testing",
     *     tags={"Campaigns"},
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Campaign ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/TestSendCampaignRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Test email sent successfully",
     *         @OA\JsonContent(ref="#/components/schemas/TestSendCampaignResponse")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function testSend(TestSendCampaignRequest $request, int $id): JsonResponse
    {
        $email = $request->validated()['email'];
        $this->testSendCampaignAction->execute($id, $email);

        return response()->json(['success' => true, 'message' => 'Test email sent successfully']);
    }
}
