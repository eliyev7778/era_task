<?php

namespace Modules\Campaign\App\Tasks;

use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;

class GetCampaignsTask
{
    public function __construct(
        private CampaignRepositoryInterface $campaignRepository
    ) {}

    public function run(array $filters): array
    {
        $page = $filters['page'] ?? 1;
        $perPage = $filters['per_page'] ?? 15;
        $status = $filters['status'] ?? null;

        $query = $this->campaignRepository->query();

        if ($status) {
            $query->where('status', $status);
        }

        $paginated = $query->paginate($perPage, ['*'], 'page', $page);

        return [
            'data' => $paginated->items(),
            'current_page' => $paginated->currentPage(),
            'per_page' => $paginated->perPage(),
            'total' => $paginated->total(),
            'last_page' => $paginated->lastPage(),
        ];
    }
}
