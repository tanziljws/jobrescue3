<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::active()->with(['category', 'employer']);

        // Search functionality
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        // Category filter
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Type filter
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        // Location filter (supports 'kota-bogor' and 'kabupaten-bogor')
        if ($request->filled('location')) {
            $location = $request->input('location');
            if ($location === 'kota-bogor') {
                $query->where('location', 'like', '%Kota Bogor%');
            } elseif ($location === 'kabupaten-bogor') {
                $query->where('location', 'like', '%Kabupaten Bogor%');
            } else {
                $query->where('location', 'like', "%{$location}%");
            }
        }

        $jobs = $query->latest()->paginate(9);
        $categories = JobCategory::active()->get();

        return view('jobs.index', compact('jobs', 'categories'));
    }

    public function show(Job $job)
    {
        $job->load(['category', 'employer', 'applications.worker']);
        
        // Check if current user has already applied
        $hasApplied = false;
        if (Auth::check() && Auth::user()->role === 'worker') {
            $hasApplied = $job->applications()
                ->where('worker_id', Auth::id())
                ->exists();
        }

        // Get similar jobs
        $similarJobs = Job::active()
            ->where('category_id', $job->category_id)
            ->where('id', '!=', $job->id)
            ->with(['category', 'employer'])
            ->take(4)
            ->get();

        return view('jobs.show', compact('job', 'hasApplied', 'similarJobs'));
    }

    public function apply(Request $request, Job $job)
    {
        if (!Auth::check() || Auth::user()->role !== 'worker') {
            return redirect()->route('login')->with('error', 'Anda harus login sebagai pekerja untuk melamar.');
        }

        // Check if already applied
        $existingApplication = $job->applications()
            ->where('worker_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return back()->with('error', 'Anda sudah melamar pekerjaan ini.');
        }

        $request->validate([
            'cover_letter' => 'required|string|min:50',
            'proposed_budget' => 'nullable|numeric|min:0',
            'estimated_days' => 'nullable|integer|min:1',
            'portfolio_links' => 'nullable|array',
            'portfolio_links.*' => 'url',
        ]);

        JobApplication::create([
            'job_id' => $job->id,
            'worker_id' => Auth::id(),
            'cover_letter' => $request->cover_letter,
            'proposed_budget' => $request->proposed_budget,
            'estimated_days' => $request->estimated_days,
            'portfolio_links' => $request->portfolio_links,
            'applied_at' => now(),
        ]);

        // Update job applications count
        $job->increment('applications_count');

        return back()->with('success', 'Lamaran Anda berhasil dikirim!');
    }

    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        // Check if user is the employer of this job
        if (!Auth::check() || $application->job->employer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
            'employer_notes' => 'nullable|string',
        ]);

        $application->update([
            'status' => $request->status,
            'employer_notes' => $request->employer_notes,
            'responded_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status lamaran berhasil diperbarui.'
        ]);
    }

    public function category(JobCategory $category, Request $request)
    {
        $query = Job::active()
            ->where('category_id', $category->id)
            ->with(['category', 'employer']);

        // Job type filter
        if ($request->filled('job_type')) {
            $query->where('job_type', $request->job_type);
        }

        // Location filter
        if ($request->filled('location')) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        // Budget filter
        if ($request->filled('budget')) {
            [$min, $max] = explode('-', $request->budget);
            $query->whereBetween('budget_min', [(int)$min, (int)$max]);
        }

        $jobs = $query->latest()->paginate(12);

        return view('jobs.category', compact('category', 'jobs'));
    }
}
