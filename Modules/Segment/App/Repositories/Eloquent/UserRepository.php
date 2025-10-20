<?php

namespace Modules\Segment\App\Repositories\Eloquent;

use App\Models\User;
use Modules\Segment\App\Repositories\Contracts\UserRepositoryInterface;
use Modules\Segment\App\resources\SegmentPreviewUserResource;

class UserRepository implements UserRepositoryInterface
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function findById($id)
    {
        return $this->model->find($id);
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
    public function getUsersBySegment(array $filter, int $sampleSize = 20): array
    {
        $query = $this->model::query();
        if (isset($filter['email_verified'])) {
            $query->where('email_verified', $filter['email_verified']);
        }

        if (isset($filter['marketing_opt_in'])) {
            $query->where('marketing_opt_in', $filter['marketing_opt_in']);
        }

        if (isset($filter['last_activity_from'])) {
            $query->where('last_activity', '>=', $filter['last_activity_from']);
        }

        if (isset($filter['last_activity_to'])) {
            $query->where('last_activity', '<=', $filter['last_activity_to']);
        }

        if (!empty($filter['product_category_ids']) || !empty($filter['product_relation_type'])) {
            $query->whereHas('productRelations', function ($q) use ($filter) {
                if (!empty($filter['product_relation_type'])) {
                    $q->where('type', $filter['product_relation_type']);
                }

                if (!empty($filter['product_category_ids'])) {
                    $q->whereHas('product', function ($q2) use ($filter) {
                        $q2->whereIn('category_id', $filter['product_category_ids']);
                    });
                }
            });
        }

        $total = $query->count();

        $sample = $query->inRandomOrder()
            ->limit($sampleSize)
            ->with([
                'productRelations',
                'productRelations.product',
                'productRelations.product.category'
            ])
            ->get(['id', 'name', 'email']);

        return [
            'total_recipients' => $total,
            'sample' => SegmentPreviewUserResource::collection($sample),
        ];
    }
}
