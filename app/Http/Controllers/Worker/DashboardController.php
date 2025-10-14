<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Worker statistics
        $stats = [
            'total_applications' => $user->jobApplications()->count(),
            'pending_applications' => $user->jobApplications()->pending()->count(),
            'accepted_applications' => $user->jobApplications()->accepted()->count(),
            'available_jobs' => Job::active()->count(),
        ];

        // Recent applications
        $recent_applications = $user->jobApplications()
            ->with(['job.category', 'job.employer'])
            ->latest()
            ->take(5)
            ->get();

        // Recommended jobs based on skills
        $recommended_jobs = Job::active()
            ->with(['category', 'employer'])
            ->when($user->skills, function ($query) use ($user) {
                $skills = is_array($user->skills) ? $user->skills : [];
                foreach ($skills as $skill) {
                    $query->orWhere('title', 'like', "%{$skill}%")
                          ->orWhere('description', 'like', "%{$skill}%");
                }
            })
            ->latest()
            ->take(6)
            ->get();

        return view('worker.dashboard', compact('stats', 'recent_applications', 'recommended_jobs'));
    }

    public function jobs(Request $request)
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

        // Budget filter
        if ($request->min_budget) {
            $query->where('budget_min', '>=', $request->min_budget);
        }
        if ($request->max_budget) {
            $query->where('budget_max', '<=', $request->max_budget);
        }

        // Location filter
        if ($request->location) {
            $query->where('location', 'like', "%{$request->location}%");
        }

        $jobs = $query->latest()->paginate(12);
        $categories = JobCategory::active()->get();

        return view('worker.jobs', compact('jobs', 'categories'));
    }

    public function applications()
    {
        $user = Auth::user();
        $applications = $user->jobApplications()
            ->with(['job.category', 'job.employer'])
            ->latest()
            ->paginate(10);

        return view('worker.applications', compact('applications'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('worker.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:1000',
            'address' => 'nullable|string|max:500',
            'city' => 'required|string|max:100',
            'district' => 'nullable|string|max:100',
            'subdistrict' => 'nullable|string|max:100',
            'skills' => 'nullable|string',
        ]);

        $user = Auth::user();
        
        // Process skills
        $skills = null;
        if ($request->skills) {
            $skills = array_map('trim', explode(',', $request->skills));
            $skills = array_filter($skills); // Remove empty values
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'subdistrict' => $request->subdistrict,
            'skills' => $skills,
        ]);

        return redirect()->route('worker.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function history()
    {
        $user = Auth::user();
        // You can pull job applications with statuses for history
        $applications = $user->jobApplications()->with(['job.category','job.employer'])->latest()->paginate(10);
        return view('worker.history', compact('applications'));
    }

    public function chat()
    {
        $user = Auth::user();
        return view('worker.chat', compact('user'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('worker.settings', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => \Hash::make($request->password)]);
        return redirect()->route('worker.settings')->with('success', 'Password berhasil diperbarui!');
    }
}
