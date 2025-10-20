<?php

namespace Modules\Authentication\App\Actions;


use Modules\Authentication\App\Http\Requests\LoginRequest;
use Modules\Authentication\App\Tasks\CreateAminTokenTask;
use Modules\Authentication\App\Tasks\FindAdminTask;
use Modules\Authentication\App\Tasks\LoginAdminTask;


class LoginAdminAction
{
    public function __construct(
        protected readonly LoginAdminTask      $loginAdminTask,
        protected readonly CreateAminTokenTask $createAminTokenTask,
        protected readonly FindAdminTask       $findAdminTask,
    ) {}

    public function execute(LoginRequest $request): array
    {
        $data = $request->validated();
        $isLoginAdmin = $this->loginAdminTask->run($data);
        if (!$isLoginAdmin) {
            return [];
        }
        $admin = $this->findAdminTask->run("email",$data['email']);
        $token = $this->createAminTokenTask->run($admin);

        return ['admin' => $admin, 'token' => $token];
    }
}
