<?php

namespace Modules\Segment\App\Tasks;

use Modules\Segment\App\Models\Segment;
use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;

class CreateSegmentTask
{
    public function __construct(
        private readonly SegmentRepositoryInterface $segmentRepository
    ) {}

    public function run($data): Segment
    {
        return $this->segmentRepository->create([
            'name' => $data['name'],
            'filter_json' => $data['filter_json'],
        ]);
    }
}
