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

    /**
     * Create a new job instance.
     */
 protected $interview;

    public function __construct(Interview $interview)
    {
        $this->interview = $interview;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
           if (!$this->interview->reminder_sent) {
            Mail::to($this->interview->jobApplication->user->email)->send(
                new InterviewReminderMail($this->interview)
            );

            $this->interview->update(['reminder_sent' => true]);
        }
    
    }
}
