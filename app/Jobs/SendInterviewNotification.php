<?php

namespace App\Jobs;

use App\Models\Interview;
use Illuminate\Foundation\Queue\Queueable;
use App\Notifications\ExpoPushNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInterviewNotification implements ShouldQueue
{
    use Queueable;
        protected $interview;

    /**
     * Create a new job instance.
     */
    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    /**
     * Execute the job.
     */
   public function handle(): void
{
    $freshInterview = $this->interview->fresh();
    if (
        !$freshInterview ||
        !$freshInterview->jobApplication ||
        !$freshInterview->jobApplication->user ||
        !$freshInterview->jobApplication->user->expo_push_token // <-- check for token
    ) {
        return;
    }
    $user = $freshInterview->jobApplication->user;
    $companyName = $freshInterview->jobApplication->company ?? 'the company';
    $scheduledAt = $freshInterview->scheduled_at
        ? $freshInterview->scheduled_at->format('Y-m-d H:i')
        : 'unspecified time';
    $user->notify(new ExpoPushNotification(
        'Interview Reminder',
        null,
        $companyName,
        $scheduledAt

    ));
}
}
