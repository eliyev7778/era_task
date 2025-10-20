<?php

namespace Modules\Authentication\App\Tasks;

use Modules\Authentication\App\Models\Admin;
use Modules\Authentication\App\Repositories\Contracts\AdminRepositoryInterface;

class CreateAdminTask
{
    public function __construct(
        private readonly AdminRepositoryInterface $adminRepository
    ) {}

    public function run($data): Admin
    {
        return $this->adminRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
        ]);
    }
}
