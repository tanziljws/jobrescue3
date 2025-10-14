<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Lamaran - Job Rescue</title>
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
                        <p class="text-sm text-gray-300">Pekerja</p>
                    </div>
                </div>
            </div>
            
            <nav class="space-y-2">
                <a href="{{ route('worker.dashboard') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('worker.jobs') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>🔍</span>
                    <span>Cari Pekerjaan</span>
                </a>
                <a href="{{ route('worker.applications') }}" class="flex items-center space-x-2 bg-gray-700 text-white p-3 rounded-lg">
                    <span>📝</span>
                    <span>Lamaran Saya</span>
                </a>
                <a href="{{ route('worker.profile') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-800">Riwayat Lamaran</h1>
                    <div class="flex items-center space-x-4">
                        <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-orange-500">
                            <option>Semua Status</option>
                            <option>Pending</option>
                            <option>Diterima</option>
                            <option>Ditolak</option>
                        </select>
                        <a href="{{ route('worker.jobs') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            + Cari Pekerjaan Lagi
                        </a>
                    </div>
                </div>
            </header>

            <!-- Applications Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-full mr-3">
                                <span class="text-blue-600 text-lg">📝</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Lamaran</p>
                                <p class="text-xl font-bold text-gray-900">{{ $applications->total() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-yellow-100 p-2 rounded-full mr-3">
                                <span class="text-yellow-600 text-lg">⏳</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Menunggu</p>
                                <p class="text-xl font-bold text-gray-900">{{ $applications->where('status', 'pending')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-full mr-3">
                                <span class="text-green-600 text-lg">✅</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Diterima</p>
                                <p class="text-xl font-bold text-gray-900">{{ $applications->where('status', 'accepted')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4">
                        <div class="flex items-center">
                            <div class="bg-red-100 p-2 rounded-full mr-3">
                                <span class="text-red-600 text-lg">❌</span>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Ditolak</p>
                                <p class="text-xl font-bold text-gray-900">{{ $applications->where('status', 'rejected')->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applications List -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Lamaran</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @forelse($applications as $application)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-3 mb-2">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $application->job->title }}</h3>
                                            <span class="bg-{{ $application->status === 'pending' ? 'yellow' : ($application->status === 'accepted' ? 'green' : 'red') }}-100 text-{{ $application->status === 'pending' ? 'yellow' : ($application->status === 'accepted' ? 'green' : 'red') }}-800 text-xs px-2 py-1 rounded-full font-medium">
                                                @if($application->status === 'pending')
                                                    ⏳ Menunggu
                                                @elseif($application->status === 'accepted')
                                                    ✅ Diterima
                                                @elseif($application->status === 'rejected')
                                                    ❌ Ditolak
                                                @else
                                                    📤 {{ ucfirst($application->status) }}
                                                @endif
                                            </span>
                                        </div>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Perusahaan:</span> {{ $application->job->employer->name }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Kategori:</span> {{ $application->job->category->name }}
                                                </p>
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Lokasi:</span> {{ $application->job->location }}
                                                </p>
                                            </div>
                                            <div class="space-y-1">
                                                <p class="text-sm text-gray-600">
                                                    <span class="font-medium">Tanggal Lamar:</span> {{ $application->applied_at->format('d M Y') }}
                                                </p>
                                                @if($application->proposed_budget)
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Budget Diajukan:</span> Rp {{ number_format($application->proposed_budget) }}
                                                    </p>
                                                @endif
                                                @if($application->estimated_days)
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Estimasi:</span> {{ $application->estimated_days }} hari
                                                    </p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <p class="text-sm font-medium text-gray-700 mb-1">Cover Letter:</p>
                                            <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($application->cover_letter, 150) }}</p>
                                        </div>

                                        @if($application->employer_notes)
                                            <div class="bg-gray-50 rounded-lg p-3 mb-3">
                                                <p class="text-sm font-medium text-gray-700 mb-1">Catatan dari Pemberi Kerja:</p>
                                                <p class="text-sm text-gray-600">{{ $application->employer_notes }}</p>
                                            </div>
                                        @endif

                                        @if($application->portfolio_links)
                                            <div class="mb-3">
                                                <p class="text-sm font-medium text-gray-700 mb-1">Portfolio:</p>
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach($application->portfolio_links as $link)
                                                        <a href="{{ $link }}" target="_blank" class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full hover:bg-blue-200 transition-colors">
                                                            🔗 Portfolio {{ $loop->iteration }}
                                                        </a>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex flex-col space-y-2 ml-4">
                                        <a href="{{ route('jobs.show', $application->job) }}" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-2 rounded-lg transition-colors text-center">
                                            👁️ Lihat Job
                                        </a>
                                        
                                        @if($application->status === 'pending')
                                            <button onclick="withdrawApplication({{ $application->id }})" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                🗑️ Tarik Lamaran
                                            </button>
                                        @endif

                                        @if($application->status === 'accepted')
                                            <button class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                💬 Chat Employer
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center">
                                <div class="text-6xl mb-4">📝</div>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Lamaran</h3>
                                <p class="text-gray-600 mb-6">Anda belum melamar pekerjaan apapun. Mulai cari pekerjaan yang sesuai dengan keahlian Anda!</p>
                                <a href="{{ route('worker.jobs') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-block">
                                    🔍 Cari Pekerjaan Sekarang
                                </a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    @if($applications->hasPages())
                        <div class="p-6 border-t border-gray-200">
                            {{ $applications->links() }}
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>

    <script>
        function withdrawApplication(applicationId) {
            if (confirm('Apakah Anda yakin ingin menarik lamaran ini?')) {
                // Here you would make an AJAX request to withdraw the application
                fetch(`/applications/${applicationId}/withdraw`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        status: 'withdrawn'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal menarik lamaran. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                });
            }
        }
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
