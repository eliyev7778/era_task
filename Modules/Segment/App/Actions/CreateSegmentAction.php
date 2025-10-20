<?php

namespace Modules\Segment\App\Actions;

use Modules\Segment\App\Http\Requests\CreateSegmentRequest;
use Modules\Segment\App\Models\Segment;
use Modules\Segment\App\Tasks\CreateSegmentTask;


class CreateSegmentAction
{
    public function __construct(
        protected readonly CreateSegmentTask $createSegmentTask,
    ) {}

    public function execute(CreateSegmentRequest $request): Segment
    {
        $data = $request->validated();
        return $this->createSegmentTask->run($data);
    }
}
