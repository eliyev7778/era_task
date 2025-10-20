<?php

namespace Modules\Authentication\App\Tasks;

use Illuminate\Support\Facades\Auth;
use Modules\Authentication\App\Models\Admin;
use Modules\Authentication\App\Repositories\Contracts\AdminRepositoryInterface;

class FindAdminTask
{
    public function __construct(
        private readonly AdminRepositoryInterface $adminRepository
    ) {}

    public function run(string $column, $value): Admin
    {
        return $this->adminRepository->findBy($column, $value);
    }
}
