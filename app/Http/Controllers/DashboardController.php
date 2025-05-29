<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
    {
        $user = auth()->user();

        // Filter interviews for the current month
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $nextInterviews = Interview::with('jobApplication')
            ->whereHas('jobApplication', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->whereBetween('scheduled_at', [$startOfMonth, $endOfMonth])
            ->orderBy('scheduled_at')
            ->get();

        $jobCount = JobApplication::where('user_id', $user->id)->count();

        $statusCounts = JobApplication::where('user_id', $user->id)
            ->selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status');

        return Inertia::render('Dashboard', [
            'nextInterviews' => $nextInterviews,
            'jobCount' => $jobCount,
            'statusCounts' => $statusCounts,
        ]);
    }
}
