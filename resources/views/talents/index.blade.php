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
      body{font-family:'Poppins',sans-serif;line-height:1.6;color:#000;background:#ffffff;margin:0;overflow-x:hidden}
      .container{max-width:1200px;margin:0 auto;padding:0 20px}
      .header{position:fixed;inset:0 0 auto 0;background:rgba(255,255,255,.95);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,0,0,.08);box-shadow:0 4px 20px rgba(0,0,0,.08);z-index:1000}
      .nav{display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;max-width:1200px;margin:0 auto;position:relative}
      .nav-brand{display:flex;align-items:center;gap:.5rem}
      .logo{width:50px;height:50px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:15px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.4rem;box-shadow:0 10px 30px rgba(249,115,22,.4),0 0 0 1px rgba(255,255,255,.1);transition:all .4s cubic-bezier(.4,0,.2,1);position:relative;overflow:hidden}
      .logo img{width:36px;height:36px;filter:brightness(0) invert(1)}
      .brand-text{font-size:1.8rem;font-weight:800;color:#1f2937;letter-spacing:-.5px;transition:all .3s ease}
      .brand-text:hover{color:#f97316;transform:translateY(-1px)}
      .nav-menu{display:flex;list-style:none;gap:.25rem;align-items:center;background:rgba(249,115,22,.05);backdrop-filter:blur(10px);padding:.4rem;border-radius:50px;border:1px solid rgba(249,115,22,.1);margin:0}
      .nav-link{color:#4b5563;text-decoration:none;font-weight:500;padding:.65rem 1.25rem;border-radius:25px;position:relative;transition:all .3s cubic-bezier(.4,0,.2,1);font-size:.9rem;letter-spacing:.2px}
      .nav-link:hover:not(.active){color:#f97316}
      .nav-link.active{color:#ffffff;background:linear-gradient(135deg,#f97316,#ea580c);backdrop-filter:blur(15px);font-weight:600;pointer-events:none}
      .btn-register{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.8rem 2rem;border-radius:25px;font-weight:600;text-decoration:none;box-shadow:0 8px 25px rgba(249,115,22,.3);transition:all .3s cubic-bezier(.4,0,.2,1);display:inline-block}
      .btn-register:hover{transform:translateY(-2px);box-shadow:0 12px 35px rgba(249,115,22,.4);background:linear-gradient(135deg,#ea580c,#dc2626)}
      .user-menu{position:relative}
      .user-avatar{width:42px;height:42px;border-radius:50%;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;cursor:pointer;box-shadow:0 4px 12px rgba(249,115,22,.3);transition:all .3s ease}
      .user-avatar:hover{transform:scale(1.05);box-shadow:0 6px 16px rgba(249,115,22,.4)}
      .user-dropdown{position:absolute;top:calc(100% + 10px);right:0;background:#fff;border-radius:12px;box-shadow:0 8px 24px rgba(0,0,0,.12);min-width:180px;opacity:0;visibility:hidden;transform:translateY(-10px);transition:all .3s ease;z-index:100;border:1px solid rgba(0,0,0,.06)}
      .user-menu:hover .user-dropdown{opacity:1;visibility:visible;transform:translateY(0)}
      .user-dropdown a,.user-dropdown button{display:block;width:100%;padding:.75rem 1.25rem;text-decoration:none;color:#374151;font-weight:500;transition:all .2s ease;border:none;background:none;text-align:left;cursor:pointer;font-family:'Poppins',sans-serif;font-size:.9rem}
      .user-dropdown a:hover,.user-dropdown button:hover{background:#f8fafc;color:#f97316}
      .user-dropdown a:first-child{border-radius:12px 12px 0 0}
      .user-dropdown button{border-top:1px solid rgba(0,0,0,.06);border-radius:0 0 12px 12px}
      .main{margin-top:90px}
      .talent-hero{padding:6rem 0 4rem;min-height:80vh;display:flex;align-items:center;background:#667eea}
      .talent-hero .hero-content{display:grid;grid-template-columns:1.2fr .8fr;gap:2.5rem;align-items:center}
      .talent-hero .hero-title{font-size:3.5rem;font-weight:900;color:#fff;line-height:1.1;margin-bottom:1.5rem;text-shadow:0 4px 20px rgba(0,0,0,.3)}
      .talent-hero .hero-subtitle{font-size:1.2rem;color:rgba(255,255,255,.85);margin-bottom:2rem}
      .search-container{display:flex;gap:.75rem;align-items:center;background:rgba(255,255,255,.14);backdrop-filter:blur(10px);padding:.6rem;border-radius:9999px;border:1px solid rgba(255,255,255,.2);max-width:720px}
      .search-box,.location-box{flex:1;position:relative}
      .search-input,.location-select{width:100%;padding:.9rem 1rem .9rem 2.6rem;border:none;border-radius:9999px;background:rgba(255,255,255,.95);font-size:.95rem;outline:none}
      .search-icon,.location-icon{position:absolute;left:.9rem;top:50%;transform:translateY(-50%);color:#64748b}
      .search-button{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.9rem 1.2rem;border-radius:9999px;font-weight:600;box-shadow:0 8px 24px rgba(249,115,22,.35);display:inline-flex;align-items:center;gap:.5rem}
      .hero-stats{display:flex;flex-direction:column;gap:1.25rem}
      .stat-card{display:flex;align-items:center;gap:1rem;padding:1.25rem;border-radius:20px;background:rgba(255,255,255,.95);border:1px solid rgba(255,255,255,.3);box-shadow:0 4px 12px rgba(0,0,0,.1);backdrop-filter:blur(10px)}
      .stat-icon{width:48px;height:48px;border-radius:14px;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;color:#fff;box-shadow:0 4px 12px rgba(249,115,22,.3)}
      /* Stats strip (match homepage) */
      .stats-strip{background:linear-gradient(135deg,#f8fafc 0%,#e2e8f0 100%);padding:5rem 0;position:relative}
      .stats-strip::before{content:'';position:absolute;inset:0;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(148,163,184,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');opacity:.5}
      .stats-strip .container{position:relative;z-index:1}
      .stats-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:2rem}
      .home-stat-card{background:rgba(249,115,22,.12);border:2px solid rgba(249,115,22,.25);background-clip:padding-box;border-radius:24px;padding:2.5rem 2rem;min-height:180px;text-align:center;box-shadow:0 10px 30px rgba(249,115,22,.1),0 1px 3px rgba(249,115,22,.05);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:.75rem;position:relative;overflow:hidden;transition:all .3s cubic-bezier(.4,0,.2,1)}
      .home-stat-card::before{content:'';position:absolute;left:0;right:0;top:0;height:4px;background:linear-gradient(90deg,#f97316,#ea580c,#dc2626);opacity:1;transition:opacity .3s ease}
      .home-stat-card:hover{transform:translateY(-8px);box-shadow:0 20px 50px rgba(249,115,22,.2),0 5px 15px rgba(249,115,22,.1);border-color:rgba(249,115,22,.4)}
      .home-stat-card:hover::before{opacity:1}
      .home-stat-number{background:linear-gradient(135deg,#f97316,#ea580c);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;font-weight:900;font-size:3rem;letter-spacing:-1px;line-height:1;filter:drop-shadow(0 2px 4px rgba(249,115,22,.2))}
      .home-stat-label{color:#64748b;font-weight:600;font-size:1rem;letter-spacing:.3px}
      .home-stat-icon{width:48px;height:48px;border-radius:16px;background:linear-gradient(135deg,#f97316,#ea580c);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.5rem;margin-bottom:.5rem;box-shadow:0 8px 20px rgba(249,115,22,.3)}
      @media (max-width:992px){.stats-grid{grid-template-columns:repeat(2,1fr);gap:1.5rem}}
      @media (max-width:600px){.stats-grid{grid-template-columns:1fr;gap:1.25rem}.home-stat-card{min-height:160px;padding:2rem 1.5rem}.home-stat-number{font-size:2.5rem}}
      .talent-filters{padding:3rem 0;background:#667eea;border:none}
      .filters-container h3{color:#ffffff;margin-bottom:1.5rem;font-size:1.75rem;font-weight:800}
      .filters-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem}
      .filter-select{background:rgba(255,255,255,.95);border:1px solid rgba(255,255,255,.3);border-radius:15px;padding:.8rem 1rem;color:#1f2937;font-weight:500}
      .filter-select:focus{outline:none;border-color:rgba(249,115,22,.5);box-shadow:0 0 0 3px rgba(249,115,22,.1)}
      .btn-filter{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.8rem 1.4rem;border-radius:50px;font-weight:600;box-shadow:0 4px 12px rgba(249,115,22,.3);transition:all .3s ease}
      .btn-filter:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(249,115,22,.4)}
      .btn-reset{background:rgba(255,255,255,.95);border:1px solid rgba(255,255,255,.3);padding:.8rem 1.4rem;border-radius:50px;color:#1f2937;font-weight:600;transition:all .3s ease}
      .btn-reset:hover{background:#ffffff;border-color:rgba(249,115,22,.3);color:#f97316}
      .talent-results{padding:4rem 0;background:#f8fafc}
      .results-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem}
      .results-title{color:#1f2937;font-size:1.75rem;font-weight:800;text-shadow:0 2px 4px rgba(0,0,0,.05)}
      .results-count{color:#64748b;font-size:0.95rem;font-weight:500}
      .talent-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:1.5rem}
      .talent-card{background:rgba(102,126,234,.12);border:1px solid rgba(102,126,234,.25);border-radius:20px;padding:1.5rem;box-shadow:0 4px 12px rgba(102,126,234,.08);transition:all .3s ease}
      .talent-card:hover{transform:translateY(-4px);box-shadow:0 12px 24px rgba(102,126,234,.15);border-color:rgba(102,126,234,.35)}
      .talent-header{display:flex;gap:1rem;align-items:center;margin-bottom:1rem}
      .talent-avatar{width:64px;height:64px;border-radius:16px;background:linear-gradient(135deg,#f8fafc,#e2e8f0);border:2px solid rgba(249,115,22,.1);display:grid;place-items:center;overflow:hidden}
      .talent-info h3{color:#1f2937;font-size:1.125rem;font-weight:700;margin-bottom:.25rem}
      .talent-title{color:#64748b;font-size:0.875rem;margin-bottom:.5rem}
      .talent-rating{display:flex;align-items:center;gap:.5rem}
      .stars{color:#fbbf24;font-size:0.875rem;display:flex;gap:2px}
      .rating-text{color:#64748b;font-size:0.875rem;font-weight:600}
      .talent-details{display:flex;flex-wrap:wrap;gap:.75rem;margin:1rem 0;padding:1rem 0;border-top:1px solid rgba(0,0,0,.06);border-bottom:1px solid rgba(0,0,0,.06)}
      .detail-item{display:flex;align-items:center;gap:.5rem;color:#64748b;font-size:0.875rem}
      .detail-item i{color:#f97316;font-size:1rem}
      .talent-skills{margin:1rem 0}
      .talent-skills h4{color:#1f2937;font-size:0.875rem;font-weight:600;margin-bottom:.75rem}
      .skills-list{display:flex;flex-wrap:wrap;gap:.5rem}
      .skill-tag{background:linear-gradient(135deg,#fef3c7,#fde68a);color:#92400e;padding:.375rem .75rem;border-radius:9999px;font-size:0.8125rem;font-weight:600;border:1px solid rgba(251,191,36,.3)}
      .talent-actions{display:flex;gap:.75rem;margin-top:1rem}
      .btn-contact{background:#ffffff;color:#f97316;border:1px solid rgba(249,115,22,.3);padding:.625rem 1rem;border-radius:12px;font-weight:600;font-size:0.875rem;transition:all .3s ease;display:inline-flex;align-items:center;gap:.5rem}
      .btn-contact:hover{background:#f97316;color:#ffffff;border-color:#f97316}
      .btn-view-profile{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;border:none;padding:.625rem 1rem;border-radius:12px;font-weight:600;font-size:0.875rem;transition:all .3s ease;display:inline-flex;align-items:center;gap:.5rem}
      .btn-view-profile:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(249,115,22,.3)}
      .how-hire{padding:6rem 0;background:#667eea;border:none}
      .how-hire .section-title{color:#ffffff!important}
      .how-hire .section-subtitle{color:rgba(255,255,255,.9)!important}
      .how-hire .steps-container{display:grid!important;grid-template-columns:repeat(4,minmax(0,1fr))!important;gap:2rem!important;align-items:stretch!important;position:relative}
      .how-hire .step-item{background:rgba(255,255,255,.16)!important;border:1px solid rgba(255,255,255,.22)!important;backdrop-filter:blur(6px);padding:2rem 1.75rem!important;border-radius:20px!important;text-align:center!important;transition:all .3s ease;position:relative;z-index:2;box-shadow:0 8px 16px rgba(0,0,0,.08);display:flex;flex-direction:column;align-items:center;justify-content:flex-start;min-height:280px}
      .how-hire .step-item:hover{transform:translateY(-4px);box-shadow:0 12px 24px rgba(0,0,0,.12)}
      .how-hire .step-number{width:56px!important;height:56px!important;background:linear-gradient(135deg,#f97316,#ea580c)!important;border-radius:50%!important;display:flex!important;align-items:center;justify-content:center;font-size:1.5rem;font-weight:800;color:white;box-shadow:0 8px 20px rgba(249,115,22,.4);margin-bottom:1.5rem;flex-shrink:0}
      .how-hire .step-content{flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center}
      .how-hire .step-title{font-size:1.25rem;font-weight:700;color:#ffffff!important;margin-bottom:.75rem;line-height:1.3}
      .how-hire .step-description{color:rgba(255,255,255,.9)!important;font-size:.95rem;line-height:1.6;max-width:280px}
      .how-hire .step-icon{margin-top:1.25rem;font-size:2.5rem;color:rgba(255,255,255,.6);flex-shrink:0}
      @media (max-width:992px){.how-hire .steps-container{grid-template-columns:repeat(2,1fr)!important;gap:1.25rem!important}}
      @media (max-width:768px){.how-hire .steps-container{grid-template-columns:1fr!important;gap:1.5rem!important}.how-hire .step-item{min-height:auto!important}}
      .post-job{padding:5rem 0;background:#ffffff;position:relative;overflow:hidden}
      .post-job .container{position:relative;z-index:1}
      .post-job-content{background:#667eea;padding:3rem 2.5rem;border-radius:24px;border:1px solid rgba(102,126,234,.2);display:flex;justify-content:space-between;align-items:center;gap:2.5rem;box-shadow:0 20px 60px rgba(102,126,234,.25)}
      .post-job-text{flex:1}
      .post-job-title{color:#ffffff;font-size:2rem;font-weight:800;margin-bottom:.75rem;line-height:1.2}
      .post-job-subtitle{color:rgba(255,255,255,.95);font-size:1.05rem;line-height:1.6;max-width:600px}
      .post-job-action{flex-shrink:0}
      .btn-post-job{background:linear-gradient(135deg,#f97316,#ea580c);color:#ffffff;border:none;padding:1rem 2rem;border-radius:50px;font-weight:700;font-size:1rem;cursor:pointer;box-shadow:0 12px 30px rgba(249,115,22,.4);transition:all .3s ease;display:inline-flex;align-items:center;gap:.75rem}
      .btn-post-job:hover{transform:translateY(-3px);box-shadow:0 16px 40px rgba(249,115,22,.5);background:linear-gradient(135deg,#ea580c,#dc2626)}
      .btn-post-job i{font-size:1.1rem}
      @media (max-width:768px){.post-job-content{flex-direction:column;text-align:center;padding:2.5rem 2rem}.post-job-title{font-size:1.5rem}.post-job-subtitle{font-size:.95rem}}
      .footer{background:#ffffff;color:#111827;padding:3rem 0;border-top:1px solid rgba(0,0,0,.06)}
      .footer .container{max-width:1200px;margin:0 auto;padding:0 2rem}
      .footer-content{display:grid;grid-template-columns:1.5fr 2fr;gap:2.5rem;align-items:start}
      @media (max-width:992px){.footer-content{grid-template-columns:1fr}}
      .footer-brand .logo{width:50px;height:50px;border-radius:15px;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;display:inline-flex;align-items:center;justify-content:center;box-shadow:0 12px 28px rgba(249,115,22,.38);vertical-align:middle}
      .footer-brand .brand-text{color:#111827;margin-left:.75rem;display:inline-block;vertical-align:middle;font-size:1.8rem;font-weight:800}
      .footer-description{color:#6b7280;margin-top:.75rem;max-width:28rem}
      .footer-links{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:1.75rem;align-items:start}
      @media (max-width:992px){.footer-links{grid-template-columns:repeat(2,minmax(0,1fr))}}
      @media (max-width:520px){.footer-links{grid-template-columns:1fr}}
      .footer-title{color:#f97316;font-weight:800;margin-bottom:.75rem}
      .footer-list{list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.45rem}
      .footer-list a{color:#374151;text-decoration:none;transition:color .2s ease}
      .footer-list a:hover{color:#111827}
      .footer-bottom{margin-top:2rem;padding-top:1.25rem;border-top:1px solid rgba(0,0,0,.08);display:flex;flex-direction:column;align-items:center;gap:.75rem}
      .footer-social{text-align:center}
      .footer-social .social-title{color:#1f2937;margin:.25rem 0 .5rem 0;font-weight:600}
      .social-links{display:flex;gap:.6rem;justify-content:center}
      .social-link{width:36px;height:36px;border-radius:9999px;background:rgba(0,0,0,.06);display:flex;align-items:center;justify-content:center;color:#1f2937;transition:transform .2s ease,background .2s ease,color .2s ease;text-decoration:none}
      .social-link:hover{transform:translateY(-2px);background:rgba(0,0,0,.12);color:#111827}
      .footer-legal{color:#6b7280;display:flex;gap:1rem;align-items:center;flex-wrap:wrap;justify-content:center}
      .footer-legal a{color:#374151;text-decoration:none}
      .footer-legal a:hover{color:#111827;text-decoration:underline}
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
                @if(!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'worker'))
                    <li><a href="{{ route('pricing') }}" class="nav-link">Pricing</a></li>
                @endif
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
                    <div class="user-avatar" style="overflow:hidden;">
                    @php($pp = Auth::user()->profile_photo ?? null)
                    @if($pp)
                        <img src="{{ asset('storage/'.$pp) }}" alt="{{ Auth::user()->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:9999px;display:block;">
                    @else
                        <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                    @endif
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

        <!-- Stats Strip Section (match homepage) -->
        <section class="stats-strip">
            <div class="container">
                <div class="stats-grid">
                    <div class="home-stat-card">
                        <div class="home-stat-icon"><i class="fas fa-users"></i></div>
                        <div class="home-stat-number">2,100+</div>
                        <div class="home-stat-label">Talent Terdaftar</div>
                    </div>
                    <div class="home-stat-card">
                        <div class="home-stat-icon"><i class="fas fa-building"></i></div>
                        <div class="home-stat-number">450+</div>
                        <div class="home-stat-label">Perusahaan</div>
                    </div>
                    <div class="home-stat-card">
                        <div class="home-stat-icon"><i class="fas fa-clipboard-list"></i></div>
                        <div class="home-stat-number">5+</div>
                        <div class="home-stat-label">Lowongan Aktif</div>
                    </div>
                    <div class="home-stat-card">
                        <div class="home-stat-icon"><i class="fas fa-star"></i></div>
                        <div class="home-stat-number">85%</div>
                        <div class="home-stat-label">Tingkat Keberhasilan</div>
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
                    <h2 class="results-title">Talent Tersedia</h2>
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
                    <button class="btn-filter" id="loadMore"><i class="fas fa-plus"></i> Muat Lebih Banyak</button>
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
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3 class="step-title">Cari & Filter Talent</h3>
                            <p class="step-description">Gunakan filter untuk menemukan talent yang sesuai dengan kebutuhan Anda</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-search"></i></div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3 class="step-title">Lihat Profil & Portofolio</h3>
                            <p class="step-description">Review profil lengkap, skill, dan pengalaman kerja talent</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-user-circle"></i></div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3 class="step-title">Hubungi & Interview</h3>
                            <p class="step-description">Hubungi talent langsung dan lakukan interview sesuai kebutuhan</p>
                        </div>
                        <div class="step-icon"><i class="fas fa-phone"></i></div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">4</div>
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
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="logo">
                        <img src="{{ asset('img/icon.svg') }}" alt="Logo JobRescue" style="width:28px;height:28px;filter:brightness(0) invert(1);" />
                    </div>
                    <span class="brand-text">JobRescue</span>
                    <p class="footer-description">Menghubungkan talenta Bogor dengan peluang kerja mikro dan UMKM di Kota Bogor</p>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4 class="footer-title">Perusahaan</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                            <li><a href="#">Karir</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Press</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4 class="footer-title">Untuk Talent</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('jobs.index') }}">Cari Kerja</a></li>
                            <li><a href="#">Cara Kerja</a></li>
                            <li><a href="#">Tips Sukses</a></li>
                            <li><a href="#">Komunitas</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4 class="footer-title">Untuk Klien</h4>
                        <ul class="footer-list">
                            <li><a href="{{ route('talents.index') }}">Cari Talent</a></li>
                            <li><a href="#">Posting Job</a></li>
                            <li><a href="#">Pricing</a></li>
                            <li><a href="#">Enterprise</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4 class="footer-title">Support</h4>
                        <ul class="footer-list">
                            <li><a href="#">Bantuan</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">Kontak</a></li>
                            <li><a href="#">Status</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="footer-social">
                    <h4 class="social-title">Ikuti Kami</h4>
                    <div class="social-links">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-legal">
                    <p class="copyright">© {{ date('Y') }} JobRescue. All rights reserved.</p>
                    <div class="legal-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
