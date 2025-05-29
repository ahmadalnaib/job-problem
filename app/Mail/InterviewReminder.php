<?php

namespace App\Mail;

use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InterviewReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $interview;
    public $timeFrame;

    public function __construct(Interview $interview, $timeFrame)
    {
        $this->interview = $interview;
        $this->timeFrame = $timeFrame;
    }

    public function build()
    {
        return $this->subject("Interview Reminder - {$this->timeFrame} Left")
                    ->view('emails.interview_reminder')
                    ->with([
                        'userName'    => $this->interview->jobApplication->user->name,
                        'company'     => $this->interview->jobApplication->company,
                        'position'    => $this->interview->jobApplication->position,
                        'scheduledAt' => $this->interview->scheduled_at,
                        'location'    => $this->interview->location,
                        'timeFrame'   => $this->timeFrame,
                    ]);
    }
}
