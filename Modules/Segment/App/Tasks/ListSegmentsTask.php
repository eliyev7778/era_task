<?php

namespace Modules\Segment\App\Tasks;


use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;

class ListSegmentsTask
{
    public function __construct(private readonly SegmentRepositoryInterface $segmentRepository)
    {
    }

    public function execute(int $perPage = 10)
    {
        return $this->segmentRepository->getPaginated($perPage);
    }
}
