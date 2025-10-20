<?php

namespace Modules\Segment\App\Repositories\Contracts;

interface SegmentRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findBy(string $column, $value);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function getPaginated(int $perPage);
    public function getUsersBySegment(int $segmentId);
    public function getUsersByFilter(array $filters);
}
