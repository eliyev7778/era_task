<?php

namespace Modules\Campaign\App\Tasks;

use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;

class GetCampaignStatusTask
{
    public function __construct(
        private readonly CampaignRepositoryInterface $campaignRepository
    ) {}

    public function execute(int $id): array
    {
        $campaign = $this->campaignRepository->find($id);

        return [
            'total_recipients' => $campaign->total_recipients,
            'sent_count'       => $campaign->sent_count,
            'error_count'      => $campaign->error_count,
            'status'           => $campaign->status,
        ];
    }
}
