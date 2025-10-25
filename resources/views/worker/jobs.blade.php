<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Pekerjaan - Job Rescue</title>
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
                    <h1 class="text-2xl font-bold text-gray-800">Cari Pekerjaan</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-gray-600">{{ $jobs->count() }} pekerjaan tersedia</span>
                        <a href="{{ route('home') }}" class="flex items-center space-x-2 bg-gray-100 hover:bg-gray-200 px-3 py-2 rounded-lg transition-colors">
                            <i class="fa-solid fa-house"></i>
                            <span>Ke Beranda</span>
                        </a>
                        <a href="{{ route('worker.profile') }}" class="flex items-center space-x-2 hover:opacity-90">
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

            <!-- Search & Filters -->
            <div class="bg-white border-b border-gray-200 p-4">
                <form method="GET" action="{{ route('worker.jobs') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-2">
                            <input 
                                type="text" 
                                name="search" 
                                value="{{ request('search') }}"
                                placeholder="Cari pekerjaan berdasarkan judul atau deskripsi..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            >
                        </div>
                        <div>
                            <select 
                                name="category" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            >
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->icon }} {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button 
                                type="submit" 
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg transition-colors"
                            >
                                🔍 Cari
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Filters -->
                    <div class="border-t border-gray-200 pt-4">
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                            <div>
                                <select name="job_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                                    <option value="">Semua Tipe</option>
                                    <option value="freelance" {{ request('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="part_time" {{ request('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="full_time" {{ request('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="contract" {{ request('job_type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                                </select>
                            </div>
                            <div>
                                <input 
                                    type="text" 
                                    name="location" 
                                    value="{{ request('location') }}"
                                    placeholder="Lokasi (Kecamatan)"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-orange-500"
                                >
                            </div>
                            <div>
                                @if(request()->hasAny(['search', 'category', 'job_type', 'location']))
                                    <a href="{{ route('worker.jobs') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition-colors text-center block text-sm">
                                        Reset Filter
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Jobs Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Sort Options -->
                <div class="flex items-center justify-between mb-6">
                    <p class="text-gray-600">
                        Menampilkan {{ $jobs->firstItem() ?? 0 }}-{{ $jobs->lastItem() ?? 0 }} dari {{ $jobs->total() }} pekerjaan
                    </p>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-600">Urutkan:</span>
                        <select class="border border-gray-300 rounded-lg px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option>Terbaru</option>
                            <option>Deadline Terdekat</option>
                            <option>Paling Relevan</option>
                        </select>
                    </div>
                </div>

                <!-- Jobs Grid -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @forelse($jobs as $job)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-2 mb-3">
                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full font-medium">{{ $job->category->name }}</span>
                                        @if($job->is_urgent)
                                            <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full font-medium">🔥 Mendesak</span>
                                        @endif
                                        <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">{{ ucfirst(str_replace('_', ' ', $job->job_type)) }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">{{ $job->title }}</h3>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-3">{{ Str::limit($job->description, 120) }}</p>
                                </div>
                            </div>

                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-2">🏢</span>
                                    <span class="font-medium">{{ $job->employer->name }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <span class="mr-2">📍</span>
                                    <span>{{ $job->location }}</span>
                                </div>
                                <div class="flex items-center justify-between text-sm text-gray-600">
                                    <div class="flex items-center">
                                        <span class="mr-2">📝</span>
                                        <span>{{ $job->applications_count }} lamaran</span>
                                    </div>
                                    @if($job->deadline)
                                        <div class="flex items-center">
                                            <span class="mr-1">⏰</span>
                                            <span class="text-xs">{{ $job->deadline->diffForHumans() }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if($job->skills_required)
                                <div class="mb-4">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($job->skills_required, 0, 3) as $skill)
                                            <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">{{ $skill }}</span>
                                        @endforeach
                                        @if(count($job->skills_required) > 3)
                                            <span class="text-xs text-gray-500 px-2 py-1">+{{ count($job->skills_required) - 3 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <span class="text-xs text-gray-500">{{ $job->created_at->diffForHumans() }}</span>
                                <div class="flex space-x-2">
                                    <button onclick="saveJob({{ $job->id }})" class="text-gray-400 hover:text-orange-500 transition-colors" title="Simpan pekerjaan">
                                        <span class="text-lg">🔖</span>
                                    </button>
                                    <a 
                                        href="{{ route('jobs.show', $job) }}" 
                                        class="bg-orange-500 hover:bg-orange-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition-colors"
                                    >
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-6xl mb-4">🔍</div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak ada pekerjaan ditemukan</h3>
                            <p class="text-gray-600 mb-4">Coba ubah filter pencarian atau kata kunci Anda</p>
                            <a href="{{ route('worker.jobs') }}" class="text-orange-500 hover:text-orange-600 font-medium">
                                Lihat semua pekerjaan
                            </a>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($jobs->hasPages())
                    <div class="flex justify-center mt-8">
                        {{ $jobs->links() }}
                    </div>
                @endif

                <!-- Quick Apply Tips -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">💡 Tips Melamar Pekerjaan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-blue-800">
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Baca deskripsi pekerjaan dengan teliti sebelum melamar</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Tulis cover letter yang personal dan relevan</span>
                        </div>
                        <div class="flex items-start space-x-2">
                            <span>✅</span>
                            <span>Sertakan portfolio yang sesuai dengan pekerjaan</span>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        function saveJob(jobId) {
            // Here you would make an AJAX request to save the job
            fetch(`/jobs/${jobId}/save`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Pekerjaan berhasil disimpan!');
                } else {
                    alert('Gagal menyimpan pekerjaan. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }
    </script>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>
