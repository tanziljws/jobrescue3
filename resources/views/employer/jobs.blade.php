@php
use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pekerjaan - Job Rescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @media (min-width: 1024px) {
            .employer-has-fixed-sidebar { padding-left: 16rem; }
        }
        .employer-sidebar .sidebar-icon { color: rgba(249,115,22,0.7); transition: color .2s ease; }
        .sidebar-link { display:flex; align-items:center; gap:.5rem; color:#eef2ff; padding:.75rem .85rem; border-radius:12px; transition: all .2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,.12); color:#fff; }
        .sidebar-link.active { background: rgba(255,255,255,.22); color:#fff; }
        .sidebar-link:hover .sidebar-icon { color:#f97316; }
        .sidebar-link.active .sidebar-icon { color:#f97316; }
        .employer-nav a.active span { color: #fff; }
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
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Pekerjaan</h1>
                    <div class="flex items-center space-x-4">
                        <select class="border border-blue-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-50 text-blue-700 flex items-center gap-2">
                            <option>Semua Status</option>
                            <option>Draft</option>
                            <option>Active</option>
                            <option>Completed</option>
                        </select>
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

            <!-- Jobs Content -->
            <main class="p-6 overflow-y-auto h-full">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <span class="text-green-400 mr-2">✅</span>
                            <p class="text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Pekerjaan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $jobs->total() }}</p>
                                <p class="text-sm text-blue-600">Semua lowongan</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-briefcase text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Aktif</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $jobs->where('status', 'active')->count() }}</p>
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
                                <p class="text-sm font-medium text-gray-600">Selesai</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $jobs->where('status', 'completed')->count() }}</p>
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
                                <p class="text-3xl font-bold text-gray-900">{{ $jobs->sum('applications_count') }}</p>
                                <p class="text-sm text-purple-600">Pelamar masuk</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 ring-4 ring-purple-100/40">
                                <i class="fa-solid fa-file-lines text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jobs List -->
                <div class="rounded-xl shadow-sm border border-gray-100" style="background: rgba(102,126,234,0.12);">
                    <div class="p-6 border-b border-gray-200/50">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fa-solid fa-list text-blue-600"></i>
                            Daftar Pekerjaan
                        </h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @forelse($jobs as $job)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $job->title }}</h3>
                                            <span class="bg-{{ $job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'blue') }}-100 text-{{ $job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'blue') }}-800 text-xs px-2 py-1 rounded-full font-medium">
                                                @if($job->status === 'active')
                                                    ✅ Aktif
                                                @elseif($job->status === 'draft')
                                                    📝 Draft
                                                @elseif($job->status === 'completed')
                                                    🏁 Selesai
                                                @else
                                                    {{ ucfirst($job->status) }}
                                                @endif
                                            </span>
                                            @if($job->is_urgent)
                                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium">🔥 Mendesak</span>
                                            @endif
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Kategori:</span> {{ $job->category->name }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Lokasi:</span> {{ $job->location }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Tipe:</span> {{ ucfirst(str_replace('_', ' ', $job->job_type)) }}
                                                </p>
                                            </div>
                                            <div class="space-y-1">
                                                @if($job->budget_min && $job->budget_max)
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Budget:</span> Rp {{ number_format($job->budget_min) }} - {{ number_format($job->budget_max) }}
                                                    </p>
                                                @endif
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Dibuat:</span> {{ $job->created_at->format('d M Y') }}
                                                </p>
                                                @if($job->deadline)
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Deadline:</span> {{ $job->deadline->format('d M Y') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($job->description, 150) }}</p>

                                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                                            <span class="flex items-center">
                                                <span class="mr-1">📝</span>
                                                {{ $job->applications->count() }} lamaran
                                            </span>
                                            <span class="flex items-center">
                                                <span class="mr-1">👁️</span>
                                                245 views
                                            </span>
                                            @if($job->applications->where('status', 'pending')->count() > 0)
                                                <span class="flex items-center text-orange-600 font-medium">
                                                    <span class="mr-1">🔔</span>
                                                    {{ $job->applications->where('status', 'pending')->count() }} lamaran baru
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-2 ml-4">
                                        <a href="{{ route('jobs.show', $job) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-2 rounded-lg transition-colors text-center">
                                            👁️ Lihat
                                        </a>
                                        
                                        @if($job->applications->count() > 0)
                                            <a href="{{ route('employer.applications', $job->id) }}" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-2 rounded-lg transition-colors text-center">
                                                📝 Lamaran ({{ $job->applications->count() }})
                                            </a>
                                        @endif

                                        @if($job->status === 'draft' || $job->status === 'pending')
                                            <button onclick="editJob({{ $job->id }})" class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                ✏️ Edit
                                            </button>
                                        @endif

                                        @if($job->status === 'active')
                                            <button onclick="markCompleted({{ $job->id }})" class="bg-purple-500 hover:bg-purple-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                🏁 Selesai
                                            </button>
                                        @endif

                                        <div class="relative">
                                            <button onclick="toggleDropdown({{ $job->id }})" class="bg-gray-500 hover:bg-gray-600 text-white text-xs px-3 py-2 rounded-lg transition-colors w-full">
                                                ⋮ Lainnya
                                            </button>
                                            <div id="dropdown-{{ $job->id }}" class="hidden absolute right-0 mt-1 w-32 bg-white rounded-lg shadow-lg border border-gray-200 z-10">
                                                <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100">📊 Statistik</a>
                                                <a href="#" class="block px-3 py-2 text-xs text-gray-700 hover:bg-gray-100">📋 Duplikat</a>
                                                <button onclick="deleteJob({{ $job->id }})" class="block w-full text-left px-3 py-2 text-xs text-red-600 hover:bg-red-50">🗑️ Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <div class="text-6xl mb-4">💼</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Pekerjaan</h3>
                                <p class="text-gray-600 mb-6">Mulai posting pekerjaan pertama Anda untuk menarik pekerja terbaik!</p>
                                <a href="{{ route('employer.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-block">
                                    + Post Pekerjaan Pertama
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($jobs->hasPages())
                        <div class="p-6 border-t border-gray-200">
                            {{ $jobs->links() }}
                        </div>
                    @endif
                </div>

                <!-- Tips Section -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">💡 Tips Mengelola Pekerjaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Respon lamaran dengan cepat untuk mendapatkan pekerja terbaik</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Berikan feedback yang konstruktif kepada pelamar</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Update status pekerjaan secara berkala</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Berikan rating dan ulasan setelah proyek selesai</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function toggleDropdown(jobId) {
            const dropdown = document.getElementById(`dropdown-${jobId}`);
            dropdown.classList.toggle('hidden');
            
            // Close other dropdowns
            document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                if (el.id !== `dropdown-${jobId}`) {
                    el.classList.add('hidden');
                }
            });
        }

        function editJob(jobId) {
            window.location.href = `/employer/jobs/${jobId}/edit`;
        }

        function markCompleted(jobId) {
            if (confirm('Apakah Anda yakin pekerjaan ini sudah selesai?')) {
                fetch(`/employer/jobs/${jobId}/complete`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status: 'completed'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menandai pekerjaan selesai. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        }

        function deleteJob(jobId) {
            if (confirm('Apakah Anda yakin ingin menghapus pekerjaan ini? Tindakan ini tidak dapat dibatalkan.')) {
                fetch(`/employer/jobs/${jobId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menghapus pekerjaan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('[onclick^="toggleDropdown"]')) {
                document.querySelectorAll('[id^="dropdown-"]').forEach(el => {
                    el.classList.add('hidden');
                });
            }
        });
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>
