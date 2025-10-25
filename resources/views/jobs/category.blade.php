<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - JobRescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'Poppins',sans-serif;background:#f8fafc;padding-top:80px}
        .header{position:fixed;inset:0 0 auto 0;background:rgba(255,255,255,.98);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.08);box-shadow:0 4px 20px rgba(0,0,0,.08);z-index:1000}
        .nav{display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;max-width:1400px;margin:0 auto}
        .nav-brand{display:flex;align-items:center;gap:.5rem}
        .logo{width:50px;height:50px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:15px;display:flex;align-items:center;justify-content:center;box-shadow:0 10px 30px rgba(249,115,22,.4)}
        .logo img{width:36px;height:36px;filter:brightness(0) invert(1)}
        .brand-text{font-size:1.8rem;font-weight:800;color:#1f2937}
        .nav-menu{display:flex;list-style:none;gap:.25rem;align-items:center;background:rgba(249,115,22,.05);padding:.4rem;border-radius:50px;border:1px solid rgba(249,115,22,.1)}
        .nav-link{color:#4b5563;text-decoration:none;font-weight:500;padding:.65rem 1.25rem;border-radius:25px;transition:all .3s;font-size:.9rem}
        .nav-link:hover{color:#f97316}
        .nav-link.active{color:#fff;background:linear-gradient(135deg,#f97316,#ea580c);font-weight:600}
        .btn-register{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.8rem 2rem;border-radius:25px;font-weight:600;box-shadow:0 8px 25px rgba(249,115,22,.3);transition:all .3s}
        .btn-register:hover{transform:translateY(-2px);box-shadow:0 12px 35px rgba(249,115,22,.4)}
        .user-menu{position:relative}
        .user-avatar{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;cursor:pointer;box-shadow:0 4px 12px rgba(249,115,22,.3)}
        .user-dropdown{position:absolute;top:calc(100% + 10px);right:0;background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.12);min-width:180px;opacity:0;visibility:hidden;transform:translateY(-10px);transition:all .3s;z-index:100;border:1px solid rgba(0,0,0,.06)}
        .user-menu:hover .user-dropdown{opacity:1;visibility:visible;transform:translateY(0)}
        .user-dropdown a,.user-dropdown button{display:block;width:100%;padding:.75rem 1.25rem;text-decoration:none;color:#374151;font-weight:500;transition:all .2s;border:none;background:none;text-align:left;cursor:pointer;font-family:'Poppins',sans-serif;font-size:.9rem}
        .user-dropdown a:hover,.user-dropdown button:hover{background:#f8fafc;color:#f97316}
        .user-dropdown button{border-top:1px solid rgba(0,0,0,.06);border-radius:0 0 12px 12px}
        
        .container{max-width:1400px;margin:0 auto;padding:0 2rem}
        .hero-cat{background:linear-gradient(135deg,#f97316,#ea580c);padding:3rem 0;position:relative;overflow:hidden}
        .hero-cat::before{content:'';position:absolute;inset:0;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');opacity:.5}
        .hero-cat .container{position:relative;z-index:1;display:flex;align-items:center;gap:2rem}
        .cat-icon-big{width:80px;height:80px;background:rgba(255,255,255,.2);border-radius:20px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:2.5rem;backdrop-filter:blur(10px);border:2px solid rgba(255,255,255,.3)}
        .cat-info h1{font-size:2.5rem;font-weight:900;color:#fff;margin-bottom:.5rem}
        .cat-info p{color:rgba(255,255,255,.9);font-size:1.1rem}
        .cat-stats{display:flex;gap:2rem;margin-top:1rem}
        .cat-stat{display:flex;align-items:center;gap:.5rem;color:rgba(255,255,255,.95);font-weight:600}
        .cat-stat i{color:rgba(255,255,255,.7)}
        
        .content{padding:3rem 0}
        .filters-bar{background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 4px 12px rgba(0,0,0,.06);margin-bottom:2rem;display:flex;gap:1rem;flex-wrap:wrap;align-items:center}
        .filter-item{flex:1;min-width:200px}
        .filter-label{font-size:.75rem;font-weight:600;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.5rem}
        .filter-select,.filter-input{width:100%;padding:.75rem 1rem;border:1px solid #e5e7eb;border-radius:12px;font-size:.9rem;outline:none;transition:all .2s}
        .filter-select:focus,.filter-input:focus{border-color:#f97316;box-shadow:0 0 0 3px rgba(249,115,22,.1)}
        .btn-filter{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.75rem 1.5rem;border-radius:12px;font-weight:600;cursor:pointer;box-shadow:0 4px 12px rgba(249,115,22,.25);transition:all .3s}
        .btn-filter:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(249,115,22,.35)}
        
        .results-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}
        .results-title{font-size:1.5rem;font-weight:800;color:#1f2937}
        .results-count{color:#6b7280;font-size:.95rem}
        
        .jobs-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(380px,1fr));gap:1.5rem}
        .job-card{background:#fff;border:1px solid #eef2f7;border-radius:16px;padding:1.5rem;box-shadow:0 4px 12px rgba(0,0,0,.05);transition:all .3s;position:relative;overflow:hidden}
        .job-card::before{content:'';position:absolute;top:0;left:0;right:0;height:4px;background:linear-gradient(90deg,#f97316,#ea580c);opacity:0;transition:opacity .3s}
        .job-card:hover{transform:translateY(-4px);box-shadow:0 12px 24px rgba(0,0,0,.1);border-color:rgba(249,115,22,.3)}
        .job-card:hover::before{opacity:1}
        .job-header{display:flex;gap:1rem;margin-bottom:1rem}
        .job-logo{width:56px;height:56px;background:linear-gradient(135deg,rgba(249,115,22,.1),rgba(234,88,12,.1));border-radius:14px;display:flex;align-items:center;justify-content:center;color:#f97316;font-weight:800;font-size:1.2rem;flex-shrink:0}
        .job-meta{flex:1}
        .job-company{font-size:.85rem;color:#6b7280;font-weight:600;margin-bottom:.25rem}
        .job-title{font-size:1.1rem;font-weight:800;color:#1f2937;margin-bottom:.5rem;line-height:1.3}
        .job-badges{display:flex;gap:.5rem;flex-wrap:wrap}
        .badge{padding:.375rem .75rem;border-radius:9999px;font-size:.75rem;font-weight:700;border:1px solid transparent}
        .badge-type{background:#e0e7ff;color:#3730a3}
        .badge-urgent{background:#fee2e2;color:#991b1b}
        .job-details{display:flex;gap:1.5rem;margin:1rem 0;padding:1rem 0;border-top:1px solid #f1f5f9;border-bottom:1px solid #f1f5f9;flex-wrap:wrap}
        .detail-item{display:flex;align-items:center;gap:.5rem;color:#6b7280;font-size:.85rem}
        .detail-item i{color:#f97316}
        .job-budget{font-size:1.25rem;font-weight:800;color:#1f2937;margin:.75rem 0}
        .job-budget-label{font-size:.75rem;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:.5px}
        .job-desc{color:#6b7280;font-size:.9rem;line-height:1.6;margin:.75rem 0}
        .job-footer{display:flex;justify-content:space-between;align-items:center;margin-top:1rem}
        .job-time{color:#9ca3af;font-size:.8rem}
        .btn-apply{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.625rem 1.25rem;border-radius:12px;font-weight:600;font-size:.9rem;cursor:pointer;transition:all .3s;text-decoration:none;display:inline-block}
        .btn-apply:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(249,115,22,.3)}
        
        .empty-state{text-align:center;padding:4rem 2rem}
        .empty-icon{font-size:4rem;color:#e5e7eb;margin-bottom:1rem}
        .empty-title{font-size:1.5rem;font-weight:800;color:#1f2937;margin-bottom:.5rem}
        .empty-text{color:#6b7280}
        
        @media (max-width:768px){
            .jobs-grid{grid-template-columns:1fr}
            .filters-bar{flex-direction:column}
            .filter-item{min-width:100%}
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="nav-brand">
                <div class="logo">
                    <img src="{{ asset('img/icon.svg') }}" alt="Logo JobRescue">
                </div>
                <span class="brand-text">JobRescue</span>
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                <li><a href="{{ route('jobs.index') }}" class="nav-link active">Cari Kerja</a></li>
                <li><a href="{{ route('talents.index') }}" class="nav-link">Cari Talent</a></li>
                <li><a href="{{ route('about') }}" class="nav-link">Tentang</a></li>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Admin</a></li>
                    @endif
                @endauth
                @guest
                    <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @endguest
            </ul>
            @guest
                <a href="{{ route('register') }}" class="btn-register">Daftar</a>
            @else
                <div class="user-menu">
                    <div class="user-avatar">
                        <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="user-dropdown">
                        @if(Auth::user()->role === 'worker')
                            <a href="{{ route('worker.dashboard') }}">Dashboard</a>
                        @elseif(Auth::user()->role === 'employer')
                            <a href="{{ route('employer.dashboard') }}">Dashboard</a>
                            <a href="{{ route('employer.jobs.create') }}">Buat Lowongan</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
        </nav>
    </header>

    <!-- Hero Category -->
    <section class="hero-cat">
        <div class="container">
            <div class="cat-icon-big">
                <i class="{{ $category->icon ?? 'fas fa-briefcase' }}"></i>
            </div>
            <div class="cat-info">
                <h1>{{ $category->name }}</h1>
                <p>Temukan peluang kerja terbaik di bidang {{ strtolower($category->name) }}</p>
                <div class="cat-stats">
                    <div class="cat-stat">
                        <i class="fas fa-briefcase"></i>
                        <span>{{ $jobs->total() }} Lowongan</span>
                    </div>
                    <div class="cat-stat">
                        <i class="fas fa-building"></i>
                        <span>{{ $jobs->pluck('employer_id')->unique()->count() }} Perusahaan</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="content">
        <div class="container">
            <!-- Filters -->
            <div class="filters-bar">
                <div class="filter-item">
                    <div class="filter-label">Tipe Pekerjaan</div>
                    <select class="filter-select" id="jobTypeFilter">
                        <option value="">Semua Tipe</option>
                        <option value="full_time">Full Time</option>
                        <option value="part_time">Part Time</option>
                        <option value="freelance">Freelance</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
                <div class="filter-item">
                    <div class="filter-label">Lokasi</div>
                    <input type="text" class="filter-input" id="locationFilter" placeholder="Cari lokasi...">
                </div>
                <div class="filter-item">
                    <div class="filter-label">Budget</div>
                    <select class="filter-select" id="budgetFilter">
                        <option value="">Semua Budget</option>
                        <option value="0-1000000">< Rp 1 Juta</option>
                        <option value="1000000-3000000">Rp 1-3 Juta</option>
                        <option value="3000000-5000000">Rp 3-5 Juta</option>
                        <option value="5000000-999999999">> Rp 5 Juta</option>
                    </select>
                </div>
                <button class="btn-filter" onclick="applyFilters()">
                    <i class="fas fa-filter"></i> Filter
                </button>
            </div>

            <!-- Results -->
            <div class="results-header">
                <h2 class="results-title">Lowongan Tersedia</h2>
                <div class="results-count">{{ $jobs->total() }} lowongan ditemukan</div>
            </div>

            <!-- Jobs Grid -->
            @if($jobs->count() > 0)
                <div class="jobs-grid">
                    @foreach($jobs as $job)
                        <div class="job-card">
                            <div class="job-header">
                                <div class="job-logo">{{ substr($job->employer->name ?? 'J', 0, 1) }}</div>
                                <div class="job-meta">
                                    <div class="job-company">{{ $job->employer->name ?? 'JobRescue' }}</div>
                                    <h3 class="job-title">{{ $job->title }}</h3>
                                    <div class="job-badges">
                                        <span class="badge badge-type">{{ ucfirst(str_replace('_', ' ', $job->job_type ?? 'Full Time')) }}</span>
                                        @if($job->is_urgent)
                                            <span class="badge badge-urgent">🔥 Mendesak</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="job-details">
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $job->location ?? 'Bogor' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                                @if($job->deadline)
                                    <div class="detail-item">
                                        <i class="fas fa-calendar"></i>
                                        <span>Deadline: {{ $job->deadline->format('d M') }}</span>
                                    </div>
                                @endif
                            </div>
                            @if($job->budget_min && $job->budget_max)
                                <div>
                                    <div class="job-budget-label">Budget</div>
                                    <div class="job-budget">Rp {{ number_format($job->budget_min) }} - {{ number_format($job->budget_max) }}</div>
                                </div>
                            @endif
                            <p class="job-desc">{{ Str::limit($job->description ?? '', 120) }}</p>
                            <div class="job-footer">
                                <div class="job-time">
                                    <i class="fas fa-users"></i> {{ $job->applications_count ?? 0 }} pelamar
                                </div>
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn-apply">
                                    Lihat Detail <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div style="margin-top:2rem">
                    {{ $jobs->appends(request()->query())->links() }}
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon"><i class="fas fa-inbox"></i></div>
                    <h3 class="empty-title">Belum Ada Lowongan</h3>
                    <p class="empty-text">Belum ada lowongan tersedia di kategori ini. Coba kategori lain atau cek kembali nanti.</p>
                </div>
            @endif
        </div>
    </section>

    <script>
        function applyFilters() {
            const jobType = document.getElementById('jobTypeFilter').value;
            const location = document.getElementById('locationFilter').value;
            const budget = document.getElementById('budgetFilter').value;
            
            const params = new URLSearchParams(window.location.search);
            if (jobType) params.set('job_type', jobType);
            else params.delete('job_type');
            
            if (location) params.set('location', location);
            else params.delete('location');
            
            if (budget) params.set('budget', budget);
            else params.delete('budget');
            
            window.location.search = params.toString();
        }
    </script>
</body>
</html>
