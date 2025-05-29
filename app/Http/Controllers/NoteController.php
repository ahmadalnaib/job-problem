<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\JobApplication;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $query = Note::with('jobApplication')
        ->whereHas('jobApplication', fn($q) => $q->where('user_id', auth()->id()));

    if ($request->filled('job_application_id')) {
        $query->where('job_application_id', $request->job_application_id);
    }

    $notes = $query->latest()->get();

    return Inertia::render('Notes/Index', [
        'notes' => $notes
    ]);
}

    public function create()
    {
        $applications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Notes/Create', [
            'applications' => $applications
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'content' => 'required|string'
        ]);

        Note::create($request->only('job_application_id', 'content'));

        return redirect()->route('notes.index')->with('success', 'Note created successfully.');
    }

    public function show(Note $note)
    {
        // $this->authorize('view', $note);

        return Inertia::render('Notes/Show', [
            'note' => $note->load('jobApplication')
        ]);
    }

    public function edit(Note $note)
    {
        // $this->authorize('update', $note);

        $applications = JobApplication::where('user_id', auth()->id())->get();

        return Inertia::render('Notes/Edit', [
            'note' => $note,
            'applications' => $applications
        ]);
    }

    public function update(Request $request, Note $note)
    {
        // $this->authorize('update', $note);

        $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'content' => 'required|string'
        ]);

        $note->update($request->only('job_application_id', 'content'));

        return redirect()->route('notes.index')->with('success', 'Note updated.');
    }

    public function destroy(Note $note)
    {
        // $this->authorize('delete', $note);

        $note->delete();

        return redirect()->route('notes.index')->with('success', 'Note deleted.');
    }
}
