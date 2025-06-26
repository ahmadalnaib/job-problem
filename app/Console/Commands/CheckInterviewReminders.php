<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Interview;
use Illuminate\Console\Command;
use App\Jobs\SendInterviewReminder;
use App\Jobs\SendInterviewNotification;

class CheckInterviewReminders extends Command
{
    protected $signature = 'app:check-interview-reminders';
    protected $description = 'Check interviews and send reminder emails if the time has come.';

    public function handle()
    {

      
   $now = Carbon::now();
    $today = $now->copy()->startOfDay();
    $totalProcessed = 0;

    Interview::where('reminder_sent', false)
        ->chunk(100, function ($interviews) use (&$totalProcessed, $now) {
            foreach ($interviews as $interview) {
                $remindAt = null;
                $scheduled = Carbon::parse($interview->scheduled_at);
                $remindMe = $interview->remind_me ? Carbon::parse($interview->remind_me) : null;

                if ($remindMe && $remindMe->isSameDay($scheduled)) {
                    // 1 hour before interview
                    $remindAt = $scheduled->copy()->subHour();
                } elseif ($remindMe) {
                    // At 6:30 AM on remind_me date
                    $remindAt = $remindMe->copy()->setTime(6, 30);
                }

                if ($remindAt && $now->greaterThanOrEqualTo($remindAt)) {
                    SendInterviewReminder::dispatch($interview);
                    SendInterviewNotification::dispatch($interview);
                    $totalProcessed++;
                }
            }
        });
    }
}