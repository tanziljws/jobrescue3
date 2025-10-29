<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\JobCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        // Employer statistics
        $stats = [
            'total_jobs' => $user->employerJobs()->count(),
            'active_jobs' => $user->employerJobs()->active()->count(),
            'completed_jobs' => $user->employerJobs()->where('status', 'completed')->count(),
            'total_applications' => JobApplication::whereHas('job', function ($query) use ($user) {
                $query->where('employer_id', $user->id);
            })->count(),
        ];

        // Recent jobs
        $recent_jobs = $user->employerJobs()
            ->with(['category', 'applications'])
            ->latest()
            ->take(5)
            ->get();

        // Recent applications
        $recent_applications = JobApplication::with(['job', 'worker'])
            ->whereHas('job', function ($query) use ($user) {
                $query->where('employer_id', $user->id);
            })
            ->latest()
            ->take(5)
            ->get();

        return view('employer.dashboard', compact('stats', 'recent_jobs', 'recent_applications'));
    }

    public function jobs()
    {
        $user = Auth::user();
        $jobs = $user->employerJobs()
            ->with(['category', 'applications'])
            ->latest()
            ->paginate(10);

        return view('employer.jobs', compact('jobs'));
    }

    public function createJob()
    {
        $categories = JobCategory::active()->get();
        return view('employer.create-job', compact('categories'));
    }

    public function storeJob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:job_categories,id',
            'budget_min' => 'nullable|numeric|min:0',
            'budget_max' => 'nullable|numeric|min:0|gte:budget_min',
            'budget_type' => 'required|in:fixed,hourly,negotiable',
            'location' => 'required|string|max:255',
            'job_type' => 'required|in:full_time,part_time,freelance,contract',
            'deadline' => 'nullable|date|after:today',
            'requirements' => 'nullable|array',
            'skills_required' => 'nullable|array',
            'is_urgent' => 'boolean',
        ]);

        $job = Auth::user()->employerJobs()->create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'budget_min' => $request->budget_min,
            'budget_max' => $request->budget_max,
            'budget_type' => $request->budget_type,
            'location' => $request->location,
            'job_type' => $request->job_type,
            'deadline' => $request->deadline,
            'requirements' => $request->requirements,
            'skills_required' => $request->skills_required,
            'is_urgent' => $request->boolean('is_urgent'),
            'status' => 'active', // Directly active without admin approval
        ]);

        return redirect()->route('employer.jobs')->with('success', 'Lowongan berhasil dibuat dan sudah aktif!');
    }

    public function applications($jobId = null)
    {
        $user = Auth::user();
        $query = JobApplication::with(['job', 'worker'])
            ->whereHas('job', function ($query) use ($user) {
                $query->where('employer_id', $user->id);
            });

        if ($jobId) {
            $query->where('job_id', $jobId);
        }

        $applications = $query->latest()->paginate(10);
        $jobs = $user->employerJobs()->get();

        return view('employer.applications', compact('applications', 'jobs', 'jobId'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('employer.profile', compact('user'));
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
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        
        $updateData = [
            'name' => $request->name,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'address' => $request->address,
            'city' => $request->city,
            'district' => $request->district,
            'subdistrict' => $request->subdistrict,
        ];

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $updateData['profile_photo'] = $path;
        }
        
        $user->update($updateData);

        return redirect()->route('employer.profile')->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('employer.profile')->with('success', 'Password berhasil diperbarui!');
    }

    public function deleteJob(Job $job)
    {
        // Check if user owns this job
        if ($job->employer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $job->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil dihapus.'
        ]);
    }

    public function completeJob(Job $job)
    {
        // Check if user owns this job
        if ($job->employer_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $job->update(['status' => 'completed']);

        return response()->json([
            'success' => true,
            'message' => 'Pekerjaan berhasil ditandai selesai.'
        ]);
    }
}
