<?php

namespace Modules\Campaign\App\Tasks;

use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;

class GetCampaignTask
{
    public function __construct(
        private readonly CampaignRepositoryInterface $campaignRepository
    ) {}

    public function run(int $id)
    {
        return $this->campaignRepository->find($id);
    }
}
