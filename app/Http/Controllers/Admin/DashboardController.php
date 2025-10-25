<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        // Dashboard statistics
        $stats = [
            'total_users' => User::count(),
            'total_workers' => User::workers()->count(),
            'total_employers' => User::employers()->count(),
            'active_jobs' => Job::active()->count(),
            'pending_jobs' => Job::pending()->count(),
            'total_categories' => JobCategory::count(),
            'pending_reports' => Report::pending()->count(),
            'monthly_transactions' => Job::whereMonth('created_at', Carbon::now()->month)->count(),
        ];

        // Recent users
        $recent_users = User::with('employerJobs')
            ->latest()
            ->take(5)
            ->get();

        // Recent jobs
        $recent_jobs = Job::with(['category', 'employer'])
            ->latest()
            ->take(5)
            ->get();

        // Job categories with counts
        $job_categories = JobCategory::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->take(10)
            ->get();

        // Monthly user growth (last 6 months)
        $user_growth = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $user_growth[] = [
                'month' => $date->format('M Y'),
                'count' => User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            ];
        }

        return view('admin.dashboard', compact(
            'stats', 
            'recent_users', 
            'recent_jobs', 
            'job_categories', 
            'user_growth'
        ));
    }

    public function users()
    {
        $users = User::with('employerJobs')
            ->paginate(20);

        return view('admin.users', compact('users'));
    }

    public function jobs()
    {
        $jobs = Job::with(['category', 'employer'])
            ->latest()
            ->paginate(20);

        return view('admin.jobs', compact('jobs'));
    }

    public function categories()
    {
        $categories = JobCategory::withCount('jobs')
            ->paginate(20);

        return view('admin.categories', compact('categories'));
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name',
            'description' => 'nullable|string|max:500',
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;
        $validated['icon'] = '📁'; // Default icon

        JobCategory::create($validated);

        return redirect()->route('admin.categories')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function reports()
    {
        $reports = Report::with(['reporter', 'reportedUser', 'reportedJob'])
            ->latest()
            ->paginate(20);

        return view('admin.reports', compact('reports'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $path = $request->file('avatar')->store('avatars', 'public');
            // save into profile_photo column to match User fillable
            $validated['profile_photo'] = $path;
            unset($validated['avatar']);
        }

        $user->update($validated);
        return redirect()->route('admin.profile')->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = auth()->user();
        if (!\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->update(['password' => \Hash::make($request->password)]);
        return redirect()->route('admin.profile')->with('success', 'Password berhasil diperbarui.');
    }

    public function adminDeleteJob(Job $job)
    {
        $user = Auth::user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // If Job uses soft deletes, this will soft delete; otherwise hard delete
        $job->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Lowongan berhasil dihapus.');
    }

    public function adminDeleteUser(User $user)
    {
        $admin = Auth::user();
        if (!$admin || $admin->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Prevent self-deletion to avoid locking out admin
        if ($user->id === $admin->id) {
            return back()->withErrors(['user' => 'Tidak dapat menghapus akun Anda sendiri.']);
        }

        // Delete profile photo if exists
        if ($user->profile_photo) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Pengguna berhasil dihapus.');
    }
}
