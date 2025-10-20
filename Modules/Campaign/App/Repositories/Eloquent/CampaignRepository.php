<?php

namespace Modules\Campaign\App\Repositories\Eloquent;

use Modules\Campaign\App\Models\Campaign;
use Modules\Campaign\App\Repositories\Contracts\CampaignRepositoryInterface;

class CampaignRepository implements CampaignRepositoryInterface
{
    protected Campaign $model;

    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Campaign
    {
        return $this->model->create($data);
    }

    public function find(int $id): Campaign
    {
        return $this->model->find($id);
    }

    public function query(): \Illuminate\Database\Eloquent\Builder
    {
        return $this->model->query();
    }
}
