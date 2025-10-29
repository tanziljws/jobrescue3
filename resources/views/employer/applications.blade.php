@php
use Illuminate\Support\Facades\Storage;
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lamaran Masuk - Job Rescue</title>
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
                    <h1 class="text-2xl font-bold text-gray-800">Lamaran Masuk</h1>
                    <div class="flex items-center space-x-4">
                        <select class="border border-green-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-green-500 bg-green-50 text-green-700">
                            <option value="">Semua Pekerjaan</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}" {{ $jobId == $job->id ? 'selected' : '' }}>
                                    {{ Str::limit($job->title, 40) }}
                                </option>
                            @endforeach
                        </select>
                        <select class="border border-purple-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-500 bg-purple-50 text-purple-700">
                            <option>Semua Status</option>
                            <option>Diterima</option>
                            <option>Ditolak</option>
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

            <!-- Applications Content -->
            <main class="p-6 overflow-y-auto h-full">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Total Lamaran</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $applications->total() }}</p>
                                <p class="text-sm text-blue-600">Semua pelamar</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-file-lines text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Dalam Proses</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $applications->where('status', 'pending')->count() }}</p>
                                <p class="text-sm text-blue-600">Sedang diproses</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-100 ring-4 ring-blue-100/40">
                                <i class="fa-solid fa-hourglass-half text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Diterima</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $applications->where('status', 'accepted')->count() }}</p>
                                <p class="text-sm text-green-600">Sudah disetujui</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-100 ring-4 ring-emerald-100/40">
                                <i class="fa-solid fa-check-circle text-emerald-600"></i>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-2xl p-6 hover:shadow-lg hover:-translate-y-0.5 transition-all metric-card">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Ditolak</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $applications->where('status', 'rejected')->count() }}</p>
                                <p class="text-sm text-red-600">Tidak sesuai</p>
                            </div>
                            <div class="p-3 rounded-2xl bg-gradient-to-br from-red-50 to-red-100 ring-4 ring-red-100/40">
                                <i class="fa-solid fa-times-circle text-red-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Applications List -->
                <div class="rounded-xl shadow-sm border border-gray-100" style="background: rgba(102,126,234,0.12);">
                    <div class="p-6 border-b border-gray-200/50">
                        <h2 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                            <i class="fa-solid fa-list text-blue-600"></i>
                            Daftar Lamaran
                        </h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @forelse($applications as $application)
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-start space-x-4 flex-1">
                                        <!-- Worker Avatar -->
                                        <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center flex-shrink-0">
                                            @if($application->worker->profile_photo)
                                                <img src="{{ Storage::url($application->worker->profile_photo) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover">
                                            @else
                                                <span class="text-white font-semibold">{{ substr($application->worker->name, 0, 1) }}</span>
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <!-- Worker Info -->
                                            <div class="flex items-center space-x-3 mb-2">
                                                <h3 class="text-lg font-medium text-gray-900">{{ $application->worker->name }}</h3>
                                                <span class="bg-{{ $application->status === 'pending' ? 'blue' : ($application->status === 'accepted' ? 'green' : 'red') }}-100 text-{{ $application->status === 'pending' ? 'blue' : ($application->status === 'accepted' ? 'green' : 'red') }}-800 text-xs px-2 py-1 rounded-full font-medium">
                                                    @if($application->status === 'pending')
                                                        🔄 Dalam Proses
                                                    @elseif($application->status === 'accepted')
                                                        ✅ Diterima
                                                    @elseif($application->status === 'rejected')
                                                        ❌ Ditolak
                                                    @endif
                                                </span>
                                                @if($application->worker->is_verified)
                                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">✅ Terverifikasi</span>
                                                @endif
                                            </div>

                                            <!-- Job Title -->
                                            <p class="text-sm text-gray-600 mb-2">
                                                <span class="font-medium">Melamar:</span> {{ $application->job->title }}
                                            </p>

                                            <!-- Worker Details -->
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                                <div class="space-y-1">
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Lokasi:</span> {{ $application->worker->city }}
                                                    </p>
                                                    @if($application->worker->phone)
                                                        <p class="text-sm text-gray-600">
                                                            <span class="font-medium">Telepon:</span> {{ $application->worker->phone }}
                                                        </p>
                                                    @endif
                                                    @if($application->worker->rating > 0)
                                                        <div class="flex items-center text-sm">
                                                            <span class="font-medium text-gray-600 mr-2">Rating:</span>
                                                            <div class="flex text-yellow-400">
                                                                @for($i = 1; $i <= 5; $i++)
                                                                    @if($i <= $application->worker->rating)
                                                                        <span class="text-xs">⭐</span>
                                                                    @else
                                                                        <span class="text-xs text-gray-300">⭐</span>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <span class="ml-1 text-xs text-gray-500">({{ $application->worker->total_reviews }})</span>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="space-y-1">
                                                    <p class="text-sm text-gray-600">
                                                        <span class="font-medium">Tanggal Lamar:</span> {{ $application->applied_at->format('d M Y H:i') }}
                                                    </p>
                                                    @if($application->proposed_budget)
                                                        <p class="text-sm text-gray-600">
                                                            <span class="font-medium">Budget Diajukan:</span> 
                                                            <span class="font-semibold text-green-600">Rp {{ number_format($application->proposed_budget) }}</span>
                                                        </p>
                                                    @endif
                                                    @if($application->estimated_days)
                                                        <p class="text-sm text-gray-600">
                                                            <span class="font-medium">Estimasi:</span> {{ $application->estimated_days }} hari
                                                        </p>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Skills -->
                                            @if($application->worker->skills)
                                                <div class="mb-3">
                                                    <p class="text-sm font-medium text-gray-700 mb-1">Keahlian:</p>
                                                    <div class="flex flex-wrap gap-1">
                                                        @foreach(array_slice($application->worker->skills, 0, 5) as $skill)
                                                            <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">{{ $skill }}</span>
                                                        @endforeach
                                                        @if(count($application->worker->skills) > 5)
                                                            <span class="text-xs text-gray-500 px-2 py-1">+{{ count($application->worker->skills) - 5 }} lainnya</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Cover Letter -->
                                            <div class="mb-3">
                                                <p class="text-sm font-medium text-gray-700 mb-1">Cover Letter:</p>
                                                <div class="bg-gray-50 rounded-lg p-3">
                                                    <p class="text-sm text-gray-700 line-clamp-3">{{ $application->cover_letter }}</p>
                                                    <button onclick="toggleCoverLetter({{ $application->id }})" class="text-xs text-orange-500 hover:text-orange-600 mt-1">
                                                        Baca selengkapnya
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- Portfolio Links -->
                                            @if($application->portfolio_links)
                                                <div class="mb-3">
                                                    <p class="text-sm font-medium text-gray-700 mb-1">Portfolio:</p>
                                                    <div class="flex flex-wrap gap-2">
                                                        @foreach($application->portfolio_links as $link)
                                                            <a href="{{ $link }}" target="_blank" class="text-xs bg-purple-100 text-purple-800 px-2 py-1 rounded-full hover:bg-purple-200 transition-colors">
                                                                🔗 Portfolio {{ $loop->iteration }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            <!-- Employer Notes -->
                                            @if($application->employer_notes)
                                                <div class="bg-blue-50 rounded-lg p-3">
                                                    <p class="text-sm font-medium text-blue-700 mb-1">Catatan Anda:</p>
                                                    <p class="text-sm text-blue-600">{{ $application->employer_notes }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex flex-col space-y-2 ml-4">
                                        <button onclick="viewWorkerProfile({{ $application->worker->id }})" class="bg-blue-500 hover:bg-blue-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                            👤 Lihat Profil
                                        </button>
                                        
                                        @if($application->status === 'pending')
                                            <button onclick="acceptApplication({{ $application->id }})" class="bg-green-500 hover:bg-green-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                ✅ Terima
                                            </button>
                                            <button onclick="rejectApplication({{ $application->id }})" class="bg-red-500 hover:bg-red-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                ❌ Tolak
                                            </button>
                                        @endif

                                        @if($application->status === 'accepted')
                                            <button class="bg-purple-500 hover:bg-purple-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                💬 Chat
                                            </button>
                                            <button onclick="markCompleted({{ $application->id }})" class="bg-orange-500 hover:bg-orange-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                                🏁 Selesai
                                            </button>
                                        @endif

                                        <button onclick="addNotes({{ $application->id }})" class="bg-gray-500 hover:bg-gray-600 text-white text-xs px-3 py-2 rounded-lg transition-colors">
                                            📝 Catatan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="p-12 text-center bg-white/60 rounded-lg mx-6 mb-6">
                                <i class="fa-solid fa-file-lines text-6xl text-gray-400 mb-4"></i>
                                <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Lamaran</h3>
                                <p class="text-gray-600 mb-6">Lamaran akan muncul setelah pekerja melamar pekerjaan Anda.</p>
                                <a href="{{ route('employer.jobs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors inline-flex items-center gap-2">
                                    <i class="fa-solid fa-plus"></i>
                                    Post Pekerjaan Baru
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

    <!-- Modals -->
    <!-- Accept Application Modal -->
    <div id="acceptModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Terima Lamaran</h3>
                    <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menerima lamaran ini?</p>
                    <textarea id="acceptNotes" placeholder="Tambahkan catatan untuk pekerja (opsional)" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 mb-4" rows="3"></textarea>
                    <div class="flex space-x-4">
                        <button onclick="closeAcceptModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors">Batal</button>
                        <button onclick="confirmAccept()" class="flex-1 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition-colors">Terima</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Application Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tolak Lamaran</h3>
                    <p class="text-gray-600 mb-4">Berikan alasan penolakan untuk membantu pekerja:</p>
                    <textarea id="rejectNotes" placeholder="Alasan penolakan..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 mb-4" rows="3" required></textarea>
                    <div class="flex space-x-4">
                        <button onclick="closeRejectModal()" class="flex-1 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg transition-colors">Batal</button>
                        <button onclick="confirmReject()" class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-lg transition-colors">Tolak</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentApplicationId = null;

        function acceptApplication(applicationId) {
            currentApplicationId = applicationId;
            document.getElementById('acceptModal').classList.remove('hidden');
        }

        function rejectApplication(applicationId) {
            currentApplicationId = applicationId;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeAcceptModal() {
            document.getElementById('acceptModal').classList.add('hidden');
            document.getElementById('acceptNotes').value = '';
            currentApplicationId = null;
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('rejectNotes').value = '';
            currentApplicationId = null;
        }

        function confirmAccept() {
            const notes = document.getElementById('acceptNotes').value;
            updateApplicationStatus(currentApplicationId, 'accepted', notes);
            closeAcceptModal();
        }

        function confirmReject() {
            const notes = document.getElementById('rejectNotes').value;
            if (!notes.trim()) {
                alert('Harap berikan alasan penolakan.');
                return;
            }
            updateApplicationStatus(currentApplicationId, 'rejected', notes);
            closeRejectModal();
        }

        function updateApplicationStatus(applicationId, status, notes) {
            fetch(`/applications/${applicationId}/status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    status: status,
                    employer_notes: notes
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal memperbarui status lamaran. Silakan coba lagi.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            });
        }

        function viewWorkerProfile(workerId) {
            // Open worker profile in new tab
            window.open(`/workers/${workerId}/profile`, '_blank');
        }

        function toggleCoverLetter(applicationId) {
            // Toggle full cover letter display
            const element = event.target.previousElementSibling;
            element.classList.toggle('line-clamp-3');
            event.target.textContent = element.classList.contains('line-clamp-3') ? 'Baca selengkapnya' : 'Sembunyikan';
        }

        function addNotes(applicationId) {
            const notes = prompt('Tambahkan catatan untuk lamaran ini:');
            if (notes) {
                updateApplicationStatus(applicationId, null, notes);
            }
        }

        function markCompleted(applicationId) {
            if (confirm('Apakah proyek ini sudah selesai? Anda akan diminta untuk memberikan rating.')) {
                // Redirect to rating page
                window.location.href = `/applications/${applicationId}/complete`;
            }
        }
    </script>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</body>
</html>
