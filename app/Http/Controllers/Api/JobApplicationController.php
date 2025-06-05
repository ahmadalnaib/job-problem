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
    public function index(Request $request)
    {
            $jobApplications = JobApplication::where('user_id', $request->user()->id)
        ->orderByDesc('applied_at')
        ->get();

    return JobApplicationResource::collection($jobApplications);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreJobApplicationRequest $request)
{
    $data = $request->validated();
    // $data['user_id'] =1;
       $data['user_id'] = $request->user()->id; 

    $jobApplication = JobApplication::create($data);

    return new JobApplicationResource($jobApplication);
}

    /**
     * Display the specified resource.
     */
 public function show($id, Request $request)
{
    $jobApplication = JobApplication::where('id', $id)
        ->where('user_id', $request->user()->id)
        ->firstOrFail();

    return new JobApplicationResource($jobApplication);
}


    /**
     * Update the specified resource in storage.
     */
public function update(UpdateJobApplicationRequest $request, $id)
{
    $jobApplication = JobApplication::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    $jobApplication->update($request->validated());

    return new JobApplicationResource($jobApplication);
}

    /**
     * Remove the specified resource from storage.
     */
public function destroy($id, Request $request)
{
    $jobApplication = JobApplication::where('id', $id)
        ->where('user_id', $request->user()->id)
        ->firstOrFail();

    $jobApplication->delete();

    // Return a JSON response instead of noContent()
    return response()->json(['message' => 'Deleted successfully']);
}
}
