<?php

namespace Modules\Segment\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CreateSegmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
