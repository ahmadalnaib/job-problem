<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index()
{
    $jobApplications = JobApplication::where('user_id', auth()->id())->get();

    return Inertia::render('JobApplications/Index', [
        'jobApplications' => $jobApplications,
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
public function create()
{
    return Inertia::render('JobApplications/Create');
}

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
      $validatedData = $request->validate([
        'company' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'applied_at' => 'required|date',
        'status' => 'required|in:pending,accepted,rejected',
    ]);

    // Add the authenticated user's ID to the validated data
    $validatedData['user_id'] = auth()->id();

    JobApplication::create($validatedData);

    return redirect()->route('job-applications.index');
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
public function edit(JobApplication $jobApplication)
{
    return Inertia::render('JobApplications/Edit', [
        'jobApplication' => $jobApplication,
    ]);
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, JobApplication $jobApplication)
{
    $request->validate([
        'company' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'applied_at' => 'required|date',
        'status' => 'required|in:pending,accepted,rejected',
    ]);

    $jobApplication->update($request->all());

    return redirect()->route('job-applications.index');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(JobApplication $jobApplication)
{
    $jobApplication->delete();
    return redirect()->route('job-applications.index');
}
}
