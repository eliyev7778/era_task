<?php

namespace Modules\Campaign\App\Tasks;

use Modules\Campaign\App\Jobs\SendCampaignJob;
use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;

class QueueCampaignTask
{
    public function __construct(protected readonly CampaignRepositoryInterface $campaignRepository)
    {
    }

    public function run(int $id)
    {
        $campaign = $this->campaignRepository->find($id);

        $campaign->status = 'queued';
        $campaign->save();

        SendCampaignJob::dispatch($campaign);

        return $campaign;
    }
}
