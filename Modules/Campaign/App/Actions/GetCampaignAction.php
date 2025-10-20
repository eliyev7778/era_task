<?php

namespace Modules\Campaign\App\Actions;

use Modules\Campaign\App\Tasks\GetCampaignTask;

class GetCampaignAction
{
    public function __construct(protected readonly GetCampaignTask $getCampaignTask)
    {

    }

    public function execute(int $id)
    {
        return $this->getCampaignTask->run($id);
    }
}
