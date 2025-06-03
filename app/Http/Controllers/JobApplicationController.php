<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobApplicationController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
public function index()
{
$jobApplications = JobApplication::where('user_id', auth()->id())
        ->orderByDesc('applied_at')
        ->get();

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
   public function store(StoreJobApplicationRequest $request)
{
      $validatedData = $request->validated();
    $validatedData['user_id'] = auth()->id();

    JobApplication::create($validatedData);

    return redirect()->route('job-applications.index');
}

    /**
     * Display the specified resource.
     */
public function show(JobApplication $jobApplication)
{
   
}


    /**
     * Show the form for editing the specified resource.
     */
public function edit(JobApplication $jobApplication)
{
        $this->authorize('update', $jobApplication);
    return Inertia::render('JobApplications/Edit', [
        'jobApplication' => $jobApplication,
    ]);
}

    /**
     * Update the specified resource in storage.
     */
   public function update(UpdateJobApplicationRequest  $request, JobApplication $jobApplication)
{
   $this->authorize('update', $jobApplication);
    $jobApplication->update($request->validated());
    return redirect()->route('job-applications.index');
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy(JobApplication $jobApplication)
{
      $this->authorize('delete', $jobApplication);
    $jobApplication->delete();
    return redirect()->route('job-applications.index');
}
}
