<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pekerja - Job Rescue</title>
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
                <a href="{{ route('worker.dashboard') }}" class="flex items-center space-x-2 bg-gray-700 text-white p-3 rounded-lg">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('worker.jobs') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>🔍</span>
                    <span>Cari Pekerjaan</span>
                </a>
                <a href="{{ route('worker.applications') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Pekerja</h1>
                    <div class="flex items-center space-x-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Selamat datang kembali,</p>
                            <p class="font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Lamaran</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_applications'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <span class="text-2xl">📝</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Menunggu Respon</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_applications'] }}</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <span class="text-2xl">⏳</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Diterima</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['accepted_applications'] }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <span class="text-2xl">✅</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pekerjaan Tersedia</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['available_jobs'] }}</p>
                            </div>
                            <div class="bg-orange-100 p-3 rounded-full">
                                <span class="text-2xl">💼</span>
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
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('worker.jobs') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <span class="text-xl">🔍</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Cari Pekerjaan</p>
                                <p class="text-sm text-gray-600">Temukan pekerjaan yang sesuai</p>
                            </div>
                        </a>
                        <a href="{{ route('worker.profile') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-green-100 p-2 rounded-full">
                                <span class="text-xl">👤</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Update Profil</p>
                                <p class="text-sm text-gray-600">Lengkapi profil Anda</p>
                            </div>
                        </a>
                        <a href="{{ route('worker.applications') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-orange-100 p-2 rounded-full">
                                <span class="text-xl">📝</span>
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
