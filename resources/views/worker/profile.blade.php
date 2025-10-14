<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pekerja - Job Rescue</title>
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
                <a href="{{ route('worker.applications') }}" class="flex items-center space-x-2 text-gray-300 hover:bg-gray-700 hover:text-white p-3 rounded-lg transition-colors">
                    <span>📝</span>
                    <span>Lamaran Saya</span>
                </a>
                <a href="{{ route('worker.profile') }}" class="flex items-center space-x-2 bg-gray-700 text-white p-3 rounded-lg">
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
                    <h1 class="text-2xl font-bold text-gray-800">Profil & Portofolio</h1>
                    <div class="flex items-center space-x-4">
                        @if(!Auth::user()->is_verified)
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                🔍 Minta Verifikasi Admin
                            </button>
                        @else
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                ✅ Terverifikasi
                            </span>
                        @endif
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
                    <!-- Profile Card -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <div class="text-center mb-6">
                                <div class="w-24 h-24 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                    @if(Auth::user()->profile_photo)
                                        <img src="{{ Auth::user()->profile_photo }}" alt="Profile" class="w-24 h-24 rounded-full object-cover">
                                    @else
                                        <span class="text-3xl text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h3>
                                <p class="text-gray-600">{{ Auth::user()->city }}</p>
                                @if(Auth::user()->rating > 0)
                                    <div class="flex items-center justify-center mt-2">
                                        <div class="flex text-yellow-400">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= Auth::user()->rating)
                                                    <span>⭐</span>
                                                @else
                                                    <span class="text-gray-300">⭐</span>
                                                @endif
                                            @endfor
                                        </div>
                                        <span class="ml-2 text-sm text-gray-600">({{ Auth::user()->total_reviews }} ulasan)</span>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Status</p>
                                    <div class="flex items-center space-x-2 mt-1">
                                        @if(Auth::user()->is_verified)
                                            <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Terverifikasi</span>
                                        @else
                                            <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Belum Verifikasi</span>
                                        @endif
                                        @if(Auth::user()->is_active)
                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Aktif</span>
                                        @endif
                                    </div>
                                </div>

                                @if(Auth::user()->skills)
                                    <div>
                                        <p class="text-sm font-medium text-gray-700 mb-2">Keahlian</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach(Auth::user()->skills as $skill)
                                                <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $skill }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div>
                                    <p class="text-sm font-medium text-gray-700">Kontak</p>
                                    <p class="text-sm text-gray-600 mt-1">📧 {{ Auth::user()->email }}</p>
                                    @if(Auth::user()->phone)
                                        <p class="text-sm text-gray-600">📱 {{ Auth::user()->phone }}</p>
                                    @endif
                                </div>

                                @if(Auth::user()->address)
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">Alamat</p>
                                        <p class="text-sm text-gray-600 mt-1">📍 {{ Auth::user()->address }}</p>
                                        <p class="text-sm text-gray-500">{{ Auth::user()->district }}, {{ Auth::user()->city }}</p>
                                    </div>
                                @endif
                            </div>

                            <button onclick="openEditModal()" class="w-full mt-6 bg-orange-500 hover:bg-orange-600 text-white font-medium py-2 px-4 rounded-lg transition-colors">
                                ✏️ Edit Profil
                            </button>
                        </div>
                    </div>

                    <!-- Main Profile Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Bio Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tentang Saya</h3>
                            @if(Auth::user()->bio)
                                <p class="text-gray-700 leading-relaxed">{{ Auth::user()->bio }}</p>
                            @else
                                <p class="text-gray-500 italic">Belum ada deskripsi. Tambahkan deskripsi tentang diri Anda untuk menarik pemberi kerja.</p>
                            @endif
                        </div>

                        <!-- Experience Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Pengalaman Kerja</h3>
                                <button class="text-orange-500 hover:text-orange-600 text-sm font-medium">+ Tambah Pengalaman</button>
                            </div>
                            <div class="space-y-4">
                                <!-- Sample Experience -->
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h4 class="font-medium text-gray-900">Desainer Grafis Freelance</h4>
                                    <p class="text-sm text-gray-600">2022 - Sekarang</p>
                                    <p class="text-sm text-gray-700 mt-1">Membuat desain logo, brosur, dan materi promosi untuk berbagai UMKM di Bogor.</p>
                                </div>
                                <div class="text-center py-8 text-gray-500">
                                    <span class="text-4xl mb-2 block">💼</span>
                                    <p>Belum ada pengalaman kerja</p>
                                    <p class="text-sm">Tambahkan pengalaman kerja untuk meningkatkan kredibilitas</p>
                                </div>
                            </div>
                        </div>

                        <!-- Portfolio Section -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-semibold text-gray-900">Portofolio</h3>
                                <button class="text-orange-500 hover:text-orange-600 text-sm font-medium">+ Upload Karya</button>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                <!-- Sample Portfolio Items -->
                                <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-4xl">🖼️</span>
                                </div>
                                <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400 text-4xl">🎨</span>
                                </div>
                                <div class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300 hover:border-orange-500 transition-colors cursor-pointer">
                                    <div class="text-center">
                                        <span class="text-gray-400 text-2xl block">➕</span>
                                        <span class="text-xs text-gray-500">Upload</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik</h3>
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-blue-600">{{ Auth::user()->jobApplications()->accepted()->count() }}</p>
                                    <p class="text-sm text-gray-600">Proyek Selesai</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-green-600">{{ Auth::user()->total_reviews }}</p>
                                    <p class="text-sm text-gray-600">Total Ulasan</p>
                                </div>
                                <div class="text-center">
                                    <p class="text-2xl font-bold text-orange-600">{{ Auth::user()->rating ?? 0 }}</p>
                                    <p class="text-sm text-gray-600">Rating Rata-rata</p>
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
                        <h2 class="text-xl font-bold text-gray-900">Edit Profil</h2>
                        <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                            <span class="text-2xl">×</span>
                        </button>
                    </div>

                    <form method="POST" action="{{ route('worker.profile.update') }}" class="space-y-4">
                        @csrf
                        @method('PATCH')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">No. Telepon</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bio / Deskripsi</label>
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

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Keahlian (pisahkan dengan koma)</label>
                            <input type="text" name="skills" value="{{ is_array(Auth::user()->skills) ? implode(', ', Auth::user()->skills) : '' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500" placeholder="Desain Grafis, Adobe Photoshop, Illustrator">
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

    <script>
        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });
    </script>
</body>
</html>
