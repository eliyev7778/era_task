<?php

namespace Modules\Segment\App\Actions;


use Modules\Segment\App\Tasks\ListSegmentsTask;

class ListSegmentsAction
{
    public function __construct(private readonly ListSegmentsTask $listSegmentsTask)
    {
    }

    public function execute(int $perPage = 10)
    {
        return $this->listSegmentsTask->execute($perPage);
    }
}
