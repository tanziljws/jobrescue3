<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paket Langganan - JobRescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .header { position: fixed; top: 0; left: 0; right: 0; background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0, 0, 0, 0.08); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); z-index: 1000; }
        .nav { display: flex; align-items: center; justify-content: space-between; padding: 1rem 2rem; max-width: 1200px; margin: 0 auto; }
        .nav-brand { display: flex; align-items: center; gap: 0.5rem; }
        .logo { width: 50px; height: 50px; background: linear-gradient(135deg, #f97316, #ea580c); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.4rem; box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4); }
        .brand-text { font-size: 1.8rem; font-weight: 800; color: #1f2937; }
        .nav-menu { display: flex; list-style: none; gap: 0.25rem; align-items: center; background: rgba(249, 115, 22, 0.05); padding: 0.4rem; border-radius: 50px; margin: 0; }
        .nav-link { text-decoration: none; color: #4b5563; font-weight: 500; padding: 0.65rem 1.25rem; border-radius: 25px; font-size: 0.9rem; transition: all 0.3s; }
        .nav-link:hover:not(.active) { color: #f97316; }
        .nav-link.active { color: #ffffff; background: linear-gradient(135deg, #f97316, #ea580c); font-weight: 600; }
        .btn-register { background: linear-gradient(135deg, #f97316, #ea580c); color: white; border: none; padding: 0.8rem 2rem; border-radius: 25px; font-weight: 600; cursor: pointer; text-decoration: none; }
        .btn-register:hover { transform: translateY(-2px); box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4); }
        
        .user-menu { position: relative; }
        .user-avatar { width: 42px; height: 42px; border-radius: 50%; background: linear-gradient(135deg, #f97316, #ea580c); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; cursor: pointer; }
        .user-dropdown { position: absolute; top: calc(100% + 10px); right: 0; background: #fff; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,.12); min-width: 180px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all .3s; z-index: 100; border: 1px solid rgba(0,0,0,.06); }
        .user-menu:hover .user-dropdown { opacity: 1; visibility: visible; transform: translateY(0); }
        .user-dropdown a, .user-dropdown button { display: block; width: 100%; padding: .75rem 1.25rem; text-decoration: none; color: #374151; font-weight: 500; transition: all .2s; border: none; background: none; text-align: left; cursor: pointer; font-size: .9rem; }
        .user-dropdown a:hover, .user-dropdown button:hover { background: #f8fafc; color: #f97316; }
        .user-dropdown button { border-top: 1px solid rgba(0,0,0,.06); border-radius: 0 0 12px 12px; }
        
        .main { margin-top: 90px; }
        .hero { background: #667eea; padding: 6rem 0 4rem; text-align: center; color: white; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .hero h1 { font-size: 3rem; font-weight: 900; margin-bottom: 1rem; }
        .hero p { font-size: 1.2rem; opacity: 0.9; max-width: 600px; margin: 0 auto; }
        
        .pricing-section { padding: 6rem 0; background: #f8fafc; }
        .pricing-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; max-width: 1000px; margin: 0 auto; }
        .pricing-card { background: white; border-radius: 20px; padding: 2rem; box-shadow: 0 10px 40px rgba(0,0,0,0.1); position: relative; transition: all 0.3s; }
        .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 20px 60px rgba(0,0,0,0.15); }
        .pricing-card.popular { border: 3px solid #f97316; transform: scale(1.05); }
        .pricing-card.popular::before { content: 'Popular'; position: absolute; top: -15px; left: 50%; transform: translateX(-50%); background: #f97316; color: white; padding: 0.5rem 2rem; border-radius: 25px; font-weight: 600; font-size: 0.9rem; }
        
        .plan-name { font-size: 1.5rem; font-weight: 700; margin-bottom: 0.5rem; text-align: center; }
        .plan-price { text-align: center; margin-bottom: 2rem; }
        .plan-price .currency { font-size: 1rem; color: #64748b; }
        .plan-price .amount { font-size: 3rem; font-weight: 900; color: #f97316; }
        .plan-price .period { font-size: 1rem; color: #64748b; }
        
        .plan-features { list-style: none; padding: 0; margin: 0 0 2rem 0; }
        .plan-features li { padding: 0.75rem 0; display: flex; align-items: center; gap: 0.75rem; }
        .plan-features li i { color: #10b981; font-size: 1.1rem; }
        
        .plan-button { width: 100%; padding: 1rem 2rem; border-radius: 12px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s; border: none; text-decoration: none; display: inline-block; text-align: center; position: relative; z-index: 10; }
        .plan-button.primary { background: #f97316; color: white; }
        .plan-button.primary:hover { background: #ea580c; transform: translateY(-2px); }
        .plan-button.secondary { background: #f1f5f9; color: #475569; border: 2px solid #e2e8f0; }
        .plan-button.secondary:hover { background: #e2e8f0; }
        
        @media (max-width: 768px) {
            .nav-menu { display: none; }
            .hero h1 { font-size: 2rem; }
            .pricing-card.popular { transform: none; }
        }
    </style>
</head>
<body>
    <header class="header">
        <nav class="nav">
            <div class="nav-brand">
                <div class="logo">
                    <img src="{{ asset('img/icon.svg') }}" alt="JobRescue" style="width:32px;height:32px;filter:brightness(0) invert(1);">
                </div>
                <span class="brand-text">JobRescue</span>
            </div>
            
            <ul class="nav-menu">
                <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
                <li><a href="{{ route('jobs.index') }}" class="nav-link">Cari Kerja</a></li>
                <li><a href="{{ route('talents.index') }}" class="nav-link">Cari Talent</a></li>
                <li><a href="{{ route('about') }}" class="nav-link">Tentang</a></li>
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

    <main class="main">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <section class="pricing-section">
                <div class="container">
                    <div style="max-width:720px;margin:0 auto;background:#ffffff;border:1px solid rgba(0,0,0,.06);border-radius:16px;box-shadow:0 8px 24px rgba(0,0,0,.08);padding:2rem;text-align:center;">
                        <h2 style="font-weight:800;color:#1f2937;margin-bottom:.5rem;">Paket langganan tidak tersedia</h2>
                        <p style="color:#6b7280;margin-bottom:1.25rem;">Akun admin tidak dapat mengakses atau membeli paket langganan.</p>
                        <a href="{{ route('admin.dashboard') }}" style="display:inline-block;background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff;padding:.8rem 1.4rem;border-radius:12px;text-decoration:none;font-weight:600;">Kembali ke Dashboard Admin</a>
                    </div>
                </div>
            </section>
        @else
            <section class="hero">
                <div class="container">
                    <h1>Paket Langganan</h1>
                    <p>Pilih paket yang sesuai dengan kebutuhan Anda</p>
                </div>
            </section>

            <section class="pricing-section">
                <div class="container">
                    <div class="pricing-grid">
                        <!-- Free Plan -->
                        <div class="pricing-card">
                            <h3 class="plan-name">Free</h3>
                            <div class="plan-price">
                                <span class="currency">Rp</span>
                                <span class="amount">0</span>
                                <span class="period">/bulan</span>
                            </div>
                            <ul class="plan-features">
                                <li><i class="fas fa-check"></i> 5 Apply per bulan</li>
                                <li><i class="fas fa-check"></i> Akses job board</li>
                                <li><i class="fas fa-check"></i> Profil dasar</li>
                            </ul>
                            <a href="{{ route('register') }}" class="plan-button secondary">Mulai Gratis</a>
                        </div>

                        <!-- Pro Plan -->
                        <div class="pricing-card popular">
                            <h3 class="plan-name">Pro</h3>
                            <div class="plan-price">
                                <span class="currency">Rp</span>
                                <span class="amount">99.000</span>
                                <span class="period">/bulan</span>
                            </div>
                            <ul class="plan-features">
                                <li><i class="fas fa-check"></i> Unlimited Apply</li>
                                <li><i class="fas fa-check"></i> Prioritas di pencarian</li>
                                <li><i class="fas fa-check"></i> Analytics mendalam</li>
                                <li><i class="fas fa-check"></i> Support 24/7</li>
                            </ul>
                            @guest
                                <a href="{{ route('register') }}?plan=pro" class="plan-button primary">Pilih Pro</a>
                            @else
                                <a href="#" onclick="subscribeToPro()" class="plan-button primary">Pilih Pro</a>
                            @endguest
                        </div>

                        <!-- Enterprise Plan -->
                        <div class="pricing-card">
                            <h3 class="plan-name">Enterprise</h3>
                            <div class="plan-price">
                                <span class="currency">Rp</span>
                                <span class="amount">299.000</span>
                                <span class="period">/bulan</span>
                            </div>
                            <ul class="plan-features">
                                <li><i class="fas fa-check"></i> Semua fitur Pro</li>
                                <li><i class="fas fa-check"></i> Team management</li>
                                <li><i class="fas fa-check"></i> Custom branding</li>
                                <li><i class="fas fa-check"></i> API access</li>
                            </ul>
                            @guest
                                <a href="{{ route('register') }}?plan=enterprise" class="plan-button primary">Hubungi Sales</a>
                            @else
                                <a href="#" onclick="contactSales()" class="plan-button primary">Hubungi Sales</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>

    <script>
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        
        function subscribeToPro() {
            console.log('subscribeToPro clicked, authenticated:', isAuthenticated);
            if (isAuthenticated) {
                alert('Fitur berlangganan Pro akan segera tersedia! Tim kami sedang mempersiapkan sistem pembayaran yang aman untuk Anda.');
            } else {
                window.location.href = '{{ route("register") }}?plan=pro';
            }
        }

        function contactSales() {
            console.log('contactSales clicked, authenticated:', isAuthenticated);
            if (isAuthenticated) {
                alert('Tim sales kami akan segera menghubungi Anda untuk paket Enterprise. Terima kasih atas minat Anda!');
            } else {
                window.location.href = '{{ route("register") }}?plan=enterprise';
            }
        }

        // Ensure DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, isAuthenticated:', isAuthenticated);
            
            // Add click event listeners as backup
            const proButtons = document.querySelectorAll('[onclick*="subscribeToPro"]');
            const salesButtons = document.querySelectorAll('[onclick*="contactSales"]');
            
            proButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    subscribeToPro();
                });
            });
            
            salesButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    contactSales();
                });
            });
        });
    </script>
</body>
</html>
