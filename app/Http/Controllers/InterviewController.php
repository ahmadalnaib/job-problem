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
            'scheduled_at'=>$request->input('scheduled_at'),
            'remind_me' => $request->input('remind_me'),
        //   'scheduled_at' => Carbon::parse($request->input('scheduled_at'))->utc(),
        //    'remind_me' => Carbon::parse($request->input('remind_me'))->utc(),
            'location' => $request->input('location'),
        ]);

    //        SendInterviewReminder::dispatch($interview)
    // ->delay($interview->remind_me->diffInSeconds(now()) > 0 ? $interview->remind_me->diffInSeconds(now()) : 0);

// SendInterviewReminder::dispatch($interview)
//     ->delay($interview->remind_me);
// SendInterviewReminder::dispatch($interview)
//     ->delay($interview->remind_me->copy()->setTimezone('UTC'));

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