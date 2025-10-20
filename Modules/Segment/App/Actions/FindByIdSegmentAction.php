<?php

namespace Modules\Segment\App\Actions;

use Modules\Segment\App\Models\Segment;
use Modules\Segment\App\Tasks\FindByIdSegmentTask;


class FindByIdSegmentAction
{
    public function __construct(
        protected readonly FindByIdSegmentTask $findByIdSegmentTask,
    ) {}

    public function execute(int $id): Segment
    {
        return $this->findByIdSegmentTask->run($id);
    }
}
