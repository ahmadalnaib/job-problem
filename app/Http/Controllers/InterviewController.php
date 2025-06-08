<?php


namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Interview;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Jobs\SendInterviewReminder;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreInterviewRequest;
use App\Http\Requests\UpdateInterviewRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class InterviewController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $interviews = Interview::with('jobApplication')
            ->whereHas('jobApplication', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->orderBy('scheduled_at', 'asc')
            ->get();

        return Inertia::render('Interviews/Index', [
            'interviews' => $interviews,
        ]);
    }

    public function create()
    {
        $jobApplications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Interviews/Create', [
            'jobApplications' => $jobApplications,
        ]);
    }

    public function store(StoreInterviewRequest $request)
    {
        $interview = Interview::create([
            'job_application_id' => $request->input('job_application_id'),
            'scheduled_at' => Carbon::parse($request->input('scheduled_at'))->setTimezone('UTC'),
            'remind_me' => $request->input('remind_me'),
            'location' => $request->input('location'),
        ]);
   

  


        return redirect()->route('interviews.index');
    }

    public function show(Interview $interview)
    {
        $interview->load('jobApplication.user');
        $this->authorize('view', $interview);

        return Inertia::render('Interviews/Show', [
            'interview' => $interview,
        ]);
    }

    public function edit(Interview $interview)
    {
        $interview->load('jobApplication');
        $this->authorize('update', $interview);

        $jobApplications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Interviews/Edit', [
            'interview' => $interview,
            'jobApplications' => $jobApplications,
        ]);
    }

    public function update(UpdateInterviewRequest $request, Interview $interview)
    {
        $interview->load('jobApplication');
        $this->authorize('update', $interview);

        $interview->update($request->all());

        return redirect()->route('interviews.index');
    }

    public function destroy(Interview $interview)
    {
        $interview->load('jobApplication');
        $this->authorize('delete', $interview);

        $interview->delete();

        return redirect()->route('interviews.index');
    }
}