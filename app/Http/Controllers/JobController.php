<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    public function __construct() {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Job::class);
        $filters = request()->only([
            'search',
            'min_salary',
            'max_salary',
            'experience',
            'category',
        ]);

        return view('job.index', ['jobs' => Job::with('employer')->latest()->filter($filters)->paginate(10)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        $this->authorize('view', $job);
        $job->load(['employer.jobs' => fn ($query) => $query->where('id', '!=', $job->id),
        ]);

        return view('job.show', ['job' => $job]);
    }
}
