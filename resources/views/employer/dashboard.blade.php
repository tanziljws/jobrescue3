<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pemberi Kerja - Job Rescue</title>
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
                <a href="{{ route('employer.dashboard') }}" class="flex items-center space-x-2 bg-gray-700 text-white p-3 rounded-lg">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('employer.jobs') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
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
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Pemberi Kerja</h1>
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('employer.jobs.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            + Post Pekerjaan Baru
                        </a>
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
                                <p class="text-sm font-medium text-gray-600">Total Pekerjaan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_jobs'] }}</p>
                            </div>
                            <div class="bg-blue-100 p-3 rounded-full">
                                <span class="text-2xl">💼</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Pekerjaan Aktif</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['active_jobs'] }}</p>
                            </div>
                            <div class="bg-green-100 p-3 rounded-full">
                                <span class="text-2xl">✅</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Menunggu Persetujuan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['pending_jobs'] }}</p>
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-full">
                                <span class="text-2xl">⏳</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Lamaran</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $stats['total_applications'] }}</p>
                            </div>
                            <div class="bg-orange-100 p-3 rounded-full">
                                <span class="text-2xl">📝</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Jobs & Applications -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- Recent Jobs -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pekerjaan Terbaru</h3>
                            <a href="{{ route('employer.jobs') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_jobs as $job)
                                <div class="border-l-4 border-{{ $job->status === 'pending' ? 'yellow' : ($job->status === 'active' ? 'green' : 'blue') }}-500 pl-4">
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
                                <div class="text-center py-8">
                                    <span class="text-4xl mb-2 block">💼</span>
                                    <p class="text-gray-600">Belum ada pekerjaan</p>
                                    <a href="{{ route('employer.jobs.create') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Post pekerjaan pertama</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Recent Applications -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Lamaran Terbaru</h3>
                            <a href="{{ route('employer.applications') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            @forelse($recent_applications as $application)
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-600">{{ substr($application->worker->name, 0, 1) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-800">{{ $application->worker->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $application->job->title }}</p>
                                        <p class="text-xs text-gray-400">{{ $application->applied_at->diffForHumans() }}</p>
                                    </div>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Baru</span>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <span class="text-4xl mb-2 block">📝</span>
                                    <p class="text-gray-600">Belum ada lamaran</p>
                                    <p class="text-sm text-gray-500">Lamaran akan muncul setelah Anda memposting pekerjaan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <a href="{{ route('employer.jobs.create') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-blue-100 p-2 rounded-full">
                                <span class="text-xl">➕</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Post Pekerjaan</p>
                                <p class="text-sm text-gray-600">Buat lowongan baru</p>
                            </div>
                        </a>
                        <a href="{{ route('employer.applications') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-green-100 p-2 rounded-full">
                                <span class="text-xl">📝</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Lihat Lamaran</p>
                                <p class="text-sm text-gray-600">Kelola pelamar</p>
                            </div>
                        </a>
                        <a href="{{ route('employer.jobs') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-orange-100 p-2 rounded-full">
                                <span class="text-xl">💼</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Kelola Pekerjaan</p>
                                <p class="text-sm text-gray-600">Edit & monitor</p>
                            </div>
                        </a>
                        <a href="{{ route('employer.profile') }}" class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow-md transition-shadow">
                            <div class="bg-purple-100 p-2 rounded-full">
                                <span class="text-xl">👤</span>
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
