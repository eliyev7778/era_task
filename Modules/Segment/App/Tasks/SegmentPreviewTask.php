<?php

namespace Modules\Segment\App\Tasks;

use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;
use Modules\Segment\App\Repositories\Contracts\UserRepositoryInterface;

class SegmentPreviewTask
{
    public function __construct(
        private readonly SegmentRepositoryInterface $segmentRepository,
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function run($id): array
    {
        $segment = $this->segmentRepository->findById($id);
        if (!$segment) {
            return [
                'total_recipients' => 0,
                'sample' => [],
            ];
        }
        $filter = $segment->filter_json;
        return $this->userRepository->getUsersBySegment($filter);

    }
}
