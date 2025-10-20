<?php
namespace Modules\Authentication\App\Repositories\Eloquent;

use Modules\Authentication\App\Models\Admin;
use Modules\Authentication\App\Repositories\Contracts\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    protected $model;

    public function __construct(Admin $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function findBy(string $column, $value)
    {
        return $this->model->where($column, $value)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->model->find($id);
        if ($user) {
            $user->update($data);
            return $user;
        }
        return null;
    }

    public function delete($id)
    {
        $user = $this->model->find($id);
        if ($user) {
            return $user->delete();
        }
        return false;
    }
}
