<?php

namespace Modules\Segment\App\Actions;
use Modules\Segment\App\Tasks\SegmentPreviewTask;


class SegmentPreviewAction
{
    public function __construct(
        protected readonly SegmentPreviewTask $segmentPreviewTask,
    ) {}

    public function execute(int $id)
    {
        return $this->segmentPreviewTask->run($id);
    }
}
