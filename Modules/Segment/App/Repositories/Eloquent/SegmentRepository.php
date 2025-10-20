<?php
namespace Modules\Segment\App\Repositories\Eloquent;

use App\Models\User;
use Modules\Segment\App\Models\Segment;
use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;

class SegmentRepository implements SegmentRepositoryInterface
{
    protected $model;

    public function __construct(Segment $model)
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
    public function getPaginated(int $perPage)
    {
        return $this->model->paginate($perPage);
    }

    public function getUsersBySegment(int $segmentId)
    {
        $segment = Segment::findOrFail($segmentId);
        $filters = $segment->filter_json;
        return $this->applyFilters(User::query(), $filters);
    }

    public function getUsersByFilter(array $filters)
    {
        return $this->applyFilters(User::query(), $filters);
    }

    private function applyFilters($query, ?array $filters)
    {
        if (!$filters) {
            return $query;
        }
        if (isset($filters['email_verified'])) {
            $query->where('email_verified', $filters['email_verified']);
        }
        if (isset($filters['marketing_opt_in'])) {
            $query->where('marketing_opt_in', $filters['marketing_opt_in']);
        }
        if (isset($filters['last_activity'])) {
            $query->whereDate('last_activity', '>=', $filters['last_activity']);
        }

        if (isset($filters['registered_from'])) {
            $query->whereDate('created_at', '>=', $filters['registered_from']);
        }

        if (isset($filters['registered_to'])) {
            $query->whereDate('created_at', '<=', $filters['registered_to']);
        }

        if (isset($filters['product_ids'])) {
            $query->whereHas('products', function($q) use ($filters) {
                $q->whereIn('products.id', $filters['product_ids']);
            });
        }

        if (isset($filters['category_ids'])) {
            $query->whereHas('products', function($q) use ($filters) {
                $q->whereIn('products.category_id', $filters['category_ids']);
            });
        }

        if (isset($filters['relations'])) {
            foreach ($filters['relations'] as $relationType => $ids) {
                $query->whereHas('pivotProductUsers', function($q) use ($relationType, $ids) {
                    $q->where('type', $relationType)->whereIn('product_id', $ids);
                });
            }
        }
        return $query->with(['products', 'pivotProductUsers']);
    }
}
