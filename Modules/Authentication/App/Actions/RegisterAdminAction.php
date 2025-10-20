<?php

namespace Modules\Authentication\App\Actions;


use Modules\Authentication\App\Http\Requests\RegisterRequest;
use Modules\Authentication\App\Tasks\CreateAdminTask;
use Modules\Authentication\App\Tasks\CreateAminTokenTask;


class RegisterAdminAction
{
    public function __construct(
        protected readonly CreateAdminTask $createAdminTask,
        protected readonly CreateAminTokenTask $createAminTokenTask
    ) {}

    public function execute(RegisterRequest $request): array
    {
        $data = $request->validated();
        $admin = $this->createAdminTask->run($data);

        $token = $this->createAminTokenTask->run($admin);

        return ['admin' => $admin, 'token' => $token];
    }
}
