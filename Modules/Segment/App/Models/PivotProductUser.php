<?php

namespace Modules\Segment\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Segment\Database\factories\PivotProductUserFactory;

class PivotProductUser extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public $timestamps = false;
    protected static function newFactory(): PivotProductUserFactory
    {
        return PivotProductUserFactory::new();
    }

    public function product()
    {
        return $this->belongsTo(\Modules\Product\App\Models\Product::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
