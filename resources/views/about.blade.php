<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang JobRescue - Platform Kerja Lokal Bogor</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    <meta name="description" content="Mengenal lebih dekat JobRescue, platform lokal yang menghubungkan pencari kerja dan pemberi kerja di Bogor.">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
      *{margin:0;padding:0;box-sizing:border-box}
      body{font-family:'Poppins',sans-serif;line-height:1.6;color:#000;background:#ffffff;margin:0;overflow-x:hidden;padding-top:90px}
      .container{max-width:1200px;margin:0 auto;padding:0 2rem}
      
      /* Header */
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
      
      /* Hero Section */
      .hero{background:#667eea;padding:6rem 0 4rem;min-height:60vh;display:flex;align-items:center;position:relative;overflow:hidden}
      .hero::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');opacity:.5}
      .hero .container{position:relative;z-index:1;text-align:center}
      .hero-title{font-size:3.5rem;font-weight:900;color:#fff;line-height:1.1;margin-bottom:1.5rem;text-shadow:0 4px 20px rgba(0,0,0,.3)}
      .hero-subtitle{font-size:1.2rem;color:rgba(255,255,255,.9);max-width:700px;margin:0 auto}
      /* Hero ornaments */
      .hero .ornaments{position:absolute;inset:0;pointer-events:none}
      .hero .badge{position:absolute;display:flex;align-items:center;justify-content:center;width:64px;height:64px;border-radius:18px;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;box-shadow:0 12px 30px rgba(249,115,22,.35)}
      .hero .badge i{font-size:1.4rem}
      .hero .badge.badge-1{top:18%;right:10%;animation:floatY 6s ease-in-out infinite}
      .hero .badge.badge-2{top:42%;right:18%;background:linear-gradient(135deg,#10b981,#059669);box-shadow:0 12px 30px rgba(16,185,129,.35);animation:floatY 7s ease-in-out -1s infinite}
      .hero .badge.badge-3{top:26%;left:8%;background:linear-gradient(135deg,#3b82f6,#1d4ed8);box-shadow:0 12px 30px rgba(59,130,246,.35);animation:floatY 8s ease-in-out -0.5s infinite}
      @keyframes floatY{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
      .hero-wave{position:absolute;left:0;right:0;bottom:-1px;line-height:0}
      .hero-wave svg{display:block;width:100%;height:60px}
      
      /* Content Sections */
      .content-section{padding:5rem 0}
      .content-section.gray{background:#f8fafc}
      .content-section.about-story{background:#667eea;position:relative;overflow:hidden}
      .content-section.about-story::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots3" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots3)"/></svg>');opacity:.5}
      .content-section.about-story .container{position:relative;z-index:1}
      .content-section.about-story .section-title{color:#ffffff}
      .content-section.about-story .section-subtitle{color:rgba(255,255,255,.9)}
      .section-header{text-align:center;margin-bottom:3rem}
      .section-title{font-size:2.5rem;font-weight:800;color:#1f2937;margin-bottom:1rem}
      .section-subtitle{font-size:1.1rem;color:#6b7280;max-width:700px;margin:0 auto}
      
      /* Vision Mission */
      .vm-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:2rem;margin-top:2rem}
      @media (max-width:768px){.vm-grid{grid-template-columns:1fr}}
      .vm-card{background:#667eea;border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:2.5rem;box-shadow:0 10px 30px rgba(102,126,234,.2);transition:all .3s ease}
      .vm-card:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(102,126,234,.3)}
      .vm-icon{width:60px;height:60px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:16px;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.8rem;margin-bottom:1.5rem;box-shadow:0 8px 20px rgba(249,115,22,.3)}
      .vm-title{font-size:1.5rem;font-weight:800;color:#ffffff;margin-bottom:1rem}
      .vm-text{color:rgba(255,255,255,.9);line-height:1.8}
      
      /* Mission List */
      .mission-list{list-style:none;padding:0;margin:1rem 0 0 0}
      .mission-list li{display:flex;align-items:start;gap:1rem;margin-bottom:1rem;color:rgba(255,255,255,.9)}
      .mission-list li i{color:#fbbf24;font-size:1.2rem;margin-top:.2rem;flex-shrink:0}
      
      /* About Story */
      .story-content{max-width:900px;margin:0 auto;background:#fff;border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:3rem;box-shadow:0 20px 60px rgba(0,0,0,.15)}
      .story-content p{color:#374151;line-height:1.8;margin-bottom:1.5rem;font-size:1.05rem}
      .story-content p:last-child{margin-bottom:0}
      
      /* Team */
      .team-badge{display:inline-flex;align-items:center;gap:.75rem;background:linear-gradient(135deg,#f97316,#ea580c);color:#fff;padding:1rem 2rem;border-radius:50px;font-weight:600;box-shadow:0 8px 20px rgba(249,115,22,.3);margin-top:1rem}
      .team-badge i{font-size:1.2rem}
      
      /* Contact Info */
      .contact-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:2rem;margin-top:2rem}
      @media (max-width:768px){.contact-grid{grid-template-columns:1fr}}
      .contact-card{background:rgba(249,115,22,.15);border:1px solid rgba(249,115,22,.3);border-radius:20px;padding:2rem;text-align:center;box-shadow:0 10px 30px rgba(249,115,22,.1);transition:all .3s ease}
      .contact-card:hover{transform:translateY(-4px);box-shadow:0 20px 40px rgba(249,115,22,.2)}
      .contact-icon{width:50px;height:50px;background:linear-gradient(135deg,#f97316,#ea580c);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;margin:0 auto 1rem;box-shadow:0 8px 20px rgba(249,115,22,.3)}
      .contact-title{font-size:1.1rem;font-weight:700;color:#1f2937;margin-bottom:.5rem}
      .contact-text{color:#6b7280}
      .contact-text a{color:#f97316;text-decoration:none;font-weight:600}
      .contact-text a:hover{text-decoration:underline}
      
      /* CTA Section */
      .cta-section{background:#667eea;padding:5rem 0;text-align:center;position:relative;overflow:hidden}
      .cta-section::before{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="dots2" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="2" cy="2" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23dots2)"/></svg>');opacity:.5}
      .cta-section .container{position:relative;z-index:1}
      .cta-title{font-size:2.5rem;font-weight:800;color:#fff;margin-bottom:1rem}
      .cta-subtitle{font-size:1.2rem;color:rgba(255,255,255,.9);margin-bottom:2rem}
      .cta-buttons{display:flex;gap:1rem;justify-content:center;flex-wrap:wrap}
      .cta-btn{background:#fff;color:#667eea;border:none;padding:1rem 2rem;border-radius:50px;font-weight:700;font-size:1rem;cursor:pointer;box-shadow:0 8px 20px rgba(0,0,0,.2);transition:all .3s ease;text-decoration:none;display:inline-flex;align-items:center;gap:.5rem}
      .cta-btn:hover{transform:translateY(-3px);box-shadow:0 12px 30px rgba(0,0,0,.3)}
      .cta-btn.secondary{background:linear-gradient(135deg,#f97316,#ea580c);color:#fff}
      
      /* Footer */
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
      
      @media (max-width:768px){
        .hero-title{font-size:2.5rem}
        .section-title{font-size:2rem}
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
                <li><a href="{{ route('jobs.index') }}" class="nav-link">Cari Kerja</a></li>
                <li><a href="{{ route('talents.index') }}" class="nav-link">Cari Talent</a></li>
                @if(!auth()->check() || (auth()->user()->role !== 'admin' && auth()->user()->role !== 'worker'))
                    <li><a href="{{ route('pricing') }}" class="nav-link">Pricing</a></li>
                @endif
                <li><a href="{{ route('about') }}" class="nav-link active">Tentang</a></li>
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

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Tentang JobRescue</h1>
            <p class="hero-subtitle">Platform lokal yang menghubungkan pencari kerja dan pemberi kerja di Bogor untuk membangun ekonomi lokal yang berdaya saing.</p>
        </div>
        <!-- ornaments (decorative) -->
        <div class="ornaments" aria-hidden="true">
            <div class="badge badge-1"><i class="fas fa-briefcase"></i></div>
            <div class="badge badge-2"><i class="fas fa-users"></i></div>
            <div class="badge badge-3"><i class="fas fa-map-marker-alt"></i></div>
        </div>
        <div class="hero-wave" aria-hidden="true">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none">
                <path d="M0,64 C240,112 480,16 720,48 C960,80 1200,144 1440,80 L1440,120 L0,120 Z" fill="#fff" opacity="1"/>
            </svg>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Visi & Misi Kami</h2>
                <p class="section-subtitle">Komitmen kami untuk memajukan ekosistem kerja di Kota Bogor</p>
            </div>
            
            <div class="vm-grid">
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="vm-title">Visi</h3>
                    <p class="vm-text">Menjadi jembatan digital terbaik bagi tenaga kerja dan perusahaan di Bogor untuk membangun ekonomi lokal yang berdaya saing.</p>
                </div>
                
                <div class="vm-card">
                    <div class="vm-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="vm-title">Misi</h3>
                    <ul class="mission-list">
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Mempermudah akses informasi lowongan kerja lokal</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Mendukung UMKM Bogor menemukan tenaga kerja berkualitas</span>
                        </li>
                        <li>
                            <i class="fas fa-check-circle"></i>
                            <span>Meningkatkan literasi digital bagi pencari kerja muda</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- About Story -->
    <section class="content-section about-story">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Tentang Kami</h2>
                <p class="section-subtitle">Cerita di balik JobRescue</p>
            </div>
            
            <div class="story-content">
                <p>JobRescue lahir dari keprihatinan kami melihat banyaknya talenta muda di Bogor yang kesulitan menemukan pekerjaan yang sesuai dengan keahlian mereka. Di sisi lain, UMKM dan perusahaan lokal juga menghadapi tantangan dalam merekrut tenaga kerja yang tepat.</p>
                
                <p>Kami percaya bahwa teknologi dapat menjadi solusi untuk menjembatani kesenjangan ini. Dengan platform yang mudah digunakan dan fokus pada kebutuhan lokal Bogor, JobRescue hadir untuk membantu pencari kerja menemukan peluang yang tepat dan membantu perusahaan menemukan talenta terbaik.</p>
                
                <p>JobRescue dikembangkan oleh tim muda dari Bogor yang peduli terhadap masa depan tenaga kerja lokal. Kami memahami dinamika pasar kerja Bogor dan berkomitmen untuk terus berinovasi demi menciptakan ekosistem kerja yang lebih baik.</p>
                
                <div style="text-align:center">
                    <div class="team-badge">
                        <i class="fas fa-users"></i>
                        <span>Tim Muda Peduli Tenaga Kerja Lokal</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info -->
    <section class="content-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Lokasi & Kontak</h2>
                <p class="section-subtitle">Hubungi kami untuk informasi lebih lanjut</p>
            </div>
            
            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="contact-title">Lokasi</h3>
                    <p class="contact-text">Bogor, Jawa Barat<br>Indonesia</p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="contact-title">Email</h3>
                    <p class="contact-text"><a href="mailto:jobrescue@gmail.com">jobrescue@gmail.com</a></p>
                </div>
                
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="fab fa-instagram"></i>
                    </div>
                    <h3 class="contact-title">Social Media</h3>
                    <p class="contact-text">
                        <a href="https://instagram.com/jobrescue.bogor" target="_blank">@jobrescue.bogor</a><br>
                        <small style="color:#9ca3af">Instagram & TikTok</small>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Siap Bergabung dengan JobRescue?</h2>
            <p class="cta-subtitle">Mulai perjalanan karir Anda atau temukan talenta terbaik untuk bisnis Anda</p>
            <div class="cta-buttons">
                <a href="{{ route('jobs.index') }}" class="cta-btn">
                    <i class="fas fa-search"></i>
                    Cari Kerja
                </a>
                <a href="{{ route('talents.index') }}" class="cta-btn secondary">
                    <i class="fas fa-users"></i>
                    Cari Talent
                </a>
            </div>
        </div>
    </section>

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
                        <a href="https://instagram.com/jobrescue.bogor" target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-tiktok"></i></a>
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
