<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Interview;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Mail\InterviewReminder;

class SendInterviewReminders extends Command
{
    protected $signature = 'interviews:send-reminders';
    protected $description = 'Send email reminders for upcoming interviews';

    public function handle()
    {
        $now = Carbon::now();

        // Define time frames for reminders
        $reminderTimeFrames = [
            1440 => '1 day',
            120  => '2 hours',
        ];

        foreach ($reminderTimeFrames as $minutes => $timeFrame) {
            $targetTime = $now->copy()->addMinutes($minutes)->format('Y-m-d H:i');

            $interviews = Interview::where('scheduled_at', $targetTime)->get();

            foreach ($interviews as $interview) {
                $user = $interview->jobApplication->user;
                Mail::to($user->email)->send(new InterviewReminder($interview, $timeFrame));
                $this->info("Sent {$timeFrame} reminder to {$user->email} for interview ID {$interview->id}");
            }
        }
    }
}
