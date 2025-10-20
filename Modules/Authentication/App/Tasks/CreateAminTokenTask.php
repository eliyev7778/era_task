<?php

namespace Modules\Authentication\App\Tasks;

use Modules\Authentication\App\Models\Admin;

class CreateAminTokenTask
{
    public function run(Admin $admin): string
    {
        return $admin->createToken('API_Token')->accessToken;
    }
}
