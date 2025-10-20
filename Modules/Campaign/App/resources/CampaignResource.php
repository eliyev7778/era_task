<?php

namespace Modules\Campaign\App\resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'subject' => $this->subject,
            'template_key' => $this->template_key,
            'from_email' => $this->from_email,
            'segment_id' => $this->segment_id,
            'status' => $this->status,
            'total_recipients' => $this->total_recipients,
            'sent_count' => $this->sent_count,
            'error_count' => $this->error_count,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
