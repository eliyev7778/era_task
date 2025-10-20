<?php

namespace Modules\Campaign\App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Campaign\App\Models\Campaign;

class CampaignMail extends Mailable
{
    use Queueable, SerializesModels;

    public Campaign $data;
    public string $templateKey;

    /**
     * @param Campaign $data
     * @param string $templateKey
     */
    public function __construct(Campaign $data, string $templateKey)
    {
        $this->data = $data;
        $this->templateKey = $templateKey;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject($this->data['subject'] ?? 'No Subject')
            ->view("emails.templates.{$this->templateKey}")
            ->with($this->data);
    }
}
