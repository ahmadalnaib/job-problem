<?php

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobApplicationController;


// ...
 
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('jobapplications', JobApplicationController::class);
});


Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
