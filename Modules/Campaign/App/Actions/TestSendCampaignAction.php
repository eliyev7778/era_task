<?php

namespace Modules\Campaign\App\Actions;

use Modules\Campaign\App\Emails\CampaignMail;
use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class TestSendCampaignAction
{
    public function __construct(
        private readonly CampaignRepositoryInterface $campaignRepository
    ) {}

    public function execute(int $campaignId, string $email): void
    {
        $campaign = $this->campaignRepository->find($campaignId);

        Mail::to($email)->send(new CampaignMail($campaign, $campaign->template_key));
    }
}
