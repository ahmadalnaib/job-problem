<?php

namespace App\Http\Controllers\Api;

use App\Models\Interview;
use Illuminate\Http\Request;
use App\Jobs\SendInterviewReminder;
use App\Http\Controllers\Controller;
use App\Http\Resources\InterviewResource;
use App\Http\Requests\StoreInterviewRequest;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
      $interviews = Interview::with('jobApplication') // <-- add this
        ->whereHas('jobApplication', function ($query) use ($request) {
            $query->where('user_id', $request->user()->id);
        })
        ->orderBy('scheduled_at')
        ->get();

    return InterviewResource::collection($interviews);
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(StoreInterviewRequest $request)
    {
        $data = $request->validated();
        $interview = Interview::create($data);


        return new InterviewResource($interview);
    }

    /**
     * Display the specified resource.
     */
 public function show(Request $request, Interview $interview)
    {
        // Only allow access if the interview belongs to the user's job application
        if ($interview->jobApplication->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        return new InterviewResource($interview);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StoreInterviewRequest $request, Interview $interview)
    {
        if ($interview->jobApplication->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $interview->update($request->validated());

        return new InterviewResource($interview);
    }

    /**
     * Remove the specified resource from storage.
     */
  public function destroy(Request $request, Interview $interview)
    {
        if ($interview->jobApplication->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $interview->delete();

      return response()->json(['message' => 'Deleted successfully']);
    }
}
