<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Get some stats for the homepage
        $stats = [
            'total_jobs' => Job::active()->count(),
            'total_workers' => User::workers()->count(),
            'total_employers' => User::employers()->count(),
            'total_categories' => JobCategory::active()->count(),
        ];

        $featured_jobs = Job::with(['category', 'employer'])
            ->active()
            ->latest()
            ->take(6)
            ->get();

        $categories = JobCategory::active()
            ->withCount('jobs')
            ->take(8)
            ->get();

        return view('welcome', compact('stats', 'featured_jobs', 'categories'));
    }
}
