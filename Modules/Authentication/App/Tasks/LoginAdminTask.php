<?php

namespace Modules\Authentication\App\Tasks;


use Illuminate\Support\Facades\Hash;
use Modules\Authentication\App\Repositories\Contracts\AdminRepositoryInterface;

class LoginAdminTask
{
    public function __construct(
        private readonly AdminRepositoryInterface $adminRepository
    ) {}

    public function run($data): bool
    {
        $admin = $this->adminRepository->findBy("email", $data["email"]);
        if (empty($admin) || !Hash::check($data['password'], $admin->password)) {
            return false;
        }
        return true;
    }
}
