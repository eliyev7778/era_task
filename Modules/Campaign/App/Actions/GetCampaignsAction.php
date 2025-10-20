<?php

namespace Modules\Campaign\App\Actions;

use Modules\Campaign\App\Tasks\GetCampaignsTask;

class GetCampaignsAction
{
    public function __construct(protected readonly GetCampaignsTask $getCampaignsTask)
    {

    }

    public function execute($filters): array
    {
        return $this->getCampaignsTask->run($filters);
    }
}
