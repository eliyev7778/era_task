<?php

namespace Modules\Campaign\App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class HealthController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/health",
     *     summary="Check API health",
     *     tags={"Health"},
     *     @OA\Response(
     *         response=200,
     *         description="API is healthy",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="API is healthy")
     *         )
     *     )
     * )
     */
    public function api(): JsonResponse
    {
        try {
            DB::connection()->getPdo();
            return response()->json(['success' => true, 'message' => 'API is healthy']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'API is unhealthy', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/health/queue",
     *     summary="Check queue health",
     *     tags={"Health"},
     *     @OA\Response(
     *         response=200,
     *         description="Queue system is healthy",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Queue system is healthy")
     *         )
     *     )
     * )
     */
    public function queue(): JsonResponse
    {
        try {
            Queue::getConnection()->getQueue(env('QUEUE_CONNECTION', false));
            return response()->json(['success' => true, 'message' => 'Queue system is healthy']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Queue system is unhealthy', 'error' => $e->getMessage()], 500);
        }
    }
}
