<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 public function index()
    {
        $interviews = Interview::with('jobApplication')->whereHas('jobApplication', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();

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
 public function store(Request $request)
    {
   $request->validate([
        'job_application_id' => 'required|exists:job_applications,id',
        'scheduled_at' => 'required|date',
        'location' => 'required|string|max:255',
    ]);

    Interview::create([
        'job_application_id' => $request->input('job_application_id'),
        'scheduled_at' => Carbon::parse($request->input('scheduled_at')),
        'location' => $request->input('location'),
    ]);

    return redirect()->route('interviews.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Interview $interview)
    {
        // $this->authorize('update', $interview);

        $jobApplications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Interviews/Edit', [
            'interview' => $interview,
            'jobApplications' => $jobApplications,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Interview $interview)
    {
        // $this->authorize('update', $interview);

        $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'scheduled_at' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $interview->update($request->all());

        return redirect()->route('interviews.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interview $interview)
    {
        // $this->authorize('delete', $interview);

        $interview->delete();

        return redirect()->route('interviews.index');
    }
}
