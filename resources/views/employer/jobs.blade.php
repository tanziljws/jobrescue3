<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pekerjaan - Job Rescue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 min-h-screen p-4">
            <div class="flex items-center mb-8">
                <span class="text-2xl mr-2">🚀</span>
                <span class="text-xl font-bold">JobRescue</span>
            </div>
            
            <div class="mb-6 p-4 bg-gray-700 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-gray-300">Pemberi Kerja</p>
                    </div>
                </div>
            </div>
            
            <nav class="space-y-2">
                <a href="{{ route('employer.dashboard') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('employer.jobs') }}" class="flex items-center space-x-2 bg-gray-700 text-white p-3 rounded-lg">
                    <span>💼</span>
                    <span>Kelola Pekerjaan</span>
                </a>
                <a href="{{ route('employer.jobs.create') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>➕</span>
                    <span>Post Pekerjaan</span>
                </a>
                <a href="{{ route('employer.applications') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>📝</span>
                    <span>Lamaran Masuk</span>
                </a>
                <a href="{{ route('employer.profile') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>👤</span>
                    <span>Profil</span>
                </a>
            </nav>
            
            <div class="absolute bottom-4 left-4 right-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 text-gray-300 hover:text-white p-3 rounded-lg transition-colors w-full">
                        <span>🚪</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-4">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Kelola Pekerjaan</h1>
                    <div class="flex items-center space-x-4">
                        <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option>Semua Status</option>
                            <option>Draft</option>
                            <option>Pending</option>
                            <option>Active</option>
                            <option>Completed</option>
                        </select>
                        <a href="{{ route('employer.jobs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            + Post Pekerjaan Baru
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
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <span class="text-blue-600 text-lg">💼</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Pekerjaan</p>
                                <p class="text-xl font-bold text-gray-900">{{ $jobs->total() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-full mr-3">
                                <span class="text-green-600 text-lg">✅</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Aktif</p>
                                <p class="text-xl font-bold text-gray-900">{{ $jobs->where('status', 'active')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-2 rounded-full mr-3">
                                <span class="text-yellow-600 text-lg">⏳</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Pending</p>
                                <p class="text-xl font-bold text-gray-900">{{ $jobs->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-2 rounded-full mr-3">
                                <span class="text-purple-600 text-lg">📝</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Lamaran</p>
                                <p class="text-xl font-bold text-gray-900">{{ $jobs->sum('applications_count') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jobs List -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Pekerjaan</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @forelse($jobs as $job)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $job->title }}</h3>
                                            <span class="bg-{{ $job->status === 'pending' ? 'yellow' : ($job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'blue')) }}-100 text-{{ $job->status === 'pending' ? 'yellow' : ($job->status === 'active' ? 'green' : ($job->status === 'draft' ? 'gray' : 'blue')) }}-800 text-xs px-2 py-1 rounded-full font-medium">
                                                @if($job->status === 'pending')
                                                    ⏳ Menunggu Persetujuan
                                                @elseif($job->status === 'active')
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
                                <a href="{{ route('employer.jobs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-block">
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
