<?php


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Notifications\ExpoPushNotification;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InterviewController;
use App\Http\Controllers\Api\JobApplicationController;


// ...
 
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('jobapplications', JobApplicationController::class);
    Route::apiResource('interview', InterviewController::class);


    // Save Expo push token endpoint
Route::post('/save-token', function (Request $request) {
    $request->validate([
        'expo_push_token' => 'required|string',
    ]);

    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    $user->expo_push_token = $request->expo_push_token;

    // Log the received token
    Log::info("User {$user->id} saving Expo push token: " . $request->expo_push_token);

    $user->save();

    return response()->json(['success' => true]);
});
});

Route::post('/test-notification', function (Request $request) {
    $user = User::whereNotNull('expo_push_token')->first();

    if (!$user) {
        return response()->json(['error' => 'No user with Expo push token found.'], 404);
    }

    $user->notify(new ExpoPushNotification(
        $request->input('title', 'Test Notification'),
        $request->input('body', 'This is a test push notification from Laravel.')
    ));

    return response()->json(['success' => true]);
});


Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
