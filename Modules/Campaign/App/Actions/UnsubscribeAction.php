<?php

namespace Modules\Campaign\App\Actions;

use Illuminate\Support\Facades\URL;
use Modules\Segment\App\Repositories\Contracts\UserRepositoryInterface;
use Throwable;

class UnsubscribeAction
{
    public function __construct(
        protected readonly UserRepositoryInterface $userRepository
    ) {}

    public function execute(string $signed): bool
    {
        try {
            if (!URL::hasValidSignature(request())) {
                return false;
            }

            $userId = decrypt($signed);
            $user = $this->userRepository->findById($userId);

            if (!$user) {
                return false;
            }

            $this->userRepository->update($user->id, [
                'marketing_opt_in' => false,
            ]);

            return true;
        } catch (Throwable $e) {
            \Log::error("Unsubscribe failed: " . $e->getMessage());
            return false;
        }
    }
}
