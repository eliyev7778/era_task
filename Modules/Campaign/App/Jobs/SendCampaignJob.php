<?php

namespace Modules\Campaign\App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Modules\Campaign\App\Models\Campaign;
use Modules\Segment\App\Repositories\Contracts\SegmentRepositoryInterface;
use Throwable;

class SendCampaignJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Campaign $campaign;

    public int $tries = 3;
    public int $backoff = 30;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

    public function handle(SegmentRepositoryInterface $segmentRepository): void
    {
        if (!in_array($this->campaign->status, ['queued', 'sending'])) {
            \Log::info("Campaign #{$this->campaign->id} stopped. Current status: {$this->campaign->status}");
            return;
        }

       // $this->campaign->update(['status' => 'sending']);

        $usersQuery = $this->campaign->segment_id
            ? $segmentRepository->getUsersBySegment($this->campaign->segment_id)
            : $segmentRepository->getUsersByFilter($this->campaign->filter_json);

        $usersQuery->chunk(100, function ($users) {

            foreach ($users as $user) {
                try {
                    $this->sendEmail($user);
                    usleep(200000);
                } catch (Throwable $e) {
                    \Log::error("Mail send failed for user #{$user->id}: {$e->getMessage()}");
                    continue;
                }
            }
        });

       // $this->campaign->update(['status' => 'completed']);
    }


    protected function sendEmail($user): void
    {

        $subject = $this->campaign->subject;
        $template = view("emails.templates.{$this->campaign->template_key}", [
            'user' => $user,
            'unsubscribe_url' => $this->generateUnsubscribeUrl($user),
        ])->render();

        Mail::send([], [], function ($message) use ($user, $subject, $template) {
            $message->to($user->email)
                ->subject($subject)
                ->from($this->campaign->from_email ?? config('mail.from.address'))
                ->html($template);
        });
    }


    protected function generateUnsubscribeUrl($user): string
    {
        return route('unsubscribe', [
            'campaign' => $this->campaign->id,
            'user' => $user->id,
            'signature' => sha1($user->email . $this->campaign->id . config('app.key')),
        ]);
    }

    public function failed(Throwable $exception): void
    {
        \Log::error("SendCampaignJob failed for campaign #{$this->campaign->id}: {$exception->getMessage()}");
        $this->campaign->update(['status' => 'failed']);
    }
}
