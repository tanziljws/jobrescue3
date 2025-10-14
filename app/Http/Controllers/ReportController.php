<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Request $request)
    {
        $reportType = $request->get('type', 'user');
        $targetId = $request->get('target_id');
        
        $target = null;
        if ($reportType === 'user' && $targetId) {
            $target = User::find($targetId);
        } elseif ($reportType === 'job' && $targetId) {
            $target = Job::find($targetId);
        }

        return view('reports.create', compact('reportType', 'target'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:user,job,fraud,spam,inappropriate,other',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'reported_user_id' => 'nullable|exists:users,id',
            'reported_job_id' => 'nullable|exists:job_postings,id',
            'evidence' => 'nullable|array',
            'evidence.*' => 'url',
        ]);

        // Prevent self-reporting
        if ($request->reported_user_id == Auth::id()) {
            return back()->withErrors(['reported_user_id' => 'Anda tidak dapat melaporkan diri sendiri.']);
        }

        Report::create([
            'reporter_id' => Auth::id(),
            'reported_user_id' => $request->reported_user_id,
            'reported_job_id' => $request->reported_job_id,
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'evidence' => $request->evidence ? array_filter($request->evidence) : null,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim. Tim kami akan meninjau laporan Anda.');
    }

    public function index()
    {
        $user = Auth::user();
        $reports = $user->reports()
            ->with(['reportedUser', 'reportedJob'])
            ->latest()
            ->paginate(10);

        return view('reports.index', compact('reports'));
    }

    public function show(Report $report)
    {
        // Check if user owns this report or is admin
        if ($report->reporter_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $report->load(['reportedUser', 'reportedJob', 'handledBy']);
        return view('reports.show', compact('report'));
    }

    // Admin methods
    public function adminIndex()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $reports = Report::with(['reporter', 'reportedUser', 'reportedJob', 'handledBy'])
            ->latest()
            ->paginate(15);

        return view('admin.reports', compact('reports'));
    }

    public function updateStatus(Request $request, Report $report)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,investigating,resolved,dismissed',
            'admin_notes' => 'nullable|string',
        ]);

        $report->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'handled_by' => Auth::id(),
            'resolved_at' => in_array($request->status, ['resolved', 'dismissed']) ? now() : null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status laporan berhasil diperbarui.'
        ]);
    }
}
