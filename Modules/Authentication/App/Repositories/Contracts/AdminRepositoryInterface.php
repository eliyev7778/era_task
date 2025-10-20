<?php

namespace Modules\Authentication\App\Repositories\Contracts;

interface AdminRepositoryInterface
{
    public function getAll();
    public function findById($id);
    public function findBy(string $column, $value);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
