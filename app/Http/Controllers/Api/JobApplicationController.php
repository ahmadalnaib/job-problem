<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobApplicationResource;
use App\Http\Requests\StoreJobApplicationRequest;
use App\Http\Requests\UpdateJobApplicationRequest;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $jobApplications = JobApplication::where('user_id', auth()->id())
        // ->orderByDesc('applied_at')
        // ->get();
        // return response()->json($jobApplications);
        // $jobApplications=JobApplication::all();
        // return response()->json($jobApplications);
          return JobApplicationResource::collection(JobApplication::all());
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreJobApplicationRequest $request)
{
    $data = $request->validated();
    $data['user_id'] =1; // or $request->user()->id

    $jobApplication = JobApplication::create($data);

    return new JobApplicationResource($jobApplication);
}

    /**
     * Display the specified resource.
     */
    public function show(JobApplication $jobApplication)
    {
        //
        return new JobApplicationResource($jobApplication);
        // return response()->json($jobApplication);
    }

    /**
     * Update the specified resource in storage.
     */
public function update(UpdateJobApplicationRequest $request, JobApplication $jobApplication)
    {
        $jobApplication->update($request->validated());
 
        return new JobApplicationResource($jobApplication);
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(JobApplication $jobApplication)
    {
        $jobApplication->delete();
 
        return response()->noContent();
    }
}
