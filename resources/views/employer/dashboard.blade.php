@php
use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemberi Kerja - Job Rescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Reserve space for fixed sidebar on large screens */
        @media (min-width: 1024px) {
            .employer-has-fixed-sidebar { padding-left: 16rem; }
        }
        .employer-sidebar .sidebar-icon { color: rgba(249,115,22,0.7); transition: color .2s ease; }
        /* Unified sidebar link styling */
        .sidebar-link { display:flex; align-items:center; gap:.5rem; color:#eef2ff; padding:.75rem .85rem; border-radius:12px; transition: all .2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,.12); color:#fff; }
        .sidebar-link.active { background: rgba(255,255,255,.22); color:#fff; }
        .sidebar-link:hover .sidebar-icon { color:#f97316; }
        .sidebar-link.active .sidebar-icon { color:#f97316; }
        .employer-nav a.active span { color: #fff; }
        /* Orange transparent metric card */
        .metric-card {
            background: rgba(249,115,22,.12);
            border: 2px solid rgba(249,115,22,.25);
            box-shadow: 0 10px 30px rgba(249,115,22,.10);
        }
    </style>
</head>
<body class="bg-gray-50 employer-has-fixed-sidebar">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-[#667eea] text-white w-64 h-screen fixed top-0 left-0 bottom-0 p-4 employer-sidebar overflow-y-auto" style="background-color:#667eea;">
            <div class="flex items-center mb-8">
                <img src="{{ asset('img/icon.svg') }}" alt="JobRescue" class="w-6 h-6 mr-2" style="width:24px;height:24px;">
                <span class="text-xl font-bold">JobRescue Employer</span>
            </div>
            
            <nav class="space-y-2 employer-nav">
                <a href="{{ route('employer.dashboard') }}" class="sidebar-link {{ request()->routeIs('employer.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line sidebar-icon"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('employer.jobs') }}" class="sidebar-link {{ request()->routeIs('employer.jobs') ? 'active' : '' }}">
                    <i class="fa-solid fa-briefcase sidebar-icon"></i>
                    <span>Kelola Pekerjaan</span>
                </a>
                <a href="{{ route('employer.jobs.create') }}" class="sidebar-link {{ request()->routeIs('employer.jobs.create') ? 'active' : '' }}">
                    <i class="fa-solid fa-plus sidebar-icon"></i>
                    <span>Post Pekerjaan</span>
                </a>
                <a href="{{ route('employer.applications') }}" class="sidebar-link {{ request()->routeIs('employer.applications') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-lines sidebar-icon"></i>
                    <span>Lamaran Masuk</span>
                </a>
                <a href="{{ route('employer.profile') }}" class="sidebar-link {{ request()->routeIs('employer.profile') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear sidebar-icon"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('home') }}" class="sidebar-link bg-white/10 hover:bg-white/20">
                    <i class="fa-solid fa-house sidebar-icon"></i>
                    <span>Ke Beranda</span>
                </a>
            </nav>
            
            <div class="absolute bottom-4 left-4 right-4">
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="sidebar-link w-full text-left">
                        <i class="fa-solid fa-right-from-bracket sidebar-icon"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-visible">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-4 relative z-40">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Pemberi Kerja</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('employer.jobs.create') }}" class="hidden sm:inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fa-solid fa-plus"></i>
                            <span>Post Pekerjaan Baru</span>
                        </a>
                        <a href="{{ route('home') }}" class="hidden sm:inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fa-solid fa-house"></i>
                            <span>Ke Beranda</span>
                        </a>
                        <a href="{{ route('employer.profile') }}" class="flex items-center space-x-2 hover:opacity-90">
                            <img src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : 'https://via.placeholder.com/32' }}" alt="Employer" class="w-8 h-8 rounded-full object-cover">
                            <div class="flex items-center space-x-1">
                                <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                                @if(auth()->user()->subscription_plan === 'pro')
                                    <div class="bg-gradient-to-r from-orange-500 to-red-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold flex items-center space-x-1">
                                        <i class="fa-solid fa-crown text-yellow-300" style="font-size:10px;"></i>
                                        <span>PRO</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Pekerjaan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_jobs'] }}</p>
                                <p class="text-sm text-blue-600">Semua lowongan Anda</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-briefcase text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pekerjaan Aktif</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['active_jobs'] }}</p>
                                <p class="text-sm text-green-600">Sedang berjalan</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40">
                                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pekerjaan Selesai</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['completed_jobs'] }}</p>
                                <p class="text-sm text-purple-600">Proyek berhasil</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 ring-4 ring-purple-100/40">
                                <i class="fa-solid fa-trophy text-purple-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Lamaran</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_applications'] }}</p>
                                <p class="text-sm text-orange-600">Pelamar masuk</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 ring-4 ring-orange-100/40">
                                <i class="fa-solid fa-file-lines text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Jobs & Applications -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Jobs -->
                    <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(102,126,234,0.12);">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pekerjaan Terbaru</h3>
                            <a href="{{ route('employer.jobs') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_jobs as $job)
                                <div class="border-l-4 border-{{ $job->status === 'pending' ? 'yellow' : ($job->status === 'active' ? 'green' : 'blue') }}-500 pl-4 bg-white/60 p-3 rounded-lg">
                                    <p class="text-sm font-medium text-gray-800">{{ $job->title }}</p>
                                    <p class="text-xs text-gray-500">{{ $job->category->name }} • {{ $job->created_at->diffForHumans() }}</p>
                                    <div class="flex items-center space-x-2 mt-1">
                                        <span class="bg-{{ $job->status === 'pending' ? 'yellow' : ($job->status === 'active' ? 'green' : 'blue') }}-100 text-{{ $job->status === 'pending' ? 'yellow' : ($job->status === 'active' ? 'green' : 'blue') }}-800 text-xs px-2 py-1 rounded-full">
                                            {{ ucfirst($job->status) }}
                                        </span>
                                        <span class="text-xs text-gray-500">{{ $job->applications->count() }} lamaran</span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8 bg-white/60 rounded-lg">
                                    <i class="fa-solid fa-briefcase text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600">Belum ada pekerjaan</p>
                                    <a href="{{ route('employer.jobs.create') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Post pekerjaan pertama</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Applications -->
                    <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(249,115,22,0.12);">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Lamaran Terbaru</h3>
                            <a href="{{ route('employer.applications') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_applications as $application)
                                <div class="flex items-center space-x-3 bg-white/60 p-3 rounded-lg">
                                    <div class="w-10 h-10 bg-gradient-to-br from-orange-400 to-orange-600 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ substr($application->worker->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">{{ $application->worker->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $application->job->title }}</p>
                                        <p class="text-xs text-gray-400">{{ $application->applied_at->diffForHumans() }}</p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Baru</span>
                                </div>
                            @empty
                                <div class="text-center py-8 bg-white/60 rounded-lg">
                                    <i class="fa-solid fa-file-lines text-4xl text-gray-400 mb-2"></i>
                                    <p class="text-gray-600">Belum ada lamaran</p>
                                    <p class="text-sm text-gray-500">Lamaran akan muncul setelah Anda memposting pekerjaan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(249,115,22,0.12);">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('employer.jobs.create') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-blue-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-plus text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Post Pekerjaan</p>
                                <p class="text-sm text-gray-600">Buat lowongan baru</p>
                            </div>
                        </a>
                        <a href="{{ route('employer.applications') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-green-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40">
                                <i class="fa-solid fa-file-lines text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Lihat Lamaran</p>
                                <p class="text-sm text-gray-600">Kelola pelamar</p>
                            </div>
                        </a>
                        <a href="{{ route('employer.jobs') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-orange-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 ring-4 ring-orange-100/40">
                                <i class="fa-solid fa-briefcase text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Kelola Pekerjaan</p>
                                <p class="text-sm text-gray-600">Edit & monitor</p>
                            </div>
                        </a>
                        <a href="{{ route('employer.profile') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-purple-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 ring-4 ring-purple-100/40">
                                <i class="fa-solid fa-user text-purple-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Update Profil</p>
                                <p class="text-sm text-gray-600">Lengkapi profil</p>
                            </div>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
