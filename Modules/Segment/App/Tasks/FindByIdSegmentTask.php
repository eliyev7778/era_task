<?php

namespace Modules\Segment\App\Tasks;

use Modules\Segment\App\Models\Segment;
use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;

class FindByIdSegmentTask
{
    public function __construct(
        private readonly SegmentRepositoryInterface $segmentRepository
    ) {}

    public function run($id): Segment
    {
        return $this->segmentRepository->findById($id);
    }
}
