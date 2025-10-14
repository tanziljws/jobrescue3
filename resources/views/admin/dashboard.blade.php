<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Job Rescue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        .admin-sidebar .sidebar-icon { color: #fff; transition: color .2s ease; }
        .admin-nav a:hover .sidebar-icon, .admin-nav a.active .sidebar-icon { color: #f97316; }
        .admin-nav a.active { background: rgba(249, 115, 22, 0.18) !important; color: #fff; }
        .admin-nav a.active span { color: #fff; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="bg-[#667eea] text-white w-64 min-h-screen p-4 admin-sidebar" style="background-color:#667eea;">
            <div class="flex items-center mb-8">
                <img src="{{ asset('img/icon.svg') }}" alt="JobRescue" class="w-6 h-6 mr-2" style="width:24px;height:24px;">
                <span class="text-xl font-bold">JobRescue Admin</span>
            </div>
            
            <nav class="space-y-2 admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 text-white p-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'active' : 'hover:bg-white/10' }}">
                    <i class="fa-solid fa-chart-line sidebar-icon"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center space-x-2 text-white/90 hover:bg-white/10 hover:text-white p-3 rounded-lg transition-colors {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="fa-solid fa-users sidebar-icon"></i>
                    <span>Manajemen Pengguna</span>
                </a>
                <a href="{{ route('admin.jobs') }}" class="flex items-center space-x-2 text-white/90 hover:bg-white/10 hover:text-white p-3 rounded-lg transition-colors {{ request()->routeIs('admin.jobs') ? 'active' : '' }}">
                    <i class="fa-solid fa-briefcase sidebar-icon"></i>
                    <span>Manajemen Lowongan</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center space-x-2 text-white/90 hover:bg-white/10 hover:text-white p-3 rounded-lg transition-colors {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <i class="fa-solid fa-folder sidebar-icon"></i>
                    <span>Kategori Pekerjaan</span>
                </a>
                <a href="{{ route('admin.reports') }}" class="flex items-center space-x-2 text-white/90 hover:bg-white/10 hover:text-white p-3 rounded-lg transition-colors {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                    <i class="fa-solid fa-triangle-exclamation sidebar-icon"></i>
                    <span>Manajemen Laporan</span>
                </a>
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-2 text-white/90 hover:bg-white/10 hover:text-white p-3 rounded-lg transition-colors {{ request()->routeIs('admin.profile') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear sidebar-icon"></i>
                    <span>Profil Admin</span>
                </a>
            </nav>
            
            <div class="absolute bottom-4 left-4 right-4">
                <a href="#" class="flex items-center space-x-2 text-white/90 hover:text-white p-3 rounded-lg transition-colors">
                    <i class="fa-solid fa-right-from-bracket sidebar-icon"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-visible">
            <!-- Header -->
            <header class="bg-white shadow-sm border-b border-gray-200 p-4 relative z-40">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
                    <div class="flex items-center space-x-4">
                        <div class="relative" id="notifArea">
                            <button id="notifBtn" class="bg-orange-500 text-white p-2 rounded-full hover:bg-orange-600 transition-colors">
                                <i class="fa-solid fa-bell"></i>
                            </button>
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                            <!-- Dropdown -->
                            <div id="notifMenu" class="hidden absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-xl shadow-xl overflow-hidden z-50">
                                <div class="px-4 py-3 border-b border-gray-100 font-semibold text-gray-700">Notifikasi</div>
                                <div class="max-h-80 overflow-y-auto">
                                    <a href="{{ route('admin.reports') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50">
                                        <i class="fa-solid fa-triangle-exclamation text-orange-500 mt-0.5"></i>
                                        <div class="text-sm">
                                            <p class="text-gray-800">Ada 2 laporan baru menunggu ditinjau</p>
                                            <p class="text-gray-500 text-xs">Klik untuk buka Manajemen Laporan</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.jobs') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50">
                                        <i class="fa-solid fa-briefcase text-blue-500 mt-0.5"></i>
                                        <div class="text-sm">
                                            <p class="text-gray-800">3 lowongan baru menunggu approval</p>
                                            <p class="text-gray-500 text-xs">Buka Manajemen Lowongan</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('admin.users') }}" class="flex items-start gap-3 px-4 py-3 hover:bg-gray-50">
                                        <i class="fa-solid fa-user-plus text-green-600 mt-0.5"></i>
                                        <div class="text-sm">
                                            <p class="text-gray-800">1 pengguna baru mendaftar</p>
                                            <p class="text-gray-500 text-xs">Lihat detail pengguna</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="px-4 py-2 border-t border-gray-100 text-right">
                                    <a href="{{ route('admin.dashboard') }}" class="text-sm text-orange-600 hover:text-orange-700 font-medium">Tandai semua terbaca</a>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.profile') }}" class="flex items-center space-x-2 hover:opacity-90">
                            <img src="{{ auth()->user()->profile_photo ? Storage::url(auth()->user()->profile_photo) : 'https://via.placeholder.com/32' }}" alt="Admin" class="w-8 h-8 rounded-full object-cover">
                            <span class="text-gray-700 font-medium">{{ auth()->user()->name }}</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                                <p class="text-3xl font-bold text-gray-900">1,234</p>
                                <p class="text-sm text-green-600">+12% dari bulan lalu</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-users text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Lowongan Aktif</p>
                                <p class="text-3xl font-bold text-gray-900">567</p>
                                <p class="text-sm text-green-600">+8% dari bulan lalu</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-orange-50 to-orange-100 ring-4 ring-orange-100/40">
                                <i class="fa-solid fa-briefcase text-orange-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Transaksi Bulan Ini</p>
                                <p class="text-3xl font-bold text-gray-900">89</p>
                                <p class="text-sm text-green-600">+15% dari bulan lalu</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40">
                                <i class="fa-solid fa-money-bill-trend-up text-emerald-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Laporan Pending</p>
                                <p class="text-3xl font-bold text-gray-900">12</p>
                                <p class="text-sm text-red-600">Perlu perhatian</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-rose-50 to-red-100 ring-4 ring-rose-100/40">
                                <i class="fa-solid fa-triangle-exclamation text-red-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Tables Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                    <!-- User Growth Chart -->
                    <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: linear-gradient(180deg, rgba(102,126,234,0.08), rgba(102,126,234,0.12));">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Pertumbuhan Pengguna</h3>
                        <div class="h-64 bg-gradient-to-br from-blue-50 to-indigo-100 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <span class="text-4xl mb-2 block">📈</span>
                                <p class="text-gray-600">Chart akan ditampilkan di sini</p>
                                <p class="text-sm text-gray-500">Integrasi dengan Chart.js</p>
                            </div>
                        </div>
                    </div>

                    <!-- Job Categories Distribution -->
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Distribusi Kategori Pekerjaan</h3>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 bg-blue-500 rounded-full"></span>
                                    <span class="text-sm text-gray-600">Desain Grafis</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">35%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 bg-orange-500 rounded-full"></span>
                                    <span class="text-sm text-gray-600">Catering</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">28%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 bg-green-500 rounded-full"></span>
                                    <span class="text-sm text-gray-600">Teknisi</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">22%</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-2">
                                    <span class="w-3 h-3 bg-purple-500 rounded-full"></span>
                                    <span class="text-sm text-gray-600">Kebersihan</span>
                                </div>
                                <span class="text-sm font-medium text-gray-800">15%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Recent Users -->
                    <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: linear-gradient(180deg, rgba(102,126,234,0.08), rgba(102,126,234,0.12));">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Pengguna Terbaru</h3>
                            <a href="#" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Ahmad Rizki</p>
                                    <p class="text-xs text-gray-500">Pekerja • Bergabung 2 jam lalu</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Aktif</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Sari Dewi</p>
                                    <p class="text-xs text-gray-500">Pemberi Kerja • Bergabung 5 jam lalu</p>
                                </div>
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Pending</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800">Budi Santoso</p>
                                    <p class="text-xs text-gray-500">Pekerja • Bergabung 1 hari lalu</p>
                                </div>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Aktif</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Jobs -->
                    <div class="rounded-xl shadow-sm p-6 border border-gray-100" style="background: linear-gradient(180deg, rgba(102,126,234,0.08), rgba(102,126,234,0.12));">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Lowongan Terbaru</h3>
                            <a href="#" class="text-orange-500 hover:text-orange-600 text-sm font-medium">Lihat Semua</a>
                        </div>
                        <div class="space-y-4">
                            <div class="border-l-4 border-blue-500 pl-4">
                                <p class="text-sm font-medium text-gray-800">Desain Logo untuk UMKM</p>
                                <p class="text-xs text-gray-500">Rp 500.000 • Diposting 1 jam lalu</p>
                                <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full mt-1 inline-block">Pending Review</span>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4">
                                <p class="text-sm font-medium text-gray-800">Catering untuk Event Kantor</p>
                                <p class="text-xs text-gray-500">Rp 2.000.000 • Diposting 3 jam lalu</p>
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full mt-1 inline-block">Approved</span>
                            </div>
                            <div class="border-l-4 border-orange-500 pl-4">
                                <p class="text-sm font-medium text-gray-800">Perbaikan AC Rumah</p>
                                <p class="text-xs text-gray-500">Rp 300.000 • Diposting 5 jam lalu</p>
                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mt-1 inline-block">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const btn = document.getElementById('notifBtn');
            const menu = document.getElementById('notifMenu');
            const area = document.getElementById('notifArea');
            if(btn && menu && area){
                btn.addEventListener('click', ()=>{
                    menu.classList.toggle('hidden');
                });
                document.addEventListener('click', (e)=>{
                    if(!area.contains(e.target)) menu.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
