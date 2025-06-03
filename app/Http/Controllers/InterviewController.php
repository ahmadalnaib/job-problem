<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Jobs\SendInterviewReminder;
use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 
public function index()
{
    $interviews = Interview::with('jobApplication')
        ->whereHas('jobApplication', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->orderBy('scheduled_at', 'asc') // Soonest interviews first
        ->get();

    return Inertia::render('Interviews/Index', [
        'interviews' => $interviews,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
  public function create()
    {
        $jobApplications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Interviews/Create', [
            'jobApplications' => $jobApplications,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreInterviewRequest $request)
{
    $interview = Interview::create([
        'job_application_id' => $request->input('job_application_id'),
        'scheduled_at' => Carbon::parse($request->input('scheduled_at')),
        'remind_me' => Carbon::parse($request->input('remind_me')),
        'location' => $request->input('location'),
    ]);

    SendInterviewReminder::dispatch($interview)
        ->delay($interview->scheduled_at->subHours(1));

    return redirect()->route('interviews.index');
}
    /**
     * Display the specified resource.
     */
// InterviewController.php
public function show(Interview $interview)
{
     $this->authorize('view', $interview); // optional auth check
    $interview->load('jobApplication.user');

    return Inertia::render('Interviews/Show', [
        'interview' => $interview,
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Interview $interview)
    {
         $this->authorize('update', $interview);

        $jobApplications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Interviews/Edit', [
            'interview' => $interview,
            'jobApplications' => $jobApplications,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateInterviewRequest $request, Interview $interview)
{
     $this->authorize('update', $interview);

    $interview->update($request->all());

    return redirect()->route('interviews.index');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
         $this->authorize('delete', $interview);

        $interview->delete();

        return redirect()->route('interviews.index');
    }
}
