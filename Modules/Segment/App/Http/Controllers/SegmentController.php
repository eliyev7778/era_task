<?php

namespace Modules\Segment\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Segment\App\Actions\CreateSegmentAction;
use Modules\Segment\App\Actions\FindByIdSegmentAction;
use Modules\Segment\App\Actions\ListSegmentsAction;
use Modules\Segment\App\Actions\SegmentPreviewAction;
use Modules\Segment\App\Http\Requests\CreateSegmentRequest;
use Modules\Segment\App\resources\CreateSegmentResource;
use Modules\Segment\App\resources\SegmentResource;


class SegmentController extends Controller
{

    public function __construct(
        protected readonly CreateSegmentAction $createSegmentAction,
        protected readonly FindByIdSegmentAction $findByIdSegmentAction,
        protected readonly SegmentPreviewAction $segmentPreviewAction,
        protected readonly ListSegmentsAction $listSegmentsAction,
    )
    {
    }

    /**
     * @OA\Post(
     *     path="/api/v1/segments",
     *     summary="New segment generate",
     *     tags={"Segments"},
     *     security={{"passport": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CreateSegmentSchema")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Segment uğurla yaradıldı",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=12),
     *             @OA\Property(property="name", type="string", example="Aktiv istifadəçilər"),
     *             @OA\Property(property="filter_json", type="object", example={"user": {"email_verified": true}})
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */

    public function create(CreateSegmentRequest $request): CreateSegmentResource
    {
        $segment = $this->createSegmentAction->execute($request);
        return CreateSegmentResource::make($segment);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/segments/{id}",
     *     summary="Get segment details by ID",
     *     description="Returns a specific segment by its ID",
     *     tags={"Segments"},
     *     security={{"passport": {}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Segment ID",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Segment found",
     *         @OA\JsonContent(ref="#/components/schemas/SegmentResource")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Segment not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Segment not found")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(ref="#/components/schemas/LogoutErrorResponse")
     *     )
     * )
     */

    public function show($id): SegmentResource
    {
        $segment = $this->findByIdSegmentAction->execute($id);
        return SegmentResource::make($segment);
    }


    /**
     * @OA\Get(
     *     path="/api/v1/segments/{id}/preview",
     *     summary="Preview a segment",
     *     tags={"Segments"},
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Segment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Segment preview",
     *         @OA\JsonContent(ref="#/components/schemas/SegmentPreviewResponse")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Segment not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Segment not found")
     *         )
     *     )
     * )
     */
    public function preview(int $id): JsonResponse
    {
        $data = $this->segmentPreviewAction->execute($id);

        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/segments",
     *     summary="List all segments with pagination",
     *     tags={"Segments"},
     *     security={{"passport": {}}},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated segments list",
     *         @OA\JsonContent(ref="#/components/schemas/SegmentListResponse")
     *     )
     * )
     */
    public function list(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 10);
        $segments = $this->listSegmentsAction->execute($perPage);

        return response()->json($segments);
    }
}
