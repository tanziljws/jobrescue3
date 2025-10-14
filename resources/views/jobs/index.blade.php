<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Kerja - JobRescue Bogor</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.svg') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Header Styles (same as welcome) */
        .header { position: fixed; top: 0; left: 0; right: 0; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0, 0, 0, 0.08); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); z-index: 1000; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .header::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.95) 100%); z-index: -1; }
        .nav { display: flex; align-items: center; justify-content: space-between; padding: 1.2rem 2rem; max-width: 1200px; margin: 0 auto; position: relative; }
        .nav-brand { display: flex; align-items: center; gap: 0.5rem; }
        .logo { width: 50px; height: 50px; background: linear-gradient(135deg, #f97316, #ea580c); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.4rem; box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; }
        .logo::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent); transition: left 0.6s ease; }
        .logo:hover::before { left: 100%; }
        .logo:hover { transform: scale(1.15) rotate(8deg); box-shadow: 0 15px 40px rgba(249, 115, 22, 0.6), 0 0 0 2px rgba(255, 255, 255, 0.2); }
        .logo img { width: 36px; height: 36px; filter: brightness(0) invert(1); }
        .brand-text { font-size: 1.8rem; font-weight: 800; color: #1f2937; text-shadow: none; letter-spacing: -0.5px; transition: all 0.3s ease; }
        .brand-text:hover { color: #f97316; transform: translateY(-1px); }
        .nav-menu { display: flex; list-style: none; gap: 0.5rem; align-items: center; background: rgba(249, 115, 22, 0.05); backdrop-filter: blur(10px); padding: 0.5rem; border-radius: 50px; border: 1px solid rgba(249, 115, 22, 0.1); margin: 0; }
        .nav-link { text-decoration: none; color: #4b5563; font-weight: 500; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; padding: 0.8rem 1.5rem; border-radius: 25px; font-size: 0.95rem; letter-spacing: 0.3px; }
        .nav-link::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(249, 115, 22, 0.1), rgba(59, 130, 246, 0.1)); border-radius: 25px; opacity: 0; transition: opacity 0.3s ease; z-index: -1; }
        .nav-link:hover::before, .nav-link.active::before { opacity: 1; }
        .nav-link:hover, .nav-link.active { color: #f97316; background: rgba(249, 115, 22, 0.1); backdrop-filter: blur(15px); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(249, 115, 22, 0.15); }
        .btn-register { background: linear-gradient(135deg, #f97316, #ea580c); color: white; border: none; padding: 0.8rem 2rem; border-radius: 25px; font-weight: 600; font-size: 0.95rem; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3); text-decoration: none; display: inline-block; }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4); background: linear-gradient(135deg, #ea580c, #dc2626); }
        .hamburger { display: none; flex-direction: column; cursor: pointer; gap: 4px; }
        .hamburger span { width: 25px; height: 3px; background: #4b5563; border-radius: 2px; transition: all 0.3s ease; }
        @media (max-width: 768px) { .nav-menu { display: none; } .hamburger { display: flex; } }

        /* Particle bg */
        .particles-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 1; }
        .particle { position: absolute; background: rgba(255, 255, 255, 0.1); border-radius: 50%; animation: float 6s ease-in-out infinite; }
        @keyframes float { 0%, 100% { transform: translateY(0px) rotate(0deg);} 50% { transform: translateY(-20px) rotate(180deg);} }

        /* Hero (two-column layout like screenshot) */
        .hero { background: #667eea; min-height: 92vh; display: flex; align-items: center; position: relative; overflow: hidden; margin-top: -90px; padding-top: calc(90px + 0.25rem); padding-bottom: 3rem; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .hero-content { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 2.5rem; align-items: center; }
        .hero-title { font-size: 3.25rem; font-weight: 800; color: #ffffff; line-height: 1.1; margin-bottom: 1rem; text-shadow: 0 4px 12px rgba(0,0,0,0.25); }
        .hero-subtitle { color: rgba(255,255,255,0.95); max-width: 46rem; margin-bottom: 1.25rem; }
        .hero-text { text-align: left; }
        .rocket { display: inline-block; margin-right: .5rem; }
        /* Pill search */
        .search-container { display: flex; gap: .75rem; align-items: center; background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(10px); padding: .6rem; border-radius: 9999px; border: 1px solid rgba(255, 255, 255, 0.2); max-width: 720px; }
        .search-box, .location-box { flex: 1; position: relative; }

        /* Job Categories section with hero blue bg */
        .job-categories { background: #667eea; padding: 3rem 0; }
        .job-categories .section-title { color: #ffffff; }
        .job-categories .section-subtitle { color: rgba(255,255,255,0.92); }
        /* Category card polish with orange top accent */
        .categories-grid { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 1.25rem; }
        @media (max-width: 960px) { .categories-grid { grid-template-columns: repeat(2, minmax(0,1fr)); } }
        @media (max-width: 640px) { .categories-grid { grid-template-columns: 1fr; } }
        .category-card { position: relative; border-radius: 16px; background: #ffffff; border: 1px solid rgba(0,0,0,0.06); box-shadow: 0 20px 40px rgba(0,0,0,0.06); padding: 1.25rem; text-align: center; overflow: hidden; }
        .category-card::before { content: ""; position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(90deg,#f97316,#ea580c); }
        .category-title { margin: .5rem 0 0 0; font-weight: 800; color: #1f2937; }
        .category-count { color: #6b7280; margin: .15rem 0 .6rem 0; }
        .category-skills .skill-tag { display: inline-block; background: #f97316; color: #ffffff; border: 1px solid #f97316; border-radius: 9999px; padding: .35rem .75rem; font-weight: 700; font-size: .85rem; box-shadow: 0 6px 16px rgba(249,115,22,.18); }
        .search-input, .location-select { width: 100%; padding: 0.9rem 1rem 0.9rem 2.6rem; border: none; border-radius: 9999px; background: rgba(255,255,255,0.95); font-size: 0.95rem; outline: none; }
        .search-icon, .location-icon { position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%); color: #64748b; z-index: 2; }
        .search-button { background: linear-gradient(135deg, #f97316, #ea580c); color: white; border: none; padding: 0.9rem 1.2rem; border-radius: 9999px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 8px 24px rgba(249, 115, 22, 0.35); display: inline-flex; align-items: center; gap: .5rem; font-weight: 600; }
        .search-button:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(249, 115, 22, 0.45); }

        /* Right stacked stat cards */
        .hero-stats { display: flex; flex-direction: column; gap: 1.25rem; }
        .stat-card { display: flex; align-items: center; gap: 1rem; padding: 1.25rem; border-radius: 20px; background: rgba(255,255,255,0.14); border: 1px solid rgba(255,255,255,0.2); box-shadow: 0 8px 24px rgba(0,0,0,0.15) inset, 0 6px 18px rgba(0,0,0,0.12); }
        .stat-icon { width: 48px; height: 48px; border-radius: 14px; background: rgba(249,115,22,0.18); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
        .stat-info h3 { margin: 0; color: #ffffff; font-size: 1.4rem; font-weight: 800; }
        .stat-info p { margin: 0; color: rgba(255,255,255,0.9); font-weight: 500; }

        @media (max-width: 992px) {
            .hero { padding: 2rem 0; }
            .hero-content { grid-template-columns: 1fr; }
            .hero-text { text-align: center; }
            .search-container { margin: 0 auto; }
            .hero-stats { max-width: 420px; margin: 0 auto; }
        }

        /* Footer (same as welcome) */
        .footer { background: #0f172a; color: #cbd5e1; }
        .footer-container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }
        .footer-content { display: grid; grid-template-columns: 1.5fr 2fr; gap: 2rem; }
        .footer-logo .logo { width: 50px; height: 50px; }
        .footer-links { display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; }
        .footer-list { list-style: none; padding: 0; margin: 0; }
        .footer-list li a { color: #94a3b8; text-decoration: none; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); margin-top: 2rem; padding-top: 1.5rem; text-align: center; }

        /* Spacing fix for fixed header */
        body { padding-top: 90px; background: white; margin: 0; font-family: 'Poppins', sans-serif; }

        /* Lowongan Terbaru section */
        .talent-results { background: #ffffff; padding: 3rem 0; }
        .talent-results .results-title { color: #667eea; }
        .talent-results .results-count { color: #6b7280; }

        /* Stats section on white */
        .stats { background: #ffffff; padding: 3rem 0; }
        .stats .stat-number { color: #f97316; font-weight: 800; }
        .stats .stat-label { color: #6b7280; }

        /* How It Works section -> hero blue */
        .how-it-works { background: #667eea; padding: 3rem 0; }
        .how-it-works .section-title { color: #ffffff; }
        .how-it-works .section-subtitle { color: rgba(255,255,255,0.92); }
        .steps-container { display: grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap: 1.25rem; align-items: stretch; }
        @media (max-width: 1000px) { .steps-container { grid-template-columns: repeat(2, minmax(0,1fr)); } }
        @media (max-width: 560px) { .steps-container { grid-template-columns: 1fr; } }
        .how-it-works .step-item { position: relative; background: rgba(255,255,255,0.16); border: 1px solid rgba(255,255,255,0.22); border-radius: 20px; padding: 2.25rem 1.5rem 1.5rem; min-height: 210px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; box-shadow: 0 8px 16px rgba(0,0,0,0.08); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); }
        .how-it-works .step-item::after { content: ''; position: absolute; inset: 0; border-radius: 20px; box-shadow: inset 0 -6px 14px rgba(0,0,0,0.05); pointer-events: none; }
        @media (min-width: 1001px) {
          .how-it-works .step-item:not(:last-child)::before { content: none; }
        }
        .how-it-works .step-number { width: 44px; height: 44px; border-radius: 9999px; background: linear-gradient(135deg,#f97316,#ea580c); color: #fff; display: grid; place-items: center; font-weight: 800; position: absolute; top: 12px; left: 50%; transform: translateX(-50%); box-shadow: 0 6px 14px rgba(249,115,22,0.28); }
        .how-it-works .step-number::after { content: ''; position: absolute; inset: -6px; border-radius: 9999px; background: rgba(255,255,255,0.35); filter: blur(6px); z-index: -1; }
        .how-it-works .step-title { color: #ffffff; margin-top: 12px; margin-bottom: 6px; font-weight: 800; }
        .how-it-works .step-description { color: rgba(255,255,255,0.92); margin: 0; }

        /* Avatar bubble for job cards; category icon will be icon-only */
        .talent-avatar {
            width: 64px; height: 64px; border-radius: 16px;
            background: #ffffff; border: 1px solid rgba(0,0,0,0.06);
            display: grid; place-items: center; overflow: hidden;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
        }
        .category-icon img, .talent-avatar img {
            width: 100%; height: 100%; object-fit: cover; border-radius: inherit; display: block;
        }
        .category-icon i, .talent-avatar i { font-size: 28px; color: #f97316; }
        /* Category icon as plain FA icon (no orange container) */
        .category-icon { background: transparent; border: none; box-shadow: none; width: auto; height: auto; border-radius: 0; margin: 0 auto .6rem; }
        .category-icon i { color: #f97316; font-size: 32px; }
        .talent-card { border: 1px solid rgba(102,126,234,0.28); border-radius: 18px; background: rgba(102,126,234,0.3); box-shadow: 0 12px 28px rgba(102,126,234,0.12); }
        .talent-header { display: flex; gap: 12px; align-items: center; }
        .talent-info h3 { margin: 0; font-weight: 800; color: #1f2937; }
        .talent-info .talent-title { color: #6b7280; margin: 2px 0 0 0; }

        /* 'Lihat Detail' button: orange default, white on hover */
        .btn-view-profile { background: linear-gradient(135deg,#f97316,#ea580c); color: #ffffff; border: 1px solid rgba(249,115,22,0.35); }
        .btn-view-profile:hover { background: #ffffff; color: #f97316; border-color: #f97316; }
        .btn-view-profile i { color: inherit; }
    </style>
</head>
<body>
    <!-- Particle Background -->
    <div class="particles-container" id="particles"></div>

    <!-- Header -->
    <header class="header">
        <nav class="nav">
            <div class="nav-brand">
                <div class="logo">
                    <img src="{{ asset('img/icon.svg') }}" alt="Logo JobRescue">
                </div>
                <span class="brand-text">JobRescue</span>
            </div>
            
            <ul class="nav-menu" id="navMenu">
                <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                <li><a href="{{ route('jobs.index') }}" class="nav-link active">Cari Kerja</a></li>
                <li><a href="{{ route('talents.index') }}" class="nav-link">Cari Talent</a></li>
                <li><a href="#" class="nav-link">Tentang</a></li>
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
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
            
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main">
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            Temukan Lowongan Kerja Terbaru di Bogor
                            <span class="rocket">🚀</span>
                        </h1>
                        
                        <p class="hero-subtitle">
                            Jelajahi ratusan peluang kerja dari perusahaan dan UMKM terpercaya di Kota Bogor.
                        </p>
                        
                        <form method="GET" action="{{ route('jobs.index') }}" class="search-container">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Posisi / Jabatan" class="search-input" id="jobSearch">
                            </div>
                            <div class="location-box">
                                <i class="fas fa-map-marker-alt location-icon"></i>
                                <select name="location" class="location-select" id="jobLocation">
                                    <option value="">Semua Lokasi</option>
                                    <option value="kota-bogor" {{ request('location') == 'kota-bogor' ? 'selected' : '' }}>Kota Bogor</option>
                                    <option value="kabupaten-bogor" {{ request('location') == 'kabupaten-bogor' ? 'selected' : '' }}>Kabupaten Bogor</option>
                                </select>
                            </div>
                            <div class="location-box">
                                <i class="fas fa-briefcase location-icon"></i>
                                <select name="type" class="location-select" id="jobType">
                                    <option value="">Semua Tipe</option>
                                    <option value="full-time" {{ request('type') == 'full-time' ? 'selected' : '' }}>Full-time</option>
                                    <option value="part-time" {{ request('type') == 'part-time' ? 'selected' : '' }}>Part-time</option>
                                    <option value="freelance" {{ request('type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="kontrak" {{ request('type') == 'kontrak' ? 'selected' : '' }}>Kontrak</option>
                                </select>
                            </div>
                            <button type="submit" class="search-button">
                                <i class="fas fa-search"></i>
                                Cari Pekerjaan
                            </button>
                        </form>
                    </div>
                    
                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="stat-info">
                                <h3>{{ $jobs->total() }}+</h3>
                                <p>Lowongan Aktif</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="stat-info">
                                <h3>450+</h3>
                                <p>Perusahaan</p>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <h3>24 Jam</h3>
                                <p>Update Lowongan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics -->
        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number">2,100+</div>
                        <div class="stat-label">Pencari Kerja</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">450+</div>
                        <div class="stat-label">Perusahaan Terdaftar</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">5+</div>
                        <div class="stat-label">Lowongan Aktif</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-number">85%</div>
                        <div class="stat-label">Tingkat Keberhasilan</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Job Categories -->
        <section class="job-categories">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Kategori Pekerjaan</h2>
                    <p class="section-subtitle">Temukan pekerjaan sesuai dengan bidang yang Anda minati</p>
                </div>
                
                <div class="categories-grid">
                    @foreach($categories as $category)
                        @php
                            $iconMap = [
                                'Desain Grafis' => 'fa-solid fa-palette',
                                'Catering & Kuliner' => 'fa-solid fa-utensils',
                                'Teknisi & Perbaikan' => 'fa-solid fa-screwdriver-wrench',
                                'Kebersihan & Cleaning' => 'fa-solid fa-broom',
                                'Fotografi & Videografi' => 'fa-solid fa-camera',
                                'Transportasi & Logistik' => 'fa-solid fa-truck',
                                'Event Organizer' => 'fa-solid fa-calendar-check',
                                'Tukang & Konstruksi' => 'fa-solid fa-hammer',
                                'Digital Marketing' => 'fa-solid fa-chart-line',
                                'Pendidikan & Les' => 'fa-solid fa-chalkboard-user',
                                // Generic/back-compat
                                'Kesehatan' => 'fa-solid fa-stethoscope',
                                'Keuangan' => 'fa-solid fa-coins',
                                'IT & Software' => 'fa-solid fa-code',
                                'Pemasaran' => 'fa-solid fa-bullhorn',
                                'Transportasi' => 'fa-solid fa-truck',
                            ];
                            $catIcon = ($iconMap[$category->name] ?? null) ?: ($category->icon ?: 'fa-solid fa-briefcase');
                        @endphp
                        <div class="category-card">
                            <div class="category-icon">
                                <i class="{{ $catIcon }}"></i>
                            </div>
                            <h3 class="category-title">{{ $category->name }}</h3>
                            <p class="category-count">{{ $category->job_postings_count }}+ Lowongan</p>
                            <div class="category-skills">
                                <span class="skill-tag">{{ $category->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Job Listings -->
        <section class="talent-results">
            <div class="container">
                <div class="results-header">
                    <h2 class="results-title">Lowongan Terbaru</h2>
                    <div class="results-count">
                        <span id="jobCount">{{ $jobs->total() }}</span> lowongan tersedia
                    </div>
                </div>

                <div class="talent-grid" id="jobGrid">
                    @forelse($jobs as $job)
                        <div class="talent-card">
                            <div class="talent-header">
                                <div class="talent-avatar">
                                    <i class="{{ $job->category->icon ?? 'fas fa-briefcase' }}"></i>
                                </div>
                                <div class="talent-info">
                                    <h3>{{ $job->title }}</h3>
                                    <p class="talent-title">{{ $job->employer->name }}</p>
                                    <div class="talent-rating">
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <span class="rating-text">4.8/5</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="talent-details">
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $job->location }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-clock"></i>
                                    <span>{{ $job->type ?? 'Full Time' }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <span>Rp {{ number_format($job->budget_min/1000) }}k - {{ number_format($job->budget_max/1000) }}k</span>
                                </div>
                                <div class="detail-item">
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <div class="talent-skills">
                                <h4>Kualifikasi:</h4>
                                <div class="skills-list">
                                    @if($job->requirements)
                                        @php $reqs = is_array($job->requirements) ? $job->requirements : explode(',', (string) $job->requirements); @endphp
                                        @foreach(array_slice($reqs, 0, 4) as $req)
                                            <span class="skill-tag">{{ is_string($req) ? trim($req) : (is_array($req) ? (trim($req['name'] ?? '') ?: 'Kualifikasi') : trim((string) $req)) }}</span>
                                        @endforeach
                                    @else
                                        <span class="skill-tag">Sesuai bidang</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="talent-actions">
                                <a href="{{ route('jobs.show', $job) }}" class="btn-view-profile">
                                    <i class="fas fa-eye"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <div class="text-gray-400 text-6xl mb-4">🔍</div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada pekerjaan ditemukan</h3>
                            <p class="text-gray-500">Coba ubah kata kunci pencarian atau filter Anda.</p>
                        </div>
                    @endforelse
                </div>
                
                @if($jobs->hasPages())
                    <div class="load-more">
                        {{ $jobs->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </section>

        <!-- How It Works -->
        <section class="how-it-works">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Cara Mencari Kerja</h2>
                    <p class="section-subtitle">Langkah-langkah sederhana untuk mendapatkan pekerjaan impian</p>
                </div>
                
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3 class="step-title">Buat Profil Lengkap</h3>
                            <p class="step-description">Lengkapi profil Anda dengan informasi dan pengalaman kerja</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-user-edit"></i>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3 class="step-title">Cari & Filter Lowongan</h3>
                            <p class="step-description">Gunakan filter untuk menemukan lowongan yang sesuai dengan keahlian Anda</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3 class="step-title">Kirim Lamaran</h3>
                            <p class="step-description">Kirim lamaran kerja dengan CV dan portofolio terbaik Anda</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-content">
                            <h3 class="step-title">Interview & Diterima</h3>
                            <p class="step-description">Lakukan interview dan mulailah karir baru Anda</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer (same structure as welcome) -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="logo">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <span class="brand-text">JobRescue</span>
                    </div>
                    <p class="footer-description">Platform terpercaya untuk pekerjaan mikro dan UMKM di Kota Bogor.</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Untuk Pekerja</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('jobs.index') }}">Cari Pekerjaan</a></li>
                            <li><a href="{{ route('register') }}">Buat Profil</a></li>
                            <li><a href="#">Tips Karir</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Untuk Pemberi Kerja</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('register') }}">Post Pekerjaan</a></li>
                            <li><a href="{{ route('talents.index') }}">Cari Talent</a></li>
                            <li><a href="#">Kelola Proyek</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Bantuan</h4>
                        <ul class="footer-list">
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li><a href="#">Kebijakan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; 2025 JobRescue. Semua hak dilindungi. Dibuat dengan <span class="heart">❤️</span> untuk Kota Bogor.</p>
            </div>
        </div>
    </footer>

    <script>
        // Create floating particles
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            if (particlesContainer) {
                for (let i = 0; i < 50; i++) {
                    const particle = document.createElement('div');
                    particle.className = 'particle';
                    particle.style.left = Math.random() * 100 + '%';
                    particle.style.top = Math.random() * 100 + '%';
                    particle.style.width = Math.random() * 4 + 2 + 'px';
                    particle.style.height = particle.style.width;
                    particle.style.animationDelay = Math.random() * 6 + 's';
                    particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
                    particlesContainer.appendChild(particle);
                }
            }
        });
    </script>
</body>
</html>
