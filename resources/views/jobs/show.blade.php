<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $job->title }} - Job Rescue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl mr-2">🚀</span>
                        <span class="text-xl font-bold text-gray-800">JobRescue</span>
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Beranda</a>
                        <a href="{{ route('jobs.index') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Cari Kerja</a>
                        @auth
                            @if(Auth::user()->role === 'worker')
                                <a href="{{ route('worker.dashboard') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                            @elseif(Auth::user()->role === 'employer')
                                <a href="{{ route('employer.dashboard') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                            @elseif(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Admin</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium transition-colors">Login</a>
                            <a href="{{ route('register') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Daftar</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Breadcrumb -->
        <div class="mb-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-gray-700">Beranda</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="{{ route('jobs.index') }}" class="text-gray-500 hover:text-gray-700">Pekerjaan</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><span class="text-gray-900">{{ Str::limit($job->title, 50) }}</span></li>
                </ol>
            </nav>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Job Header -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-3">
                                <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $job->category->name }}</span>
                                @if($job->is_urgent)
                                    <span class="bg-red-100 text-red-800 text-sm px-3 py-1 rounded-full">🔥 Mendesak</span>
                                @endif
                                <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full">{{ ucfirst($job->job_type) }}</span>
                            </div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $job->title }}</h1>
                            <div class="flex items-center space-x-4 text-gray-600">
                                <div class="flex items-center">
                                    <span class="mr-2">🏢</span>
                                    <span>{{ $job->employer->name }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">📍</span>
                                    <span>{{ $job->location }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-2">📅</span>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($job->budget_min && $job->budget_max)
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-600">Budget</p>
                                    <p class="text-2xl font-bold text-gray-900">
                                        Rp {{ number_format($job->budget_min) }} - {{ number_format($job->budget_max) }}
                                    </p>
                                    <p class="text-sm text-gray-500">{{ ucfirst($job->budget_type) }}</p>
                                </div>
                                @if($job->deadline)
                                    <div class="text-right">
                                        <p class="text-sm text-gray-600">Deadline</p>
                                        <p class="font-semibold text-gray-900">{{ $job->deadline->format('d M Y') }}</p>
                                        <p class="text-sm text-gray-500">{{ $job->deadline->diffForHumans() }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4 text-sm text-gray-600">
                            <span>📝 {{ $job->applications_count }} lamaran</span>
                            <span>👁️ 245 views</span>
                        </div>
                        @auth
                            @if(Auth::user()->role === 'worker')
                                @if($hasApplied)
                                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-lg font-medium">
                                        ✅ Sudah Melamar
                                    </span>
                                @else
                                    <button 
                                        onclick="document.getElementById('application-form').scrollIntoView({behavior: 'smooth'})"
                                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
                                    >
                                        Lamar Sekarang
                                    </button>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors">
                                Login untuk Melamar
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Job Description -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Deskripsi Pekerjaan</h2>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($job->description)) !!}
                    </div>
                </div>

                <!-- Requirements & Skills -->
                @if($job->requirements || $job->skills_required)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($job->requirements)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Persyaratan</h3>
                                    <ul class="space-y-2">
                                        @foreach($job->requirements as $requirement)
                                            <li class="flex items-start">
                                                <span class="text-orange-500 mr-2 mt-1">•</span>
                                                <span class="text-gray-700">{{ $requirement }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if($job->skills_required)
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Keahlian yang Dibutuhkan</h3>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($job->skills_required as $skill)
                                            <span class="bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded-full">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Application Form -->
                @auth
                    @if(Auth::user()->role === 'worker' && !$hasApplied)
                        <div id="application-form" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h2 class="text-xl font-semibold text-gray-900 mb-4">Lamar Pekerjaan Ini</h2>
                            
                            @if(session('success'))
                                <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
                                    <div class="flex">
                                        <span class="text-green-400 mr-2">✅</span>
                                        <p class="text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
                                    <div class="flex">
                                        <span class="text-red-400 mr-2">⚠️</span>
                                        <p class="text-red-800">{{ session('error') }}</p>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('jobs.apply', $job) }}" class="space-y-4">
                                @csrf
                                
                                <div>
                                    <label for="cover_letter" class="block text-sm font-medium text-gray-700 mb-2">
                                        Cover Letter *
                                    </label>
                                    <textarea 
                                        id="cover_letter" 
                                        name="cover_letter" 
                                        rows="6" 
                                        required
                                        class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('cover_letter') border-red-500 @enderror"
                                        placeholder="Jelaskan mengapa Anda cocok untuk pekerjaan ini, pengalaman relevan, dan bagaimana Anda akan menyelesaikan proyek ini..."
                                    >{{ old('cover_letter') }}</textarea>
                                    @error('cover_letter')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="proposed_budget" class="block text-sm font-medium text-gray-700 mb-2">
                                            Budget yang Diajukan (Rp)
                                        </label>
                                        <input 
                                            type="number" 
                                            id="proposed_budget" 
                                            name="proposed_budget" 
                                            min="0"
                                            value="{{ old('proposed_budget') }}"
                                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('proposed_budget') border-red-500 @enderror"
                                            placeholder="500000"
                                        >
                                        @error('proposed_budget')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="estimated_days" class="block text-sm font-medium text-gray-700 mb-2">
                                            Estimasi Hari Pengerjaan
                                        </label>
                                        <input 
                                            type="number" 
                                            id="estimated_days" 
                                            name="estimated_days" 
                                            min="1"
                                            value="{{ old('estimated_days') }}"
                                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent @error('estimated_days') border-red-500 @enderror"
                                            placeholder="7"
                                        >
                                        @error('estimated_days')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <label for="portfolio_links" class="block text-sm font-medium text-gray-700 mb-2">
                                        Link Portfolio (Opsional)
                                    </label>
                                    <div id="portfolio-container">
                                        <input 
                                            type="url" 
                                            name="portfolio_links[]" 
                                            value="{{ old('portfolio_links.0') }}"
                                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent mb-2"
                                            placeholder="https://portfolio.com/project1"
                                        >
                                    </div>
                                    <button 
                                        type="button" 
                                        onclick="addPortfolioField()"
                                        class="text-orange-500 hover:text-orange-600 text-sm font-medium"
                                    >
                                        + Tambah Link Portfolio
                                    </button>
                                </div>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                                    <p class="text-sm text-gray-600">
                                        Dengan melamar, Anda menyetujui syarat dan ketentuan kami.
                                    </p>
                                    <button 
                                        type="submit" 
                                        class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
                                    >
                                        Kirim Lamaran
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Employer Info -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Pemberi Kerja</h3>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold">{{ substr($job->employer->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900">{{ $job->employer->name }}</p>
                            <p class="text-sm text-gray-600">{{ $job->employer->city }}</p>
                        </div>
                    </div>
                    @if($job->employer->bio)
                        <p class="text-sm text-gray-700 mb-4">{{ $job->employer->bio }}</p>
                    @endif
                    <div class="space-y-2 text-sm text-gray-600">
                        <div class="flex items-center justify-between">
                            <span>Total Pekerjaan</span>
                            <span class="font-medium">{{ $job->employer->employerJobs->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span>Bergabung</span>
                            <span class="font-medium">{{ $job->employer->created_at->format('M Y') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Similar Jobs -->
                @if($similarJobs->count() > 0)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Pekerjaan Serupa</h3>
                        <div class="space-y-4">
                            @foreach($similarJobs as $similarJob)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <h4 class="font-medium text-gray-900 mb-2">{{ Str::limit($similarJob->title, 60) }}</h4>
                                    <p class="text-sm text-gray-600 mb-2">{{ $similarJob->employer->name }}</p>
                                    <div class="flex items-center justify-between">
                                        @if($similarJob->budget_min && $similarJob->budget_max)
                                            <span class="text-sm text-gray-500">Rp {{ number_format($similarJob->budget_min) }}+</span>
                                        @endif
                                        <a href="{{ route('jobs.show', $similarJob) }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">
                                            Lihat →
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Share -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Bagikan Pekerjaan</h3>
                    <div class="flex space-x-2">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                            Facebook
                        </button>
                        <button class="flex-1 bg-blue-400 hover:bg-blue-500 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                            Twitter
                        </button>
                        <button class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-3 rounded-lg text-sm font-medium transition-colors">
                            WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addPortfolioField() {
            const container = document.getElementById('portfolio-container');
            const input = document.createElement('input');
            input.type = 'url';
            input.name = 'portfolio_links[]';
            input.className = 'w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent mb-2';
            input.placeholder = 'https://portfolio.com/project';
            container.appendChild(input);
        }
    </script>
</body>
</html>
