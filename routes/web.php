<?php

use Inertia\Inertia;
use App\Models\Interview;
use App\Mail\InterviewReminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobApplicationController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('job-applications', JobApplicationController::class);
    Route::resource('interviews', InterviewController::class);
});

// Route::get('/test-email', function () {
//     $interview = Interview::latest()->first(); // Replace with appropriate logic
//     $timeFrame = 'Test Time Frame';
//     Mail::to('test@example.com')->send(new InterviewReminder($interview, $timeFrame));
//     return 'Test email sent.';
// });

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
