<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Worker\DashboardController as WorkerDashboardController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ReportController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
// Public: Cari Talent
Route::get('/talents', function () {
    return view('talents.index');
})->name('talents.index');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Job application routes
Route::middleware('auth')->group(function () {
    Route::post('/jobs/{job}/apply', [JobController::class, 'apply'])->name('jobs.apply');
    Route::patch('/applications/{application}/status', [JobController::class, 'updateApplicationStatus'])->name('applications.update-status');
    
    // Reporting routes
    Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/{report}', [ReportController::class, 'show'])->name('reports.show');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [DashboardController::class, 'users'])->name('users');
    Route::get('/jobs', [DashboardController::class, 'jobs'])->name('jobs');
    Route::get('/categories', [DashboardController::class, 'categories'])->name('categories');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
    Route::patch('/reports/{report}/status', [ReportController::class, 'updateStatus'])->name('reports.update-status');
    // Admin profile
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/password', [DashboardController::class, 'updatePassword'])->name('password.update');
});

// Worker routes
Route::prefix('worker')->name('worker.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [WorkerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jobs', [WorkerDashboardController::class, 'jobs'])->name('jobs');
    Route::get('/applications', [WorkerDashboardController::class, 'applications'])->name('applications');
    Route::get('/profile', [WorkerDashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile', [WorkerDashboardController::class, 'updateProfile'])->name('profile.update');
    // New worker pages
    Route::get('/history', [WorkerDashboardController::class, 'history'])->name('history');
    Route::get('/chat', [WorkerDashboardController::class, 'chat'])->name('chat');
    Route::get('/settings', [WorkerDashboardController::class, 'settings'])->name('settings');
    Route::patch('/password', [WorkerDashboardController::class, 'updatePassword'])->name('password.update');
});

// Employer routes
Route::prefix('employer')->name('employer.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/jobs', [EmployerDashboardController::class, 'jobs'])->name('jobs');
    Route::get('/jobs/create', [EmployerDashboardController::class, 'createJob'])->name('jobs.create');
    Route::post('/jobs', [EmployerDashboardController::class, 'storeJob'])->name('jobs.store');
    Route::delete('/jobs/{job}', [EmployerDashboardController::class, 'deleteJob'])->name('jobs.delete');
    Route::patch('/jobs/{job}/complete', [EmployerDashboardController::class, 'completeJob'])->name('jobs.complete');
    Route::get('/applications/{jobId?}', [EmployerDashboardController::class, 'applications'])->name('applications');
    Route::get('/profile', [EmployerDashboardController::class, 'profile'])->name('profile');
    Route::patch('/profile', [EmployerDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/password', [EmployerDashboardController::class, 'updatePassword'])->name('password.update');
});
