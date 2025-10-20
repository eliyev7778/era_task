<?php

namespace Modules\Campaign\App\Actions;

use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;
use Modules\Campaign\App\Tasks\CalculateTotalRecipientsTask;

class CreateCampaignAction
{
    public function __construct(
        protected readonly CampaignRepositoryInterface $campaignRepository,
        protected readonly CalculateTotalRecipientsTask $calculateTotalRecipientsTask
    ) {}

    public function execute(array $data)
    {
        $data['total_recipients'] = $this->calculateTotalRecipientsTask->run(
            $data['segment_id'] ?? null,
            $data['filter_json'] ?? null
        );

        $data['status'] = 'draft';

        return $this->campaignRepository->create($data);
    }
}
