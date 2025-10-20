<?php

namespace Modules\Campaign\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Segment\App\Models\Segment;

class Campaign extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'filter_json' => 'array',
        'total_recipients' => 'integer',
        'sent_count' => 'integer',
        'error_count' => 'integer',
    ];

    /**
     * Campaign segment relation (optional)
     */
    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }
}
