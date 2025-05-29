<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobApplicationController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('job-applications', JobApplicationController::class);
Route::resource('notes', NoteController::class);
Route::resource('interviews', InterviewController::class);

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
