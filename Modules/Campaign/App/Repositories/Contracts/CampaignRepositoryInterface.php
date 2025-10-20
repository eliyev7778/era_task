<?php

namespace Modules\Campaign\App\Repositories\Contracts;

interface CampaignRepositoryInterface
{
    public function create(array $data);

    public function find(int $id);
    public function query();

}
