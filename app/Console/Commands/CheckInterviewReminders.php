<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Interview;
use Illuminate\Console\Command;
use App\Jobs\SendInterviewReminder;

class CheckInterviewReminders extends Command
{
    protected $signature = 'app:check-interview-reminders';
    protected $description = 'Check interviews and send reminder emails if the time has come.';

    public function handle()
    {
      $today = Carbon::now()->startOfDay(); // today at 00:00:00
        $totalProcessed = 0;

        // Process interviews in chunks to avoid memory issues
       Interview::whereDate('remind_me', '<=', $today->toDateString())
            ->where('reminder_sent', false)
            ->chunk(100, function ($interviews) use (&$totalProcessed) {
                foreach ($interviews as $interview) {
                    SendInterviewReminder::dispatch($interview);
                    $totalProcessed++;
                }
            });

        $this->info("Dispatched {$totalProcessed} interview reminder jobs.");
    }
}