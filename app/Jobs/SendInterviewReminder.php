<?php

namespace App\Jobs;

use App\Models\Interview;
use App\Mail\InterviewReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInterviewReminder implements ShouldQueue
{
    use Queueable;

    public $timeout = 60;
    public $tries = 3;
    public $backoff = [10, 30];
    
    protected $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    public function handle(): void
    {
        // Double-check to prevent race conditions
        $freshInterview = $this->interview->fresh();
        
        if (!$freshInterview || $freshInterview->reminder_sent) {
            return;
        }

        Mail::to($freshInterview->jobApplication->user->email)
            ->send(new InterviewReminderMail($freshInterview));

        $freshInterview->update(['reminder_sent' => true]);
    }
}