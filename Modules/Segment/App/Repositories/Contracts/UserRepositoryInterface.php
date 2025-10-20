<?php

namespace Modules\Segment\App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getUsersBySegment(array $filter, int $sampleSize = 20): array;
    public function findById($id);
    public function update($id, array $data);
}
