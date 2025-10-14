<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Talent - JobRescue Bogor</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
      /* Paste of the visual style from provided design (condensed to essentials) */
      *{margin:0;padding:0;box-sizing:border-box}
      body{font-family:'Poppins',sans-serif;line-height:1.6;color:#000;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);overflow-x:hidden}
      .container{max-width:1200px;margin:0 auto;padding:0 20px}
      .header{position:fixed;inset:0 0 auto 0;background:rgba(255,255,255,.95);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.08);box-shadow:0 4px 20px rgba(0,0,0,.08);z-index:1000}
      .nav{display:flex;align-items:center;justify-content:space-between;padding:1.2rem 2rem;max-width:1200px;margin:0 auto}
      .nav-brand{display:flex;align-items:center;gap:.5rem}
      .logo{width:50px;height:50px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:15px;display:flex;align-items:center;justify-content:center;color:#fff;box-shadow:0 10px 30px rgba(249,115,22,.4)}
      .logo img{width:36px;height:36px;filter:brightness(0) invert(1)}
      .brand-text{font-size:1.8rem;font-weight:800;color:#1f2937}
      .nav-menu{display:flex;list-style:none;gap:.5rem;align-items:center;background:rgba(249,115,22,.05);padding:.5rem;border-radius:50px;border:1px solid rgba(249,115,22,.1)}
      .nav-link{color:#4b5563;text-decoration:none;font-weight:500;padding:.8rem 1.5rem;border-radius:25px;position:relative}
      .nav-link:hover,.nav-link.active{color:#f97316;background:rgba(249,115,22,.1);box-shadow:0 8px 25px rgba(249,115,22,.15)}
      .btn-register{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.8rem 2rem;border-radius:25px;font-weight:600;text-decoration:none;box-shadow:0 8px 25px rgba(249,115,22,.3)}
      .main{margin-top:90px}
      .talent-hero{padding:6rem 0 4rem;min-height:80vh;display:flex;align-items:center}
      .talent-hero .hero-content{display:grid;grid-template-columns:2fr 1fr;gap:4rem;align-items:center}
      .talent-hero .hero-title{font-size:3.5rem;font-weight:900;color:#fff;line-height:1.1;margin-bottom:1.5rem;text-shadow:0 4px 20px rgba(0,0,0,.3)}
      .talent-hero .hero-subtitle{font-size:1.2rem;color:rgba(255,255,255,.85);margin-bottom:2rem}
      .search-container{display:flex;gap:1rem;background:rgba(255,255,255,.15);backdrop-filter:blur(20px);padding:1.2rem;border-radius:50px;border:2px solid rgba(255,255,255,.2)}
      .search-box,.location-box{flex:1;position:relative}
      .search-input,.location-select{width:100%;padding:.9rem 1rem .9rem 2.6rem;border:none;border-radius:9999px;background:rgba(255,255,255,.95);font-size:.95rem;outline:none}
      .search-icon,.location-icon{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:#64748b}
      .search-button{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.9rem 1.2rem;border-radius:9999px;font-weight:600;box-shadow:0 8px 24px rgba(249,115,22,.35);display:inline-flex;align-items:center;gap:.5rem}
      .hero-stats{display:flex;flex-direction:column;gap:1.25rem}
      .stat-card{display:flex;align-items:center;gap:1rem;padding:1.25rem;border-radius:20px;background:rgba(255,255,255,.14);border:1px solid rgba(255,255,255,.2)}
      .stat-icon{width:48px;height:48px;border-radius:14px;background:rgba(249,115,22,.18);display:flex;align-items:center;justify-content:center;color:#fff}
      .talent-filters{padding:3rem 0;background:#ffffff;border-top:1px solid rgba(0,0,0,.08);border-bottom:1px solid rgba(0,0,0,.08)}
      .filters-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem}
      .filter-select{background:#fff;border:1px solid rgba(0,0,0,.12);border-radius:15px;padding:.8rem 1rem}
      .btn-filter{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.8rem 1.4rem;border-radius:50px;font-weight:600}
      .btn-reset{background:#fff;border:1px solid rgba(0,0,0,.12);padding:.8rem 1.4rem;border-radius:50px}
      .talent-results{padding:4rem 0}
      .results-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}
      .talent-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1.25rem}
      .talent-card{background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:22px;padding:1.25rem;box-shadow:0 12px 28px rgba(0,0,0,.06)}
      .talent-header{display:flex;gap:12px;align-items:center}
      .talent-avatar{width:64px;height:64px;border-radius:16px;background:#fff;border:1px solid rgba(0,0,0,.06);display:grid;place-items:center;overflow:hidden}
      .btn-view-profile{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:1px solid rgba(249,115,22,.35);padding:.5rem .9rem;border-radius:12px}
      .how-hire{padding:6rem 0;background:#ffffff;border-top:1px solid rgba(0,0,0,.08);border-bottom:1px solid rgba(0,0,0,.08)}
      .post-job{padding:4rem 0}
      .post-job-content{background:rgba(255,255,255,.1);backdrop-filter:blur(20px);padding:3rem;border-radius:25px;border:1px solid rgba(255,255,255,.1);display:flex;justify-content:space-between;gap:2rem}
      .footer{background:rgba(0,0,0,.3);backdrop-filter:blur(20px);color:#fff;padding:2rem 0;border-top:1px solid rgba(255,255,255,.1)}
      @media (max-width:768px){.nav-menu{display:none}.talent-hero .hero-content{grid-template-columns:1fr;gap:3rem;text-align:center}.search-container{flex-direction:column;border-radius:25px}}
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
                <li><a href="{{ route('jobs.index') }}" class="nav-link">Cari Kerja</a></li>
                <li><a href="{{ route('talents.index') }}" class="nav-link active">Cari Talent</a></li>
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
            @endguest
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main">
        <!-- Hero Section -->
        <section class="talent-hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            <span class="title-line">Temukan Talent</span>
                            <span class="title-line">Terbaik di Bogor</span>
                            <span class="title-line">untuk UMKM Anda</span>
                            <span class="rocket">🎯</span>
                        </h1>
                        <p class="hero-subtitle">Platform terpercaya untuk menemukan karyawan berkualitas dari talenta lokal Bogor</p>
                        <div class="search-container">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" placeholder="Cari berdasarkan skill atau posisi" class="search-input" id="talentSearch">
                            </div>
                            <div class="location-box">
                                <i class="fas fa-map-marker-alt location-icon"></i>
                                <select class="location-select" id="talentLocation">
                                    <option value="">Semua area Bogor</option>
                                    <option value="bogor-tengah">Bogor Tengah</option>
                                    <option value="bogor-utara">Bogor Utara</option>
                                    <option value="bogor-selatan">Bogor Selatan</option>
                                    <option value="bogor-timur">Bogor Timur</option>
                                    <option value="bogor-barat">Bogor Barat</option>
                                    <option value="tanah-sareal">Tanah Sareal</option>
                                </select>
                            </div>
                            <button class="search-button"><i class="fas fa-search"></i> Cari Talent</button>
                        </div>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-users"></i></div>
                            <div class="stat-info"><h3>2,100+</h3><p>Talent Terdaftar</p></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-star"></i></div>
                            <div class="stat-info"><h3>4.8/5</h3><p>Rating Talent</p></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                            <div class="stat-info"><h3>24 Jam</h3><p>Waktu Pencarian</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter Section -->
        <section class="talent-filters">
            <div class="container">
                <div class="filters-container">
                    <h3 class="filters-title">Filter Talent</h3>
                    <div class="filters-grid">
                        <select class="filter-select" id="categoryFilter">
                            <option value="">Semua Kategori</option>
                            <option value="retail">Retail & Toko</option>
                            <option value="kuliner">Kuliner</option>
                            <option value="pendidikan">Pendidikan</option>
                            <option value="transportasi">Transportasi</option>
                            <option value="properti">Properti</option>
                            <option value="it">IT & Digital</option>
                        </select>
                        <select class="filter-select" id="experienceFilter">
                            <option value="">Semua Level</option>
                            <option value="fresh">Fresh Graduate</option>
                            <option value="junior">Junior (1-2 tahun)</option>
                            <option value="senior">Senior (3+ tahun)</option>
                        </select>
                        <select class="filter-select" id="workTypeFilter">
                            <option value="">Semua Tipe</option>
                            <option value="fulltime">Full Time</option>
                            <option value="parttime">Part Time</option>
                            <option value="freelance">Freelance</option>
                            <option value="contract">Contract</option>
                        </select>
                        <select class="filter-select" id="salaryFilter">
                            <option value="">Semua Range</option>
                            <option value="1-2">Rp 1-2 Juta</option>
                            <option value="2-3">Rp 2-3 Juta</option>
                            <option value="3-5">Rp 3-5 Juta</option>
                            <option value="5+">Rp 5+ Juta</option>
                        </select>
                    </div>
                    <div class="filter-actions" style="margin-top:1rem;display:flex;gap:1rem;justify-content:center;">
                        <button class="btn-filter" id="applyFilters"><i class="fas fa-filter"></i> Terapkan Filter</button>
                        <button class="btn-reset" id="resetFilters"><i class="fas fa-rotate-left"></i> Reset Filter</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Talent Results -->
        <section class="talent-results">
            <div class="container">
                <div class="results-header">
                    <h2 class="results-title" style="color:#fff;text-shadow:0 2px 10px rgba(0,0,0,.3)">Talent Tersedia</h2>
                    <div class="results-count"><span id="talentCount">156</span> talent ditemukan</div>
                </div>
                <div class="talent-grid" id="talentGrid">
                    <div class="talent-card">
                        <div class="talent-header">
                            <div class="talent-avatar"><img src="https://i.pravatar.cc/80" alt=""></div>
                            <div class="talent-info">
                                <h3>Rizki Pratama</h3>
                                <div class="talent-title">Desainer Grafis • Bogor Tengah</div>
                                <div class="talent-rating"><div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div><span class="rating-text">4.8/5</span></div>
                            </div>
                        </div>
                        <div class="talent-details">
                            <div class="detail-item"><i class="fas fa-map-marker-alt"></i><span>Bogor</span></div>
                            <div class="detail-item"><i class="fas fa-briefcase"></i><span>Freelance</span></div>
                            <div class="detail-item"><i class="fas fa-money-bill-wave"></i><span>Rp 2-3 jt/bulan</span></div>
                        </div>
                        <div class="talent-skills">
                            <h4>Keahlian:</h4>
                            <div class="skills-list">
                                <span class="skill-tag">Figma</span>
                                <span class="skill-tag">Canva</span>
                                <span class="skill-tag">Logo</span>
                            </div>
                        </div>
                        <div class="talent-actions">
                            <button class="btn-contact"><i class="fas fa-envelope"></i> Hubungi</button>
                            <button class="btn-view-profile"><i class="fas fa-eye"></i> Lihat Profil</button>
                        </div>
                    </div>
                </div>
                <div class="load-more" style="text-align:center;margin-top:1.5rem">
                    <button class="btn-reset" id="loadMore"><i class="fas fa-plus"></i> Muat Lebih Banyak</button>
                </div>
            </div>
        </section>

        <!-- How It Works -->
        <section class="how-hire">
            <div class="container">
                <div class="section-header" style="text-align:center;margin-bottom:1.5rem">
                    <h2 class="section-title" style="color:#1f2937">Cara Mempekerjakan Talent</h2>
                    <p class="section-subtitle" style="color:#4b5563">Proses sederhana untuk mendapatkan talent terbaik</p>
                </div>
                <div class="steps-container" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:1rem">
                    <div class="step-item" style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:1.25rem;text-align:center">
                        <div class="step-number" style="display:none">1</div>
                        <div class="step-content">
                            <h3 class="step-title">Cari & Filter Talent</h3>
                            <p class="step-description">Gunakan filter untuk menemukan talent yang sesuai dengan kebutuhan Anda</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-search"></i></div>
                    </div>
                    <div class="step-item" style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:1.25rem;text-align:center">
                        <div class="step-number" style="display:none">2</div>
                        <div class="step-content">
                            <h3 class="step-title">Lihat Profil & Portofolio</h3>
                            <p class="step-description">Review profil lengkap, skill, dan pengalaman kerja talent</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-user-circle"></i></div>
                    </div>
                    <div class="step-item" style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:1.25rem;text-align:center">
                        <div class="step-number" style="display:none">3</div>
                        <div class="step-content">
                            <h3 class="step-title">Hubungi & Interview</h3>
                            <p class="step-description">Hubungi talent langsung dan lakukan interview sesuai kebutuhan</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-phone"></i></div>
                    </div>
                    <div class="step-item" style="background:#fff;border:1px solid rgba(0,0,0,.08);border-radius:18px;padding:1.25rem;text-align:center">
                        <div class="step-number" style="display:none">4</div>
                        <div class="step-content">
                            <h3 class="step-title">Rekrut & Mulai Kerja</h3>
                            <p class="step-description">Tandatangani kontrak dan mulai bekerja sama dengan talent</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-handshake"></i></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Post Job Section -->
        <section class="post-job">
            <div class="container">
                <div class="post-job-content">
                    <div class="post-job-text">
                        <h2 class="post-job-title" style="color:#fff">Tidak Menemukan Talent yang Cocok?</h2>
                        <p class="post-job-subtitle" style="color:rgba(255,255,255,.85)">Posting lowongan kerja Anda dan biarkan talent yang tepat menemukan Anda</p>
                    </div>
                    <div class="post-job-action">
                        <button class="btn-post-job"><i class="fas fa-plus-circle"></i> Posting Lowongan</button>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container" style="text-align:center;color:rgba(255,255,255,.85)">
            © 2024 JobRescue Bogor. All rights reserved.
        </div>
    </footer>
</body>
</html>
