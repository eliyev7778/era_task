<?php

namespace Modules\Campaign\App\Actions;

use Modules\Campaign\App\Tasks\QueueCampaignTask;

class QueueCampaignAction
{
    public function __construct(protected readonly QueueCampaignTask $queueCampaignTask)
    {

    }

    public function execute(int $id)
    {
       return $this->queueCampaignTask->run($id);
    }
}
