<?php

namespace Modules\Product\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Product\Database\factories\ProductFactory;
use Modules\ProductCategory\App\Models\ProductCategory;
use Modules\Segment\App\Models\PivotProductUser;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected static function newFactory(): ProductFactory
    {
        return ProductFactory::new();
    }

    public function userRelations(): HasMany
    {
        return $this->hasMany(PivotProductUser::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
