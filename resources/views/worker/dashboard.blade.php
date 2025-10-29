<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pekerja - Job Rescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body { font-family: 'Poppins', sans-serif; }
        /* Reserve space for fixed sidebar on large screens */
        @media (min-width: 1024px) {
            .worker-has-fixed-sidebar { padding-left: 16rem; }
        }
        .worker-sidebar .sidebar-icon { color: rgba(249,115,22,0.7); transition: color .2s ease; }
        /* Unified sidebar link styling */
        .sidebar-link { display:flex; align-items:center; gap:.5rem; color:#eef2ff; padding:.75rem .85rem; border-radius:12px; transition: all .2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,.12); color:#fff; }
        .sidebar-link.active { background: rgba(255,255,255,.22); color:#fff; }
        .sidebar-link:hover .sidebar-icon { color:#f97316; }
        .sidebar-link.active .sidebar-icon { color:#f97316; }
        .worker-nav a.active span { color: #fff; }
        /* Orange transparent metric card */
        .metric-card {
            background: rgba(249,115,22,.12);
            border: 2px solid rgba(249,115,22,.25);
            box-shadow: 0 10px 30px rgba(249,115,22,.10);
        }
    </style>
</head>
<body class="bg-gray-50 worker-has-fixed-sidebar">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-[#667eea] text-white w-64 h-screen fixed top-0 left-0 bottom-0 p-4 worker-sidebar overflow-y-auto" style="background-color:#667eea;">
            <div class="flex items-center mb-8">
                <img src="{{ asset('img/icon.svg') }}" alt="JobRescue" class="w-6 h-6 mr-2" style="width:24px;height:24px;">
                <span class="text-xl font-bold">JobRescue Worker</span>
            </div>
            
            <nav class="space-y-2 worker-nav">
                <a href="{{ route('worker.dashboard') }}" class="sidebar-link {{ request()->routeIs('worker.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-line sidebar-icon"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('worker.jobs') }}" class="sidebar-link {{ request()->routeIs('worker.jobs') ? 'active' : '' }}">
                    <i class="fa-solid fa-search sidebar-icon"></i>
                    <span>Cari Pekerjaan</span>
                </a>
                <a href="{{ route('worker.applications') }}" class="sidebar-link {{ request()->routeIs('worker.applications') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-lines sidebar-icon"></i>
                    <span>Lamaran Saya</span>
                </a>
                <a href="{{ route('worker.profile') }}" class="sidebar-link {{ request()->routeIs('worker.profile') ? 'active' : '' }}">
                    <i class="fa-solid fa-user sidebar-icon"></i>
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
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Pekerja</h1>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Selamat datang kembali,</p>
                            <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        </div>
                        <a href="{{ route('worker.dashboard') }}" class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg transition-colors">
                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                <span class="text-white text-sm font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
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
                                <p class="text-sm font-medium text-gray-600">Total Lamaran</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['total_applications'] }}</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-file-lines text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Dalam Proses</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['pending_applications'] }}</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-yellow-50 to-amber-100 ring-4 ring-yellow-100/40">
                                <i class="fa-solid fa-clock text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Diterima</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['accepted_applications'] }}</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40">
                                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pekerjaan Tersedia</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $stats['available_jobs'] }}</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 ring-4 ring-orange-100/40">
                                <i class="fa-solid fa-briefcase text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Applications & Recommended Jobs -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Applications -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Lamaran Terbaru</h3>
                            <a href="{{ route('worker.applications') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_applications as $application)
                                <div class="border-l-4 border-{{ $application->status === 'pending' ? 'yellow' : ($application->status === 'accepted' ? 'green' : 'red') }}-500 pl-4">
                                    <p class="text-sm font-medium text-gray-800">{{ $application->job->title }}</p>
                                    <p class="text-xs text-gray-500">{{ $application->job->employer->name }} • {{ $application->applied_at->diffForHumans() }}</p>
                                    <span class="bg-{{ $application->status === 'pending' ? 'yellow' : ($application->status === 'accepted' ? 'green' : 'red') }}-100 text-{{ $application->status === 'pending' ? 'yellow' : ($application->status === 'accepted' ? 'green' : 'red') }}-800 text-xs px-2 py-1 rounded-full mt-1 inline-block">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <span class="text-4xl mb-2 block">📝</span>
                                    <p class="text-gray-600">Belum ada lamaran</p>
                                    <a href="{{ route('worker.jobs') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Cari pekerjaan sekarang</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recommended Jobs -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Rekomendasi Pekerjaan</h3>
                            <a href="{{ route('worker.jobs') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recommended_jobs as $job)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between">
                                        <div class="flex-1">
                                            <h4 class="font-medium text-gray-800">{{ $job->title }}</h4>
                                            <p class="text-sm text-gray-600">{{ $job->employer->name }}</p>
                                            <div class="flex items-center space-x-2 mt-2">
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $job->category->name }}</span>
                                                @if($job->budget_min && $job->budget_max)
                                                    <span class="text-xs text-gray-500">Rp {{ number_format($job->budget_min) }} - {{ number_format($job->budget_max) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <a href="{{ route('jobs.show', $job) }}" class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-3 py-1 rounded-full transition-colors">
                                            Lihat
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <span class="text-4xl mb-2 block">🔍</span>
                                    <p class="text-gray-600">Belum ada rekomendasi</p>
                                    <p class="text-sm text-gray-500">Lengkapi profil untuk mendapat rekomendasi yang lebih baik</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(249,115,22,0.12);">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('worker.jobs') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-blue-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-search text-blue-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Cari Pekerjaan</p>
                                <p class="text-sm text-gray-600">Temukan pekerjaan yang sesuai</p>
                            </div>
                        </a>
                        <a href="{{ route('worker.profile') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-green-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40">
                                <i class="fa-solid fa-user text-emerald-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Update Profil</p>
                                <p class="text-sm text-gray-600">Lengkapi profil Anda</p>
                            </div>
                        </a>
                        <a href="{{ route('worker.applications') }}" class="flex items-center space-x-3 p-4 bg-white rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-orange-200">
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 ring-4 ring-orange-100/40">
                                <i class="fa-solid fa-file-lines text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Kelola Lamaran</p>
                                <p class="text-sm text-gray-600">Lihat status lamaran</p>
                            </div>
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
