@php
use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Perusahaan - Job Rescue</title>
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
                    <h1 class="text-2xl font-bold text-gray-800">Profil Perusahaan</h1>
                    <div class="flex items-center space-x-4">
                        @if(!Auth::user()->is_verified)
                            <button class="hidden sm:inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                                <i class="fa-solid fa-certificate"></i>
                                <span>Minta Verifikasi</span>
                            </button>
                        @else
                            <span class="hidden sm:inline-flex items-center gap-2 bg-green-100 text-green-800 px-3 py-2 rounded-lg text-sm font-medium">
                                <i class="fa-solid fa-check-circle"></i>
                                <span>Terverifikasi</span>
                            </span>
                        @endif
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

            <!-- Profile Content -->
            <main class="p-6 overflow-y-auto h-full">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <span class="text-green-400 mr-2">✅</span>
                            <p class="text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Company Card -->
                    <div class="lg:col-span-1">
                        <div class="rounded-2xl p-6 hover:shadow-lg transition-all metric-card">
                            <div class="text-center mb-6">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 ring-4 ring-blue-100/40">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ Storage::url(Auth::user()->profile_photo) }}" alt="Company Logo" class="w-24 h-24 rounded-full object-cover">
                                    @else
                                        <span class="text-3xl text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                                <p class="text-gray-600 flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-location-dot text-gray-500"></i>
                                    {{ Auth::user()->city }}
                                </p>
                                @if(Auth::user()->rating > 0)
                                    <div class="flex items-center justify-center mt-2">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= Auth::user()->rating)
                                                    <i class="fa-solid fa-star"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-gray-300"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600">({{ Auth::user()->total_reviews }} ulasan)</span>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fa-solid fa-shield-check text-gray-500"></i>
                                        Status
                                    </p>
                                    <div class="flex items-center space-x-2 mt-1">
                                        @if(Auth::user()->is_verified)
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full flex items-center gap-1">
                                                <i class="fa-solid fa-check-circle"></i>
                                                Terverifikasi
                                            </span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full flex items-center gap-1">
                                                <i class="fa-solid fa-clock"></i>
                                                Belum Verifikasi
                                            </span>
                                        @endif
                                        @if(Auth::user()->is_active)
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full flex items-center gap-1">
                                                <i class="fa-solid fa-circle-check"></i>
                                                Aktif
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div>
                                    <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fa-solid fa-address-book text-gray-500"></i>
                                        Kontak
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1 flex items-center gap-2">
                                        <i class="fa-solid fa-envelope text-gray-500"></i>
                                        {{ Auth::user()->email }}
                                    </p>
                                    @if(Auth::user()->phone)
                                        <p class="text-sm text-gray-600 flex items-center gap-2">
                                            <i class="fa-solid fa-phone text-gray-500"></i>
                                            {{ Auth::user()->phone }}
                                        </p>
                                    @endif
                                </div>

                                @if(Auth::user()->address)
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                            <i class="fa-solid fa-map-marker-alt text-gray-500"></i>
                                            Alamat
                                        </p>
                                        <p class="text-sm text-gray-600 mt-1">{{ Auth::user()->address }}</p>
                                        <p class="text-sm text-gray-500">{{ Auth::user()->district }}, {{ Auth::user()->city }}</p>
                                    </div>
                                @endif

                                <div>
                                    <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                                        <i class="fa-solid fa-calendar-days text-gray-500"></i>
                                        Bergabung
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">{{ Auth::user()->created_at->format('M Y') }}</p>
                                </div>
                            </div>

                            <button onclick="openEditModal()" class="w-full mt-6 bg-orange-500 hover:bg-orange-600 text-white font-medium py-3 px-4 rounded-xl transition-all duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl">
                                <i class="fa-solid fa-pen-to-square"></i>
                                Edit Profil
                            </button>
                        </div>
                    </div>

                    <!-- Main Profile Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Company Description -->
                        <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(102,126,234,0.12);">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-building text-blue-600"></i>
                                Tentang Perusahaan
                            </h3>
                            <div class="bg-white/60 p-4 rounded-lg">
                                @if(Auth::user()->bio)
                                    <p class="text-gray-700 leading-relaxed">{{ Auth::user()->bio }}</p>
                                @else
                                    <p class="text-gray-500 italic">Belum ada deskripsi perusahaan. Tambahkan deskripsi untuk menarik pekerja terbaik.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Company Statistics -->
                        <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(249,115,22,0.12);">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-chart-bar text-orange-600"></i>
                                Statistik Perusahaan
                            </h3>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="text-center bg-white/60 p-4 rounded-xl">
                                    <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40 w-fit mx-auto mb-2">
                                        <i class="fa-solid fa-briefcase text-blue-600"></i>
                                    </div>
                                    <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->employerJobs()->count() }}</p>
                                    <p class="text-sm text-gray-600">Total Pekerjaan</p>
                                </div>
                                <div class="text-center bg-white/60 p-4 rounded-xl">
                                    <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40 w-fit mx-auto mb-2">
                                        <i class="fa-solid fa-check-circle text-emerald-600"></i>
                                    </div>
                                    <p class="text-2xl font-bold text-green-600">{{ Auth::user()->employerJobs()->where('status', 'active')->count() }}</p>
                                    <p class="text-sm text-gray-600">Pekerjaan Aktif</p>
                                </div>
                                <div class="text-center bg-white/60 p-4 rounded-xl">
                                    <div class="p-3 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 ring-4 ring-purple-100/40 w-fit mx-auto mb-2">
                                        <i class="fa-solid fa-trophy text-purple-600"></i>
                                    </div>
                                    <p class="text-2xl font-bold text-purple-600">{{ Auth::user()->employerJobs()->where('status', 'completed')->count() }}</p>
                                    <p class="text-sm text-gray-600">Proyek Selesai</p>
                                </div>
                                <div class="text-center bg-white/60 p-4 rounded-xl">
                                    <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 ring-4 ring-orange-100/40 w-fit mx-auto mb-2">
                                        <i class="fa-solid fa-star text-orange-600"></i>
                                    </div>
                                    <p class="text-2xl font-bold text-orange-600">{{ number_format(Auth::user()->rating ?? 0, 1) }}</p>
                                    <p class="text-sm text-gray-600">Rating Rata-rata</p>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Jobs -->
                        <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(102,126,234,0.12);">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                                    <i class="fa-solid fa-briefcase text-blue-600"></i>
                                    Pekerjaan Terbaru
                                </h3>
                                <a href="{{ route('employer.jobs') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                            </div>
                            <div class="space-y-4">
                                @forelse(Auth::user()->employerJobs()->latest()->take(3)->get() as $job)
                                    <div class="bg-white/60 border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <h4 class="font-medium text-gray-900">{{ $job->title }}</h4>
                                                <p class="text-sm text-gray-600 mt-1 flex items-center gap-1">
                                                    <i class="fa-solid fa-tag text-gray-500"></i>
                                                    {{ $job->category->name }}
                                                </p>
                                                <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                                    <span class="flex items-center gap-1">
                                                        <i class="fa-solid fa-file-lines"></i>
                                                        {{ $job->applications->count() }} lamaran
                                                    </span>
                                                    <span class="flex items-center gap-1">
                                                        <i class="fa-solid fa-calendar-days"></i>
                                                        {{ $job->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                            <span class="bg-{{ $job->status === 'active' ? 'green' : ($job->status === 'pending' ? 'yellow' : 'gray') }}-100 text-{{ $job->status === 'active' ? 'green' : ($job->status === 'pending' ? 'yellow' : 'gray') }}-800 text-xs px-2 py-1 rounded-full">
                                                {{ ucfirst($job->status) }}
                                            </span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8 text-gray-500 bg-white/60 rounded-lg">
                                        <i class="fa-solid fa-briefcase text-4xl text-gray-400 mb-2"></i>
                                        <p>Belum ada pekerjaan</p>
                                        <a href="{{ route('employer.jobs.create') }}" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Post pekerjaan pertama</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: rgba(249,115,22,0.12);">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fa-solid fa-cog text-orange-600"></i>
                                Pengaturan Akun
                            </h3>
                            <div class="space-y-4">
                                <div class="flex items-center justify-between p-4 bg-white/60 border border-gray-200 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 rounded-lg bg-blue-100">
                                            <i class="fa-solid fa-key text-blue-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">Ganti Password</p>
                                            <p class="text-sm text-gray-600">Update password untuk keamanan akun</p>
                                        </div>
                                    </div>
                                    <button onclick="openPasswordModal()" class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                                        <i class="fa-solid fa-edit"></i>
                                        Ganti Password
                                    </button>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-white/60 border border-gray-200 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 rounded-lg bg-green-100">
                                            <i class="fa-solid fa-bell text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">Notifikasi Email</p>
                                            <p class="text-sm text-gray-600">Terima notifikasi lamaran dan update</p>
                                        </div>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-orange-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-orange-500"></div>
                                    </label>
                                </div>
                                <div class="flex items-center justify-between p-4 bg-red-50/80 border border-red-200 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 rounded-lg bg-red-100">
                                            <i class="fa-solid fa-user-slash text-red-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-red-900">Nonaktifkan Akun</p>
                                            <p class="text-sm text-red-600">Sembunyikan profil dari pencarian pekerja</p>
                                        </div>
                                    </div>
                                    <button class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded-lg transition-colors flex items-center gap-2">
                                        <i class="fa-solid fa-ban"></i>
                                        Nonaktifkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Edit Profil Perusahaan</h2>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">×</span>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('employer.profile.update') }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Profile Photo Upload -->
                        <div class="bg-gray-50 rounded-xl p-6 border-2 border-dashed border-gray-200">
                            <div class="flex flex-col items-center space-y-4">
                                <div class="relative">
                                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center ring-4 ring-blue-100/40">
                                        @if(Auth::user()->profile_photo)
                                            <img src="{{ Storage::url(Auth::user()->profile_photo) }}" alt="Profile Photo" class="w-20 h-20 rounded-full object-cover" id="preview-image">
                                        @else
                                            <span class="text-2xl text-white font-bold" id="preview-initial">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                            <img src="" alt="Profile Photo" class="w-20 h-20 rounded-full object-cover hidden" id="preview-image">
                                        @endif
                                    </div>
                                    <label for="profile_photo" class="absolute -bottom-1 -right-1 bg-orange-500 hover:bg-orange-600 text-white p-2 rounded-full cursor-pointer transition-colors shadow-lg">
                                        <i class="fa-solid fa-camera text-xs"></i>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="hidden" onchange="previewImage(this)">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">Foto Profil Perusahaan</h4>
                                    <p class="text-xs text-gray-600">Klik icon kamera untuk upload foto</p>
                                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG (Max: 2MB)</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Perusahaan</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Perusahaan</label>
                            <textarea name="bio" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ Auth::user()->bio }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">{{ Auth::user()->address }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                                <input type="text" name="district" value="{{ Auth::user()->district }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kelurahan</label>
                                <input type="text" name="subdistrict" value="{{ Auth::user()->subdistrict }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">Batal</button>
                            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="passwordModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Ganti Password</h2>
                        <button onclick="closePasswordModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">×</span>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('employer.password.update') }}" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Lama</label>
                            <input type="password" name="current_password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                            <input type="password" name="password" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                            <button type="button" onclick="closePasswordModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">Batal</button>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">Ganti Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        function openPasswordModal() {
            document.getElementById('passwordModal').classList.remove('hidden');
        }

        function closePasswordModal() {
            document.getElementById('passwordModal').classList.add('hidden');
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const file = input.files[0];
                
                // Validate file size (2MB = 2048KB)
                if (file.size > 2048 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    input.value = '';
                    return;
                }
                
                // Validate file type
                if (!file.type.match('image.*')) {
                    alert('File harus berupa gambar (JPG, PNG, GIF).');
                    input.value = '';
                    return;
                }
                
                const reader = new FileReader();
                const previewImage = document.getElementById('preview-image');
                const previewInitial = document.getElementById('preview-initial');
                
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    if (previewInitial) {
                        previewInitial.classList.add('hidden');
                    }
                }
                
                reader.readAsDataURL(file);
            }
        }

        // Close modals when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        document.getElementById('passwordModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePasswordModal();
            }
        });
    </script>
</body>
</html>
