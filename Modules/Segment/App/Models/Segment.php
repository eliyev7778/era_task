<?php

namespace Modules\Segment\App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'filter_json'];

    protected $casts = [
        'filter_json' => 'array',
    ];
}
