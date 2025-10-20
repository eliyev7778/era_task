<?php
namespace Modules\Segment\App\resources;
use Illuminate\Http\Resources\Json\JsonResource;

class SegmentPreviewUserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
