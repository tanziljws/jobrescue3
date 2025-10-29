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
        .nav { display: flex; align-items: center; justify-content: space-between; padding: 1rem 2rem; max-width: 1200px; margin: 0 auto; position: relative; }
        .nav-brand { display: flex; align-items: center; gap: 0.5rem; }
        .logo { width: 50px; height: 50px; background: linear-gradient(135deg, #f97316, #ea580c); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.4rem; box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1); transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); position: relative; overflow: hidden; }
        .logo::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent); transition: left 0.6s ease; }
        .logo:hover::before { left: 100%; }
        .logo:hover { transform: scale(1.15) rotate(8deg); box-shadow: 0 15px 40px rgba(249, 115, 22, 0.6), 0 0 0 2px rgba(255, 255, 255, 0.2); }
        .logo img { width: 36px; height: 36px; filter: brightness(0) invert(1); }
        .brand-text { font-size: 1.8rem; font-weight: 800; color: #1f2937; text-shadow: none; letter-spacing: -0.5px; transition: all 0.3s ease; }
        .brand-text:hover { color: #f97316; transform: translateY(-1px); }
        .nav-menu { display: flex; list-style: none; gap: 0.25rem; align-items: center; background: rgba(249, 115, 22, 0.05); backdrop-filter: blur(10px); padding: 0.4rem; border-radius: 50px; border: 1px solid rgba(249, 115, 22, 0.1); margin: 0; }
        .nav-link { text-decoration: none; color: #4b5563; font-weight: 500; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; padding: 0.65rem 1.25rem; border-radius: 25px; font-size: 0.9rem; letter-spacing: 0.2px; }
        .nav-link:hover:not(.active) { color: #f97316; }
        .nav-link.active { color: #ffffff; background: linear-gradient(135deg, #f97316, #ea580c); backdrop-filter: blur(15px); font-weight: 600; pointer-events: none; }
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
        .hero, .talent-hero { background: #667eea; min-height: auto; display: flex; align-items: center; position: relative; overflow: hidden; padding: 4.5rem 0 3.5rem; }
        @media (min-width: 992px) {
          .hero { padding-top: 6rem; padding-bottom: 4rem; }
          .hero .container { max-width: 1280px; }
        }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .hero-content { display: grid; grid-template-columns: 1.2fr 0.8fr; gap: 2.5rem; align-items: start; }
        .hero-title { font-size: 3.5rem; font-weight: 900; color: #ffffff; line-height: 1.1; margin-bottom: 1.5rem; text-shadow: 0 4px 12px rgba(0,0,0,0.25); }
        .hero-subtitle { color: rgba(255,255,255,0.9); max-width: 520px; margin-bottom: 2rem; font-size: 1.2rem; line-height: 1.6; }
        .hero-text { text-align: left; }
        .rocket { display: inline-block; margin-right: .5rem; }
        .title-line { display: block; }
        /* Pill search */
        .search-container { display: flex; gap: .75rem; align-items: center; background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(10px); padding: .6rem; border-radius: 9999px; border: 1px solid rgba(255, 255, 255, 0.2); max-width: 760px; margin: 0; }
        @media (min-width: 992px) { .search-container { max-width: 860px; } }
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

        /* Stat cards in horizontal layout */
        .hero-stats { 
            display: flex; 
            flex-direction: column; 
            gap: 0.75rem; 
            max-width: 100%;
            width: 100%;
        }
        .stat-card { 
            display: flex; 
            align-items: center; 
            gap: 0.75rem; 
            padding: 0.625rem 0.875rem; 
            border-radius: 12px; 
            background: rgba(255,255,255,.95); 
            border: 1px solid rgba(255,255,255,.3); 
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
            backdrop-filter: blur(10px);
            pointer-events: none;
            width: 100%;
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,.1);
        }
        .stat-icon { 
            width: 42px; 
            height: 42px; 
            border-radius: 12px; 
            background: linear-gradient(135deg,#f97316,#ea580c);
            display: flex; 
            align-items: center; 
            justify-content: center; 
            color: #fff; 
            box-shadow: 0 3px 10px rgba(249,115,22,.3);
            flex-shrink: 0;
            font-size: 1.125rem;
        }

        .stat-info {
            display: flex;
            flex-direction: column;
            gap: 0.15rem;
            flex: 1;
        }
        .stat-info h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin: 0;
            line-height: 1.2;
        }
        .stat-info p {
            color: #64748b;
            font-size: 0.8125rem;
            margin: 0;
            line-height: 1.3;
            font-weight: 400;
        }
        .stat-icon { 
            width: 32px; 
            height: 32px; 
            border-radius: 8px; 
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #fff; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            font-size: 0.875rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(249,115,22,0.3);
        }

        @media (max-width: 992px) {
            .hero { padding: 2rem 0; }
            .hero-content { grid-template-columns: 1fr; }
            .hero-text { text-align: center; }
            .search-container { margin: 0 auto; }
            .hero-stats { max-width: 420px; margin: 0 auto; }
        }

        /* Footer (same as welcome) */
        .footer { background: #ffffff; color: #111827; padding: 3rem 0; border-top: 1px solid rgba(0,0,0,0.06); }
        .footer .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .footer-content { display: grid; grid-template-columns: 1.5fr 2fr; gap: 2.5rem; align-items: start; }
        @media (max-width: 992px) { .footer-content { grid-template-columns: 1fr; } }
        .footer-brand .logo { width: 50px; height: 50px; border-radius: 15px; background: linear-gradient(135deg,#f97316,#ea580c); color: #fff; display: inline-flex; align-items: center; justify-content: center; box-shadow: 0 12px 28px rgba(249,115,22,.38); vertical-align: middle; }
        .footer-brand .brand-text { color: #111827; margin-left: 0.75rem; display: inline-block; vertical-align: middle; font-size: 1.8rem; font-weight: 800; }
        .footer-description { color: #6b7280; margin-top: 0.75rem; max-width: 28rem; }
        .footer-links { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1.75rem; align-items: start; }
        @media (max-width: 992px) { .footer-links { grid-template-columns: repeat(2, minmax(0, 1fr)); } }
        @media (max-width: 520px) { .footer-links { grid-template-columns: 1fr; } }
        .footer-title { color: #f97316; font-weight: 800; margin-bottom: 0.75rem; }
        .footer-list { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 0.45rem; }
        .footer-list a { color: #374151; text-decoration: none; transition: color 0.2s ease; }
        .footer-list a:hover { color: #111827; }
        .footer-bottom { margin-top: 2rem; padding-top: 1.25rem; border-top: 1px solid rgba(0,0,0,0.08); display: flex; flex-direction: column; align-items: center; gap: 0.75rem; }
        .footer-social { text-align: center; }
        .footer-social .social-title { color: #1f2937; margin: 0.25rem 0 0.5rem 0; font-weight: 600; }
        .social-links { display: flex; gap: 0.6rem; justify-content: center; }
        .social-link { width: 36px; height: 36px; border-radius: 9999px; background: rgba(0,0,0,0.06); display: flex; align-items: center; justify-content: center; color: #1f2937; transition: transform 0.2s ease, background 0.2s ease, color 0.2s ease; text-decoration: none; }
        .social-link:hover { transform: translateY(-2px); background: rgba(0,0,0,0.12); color: #111827; }
        .footer-legal { color: #6b7280; display: flex; gap: 1rem; align-items: center; flex-wrap: wrap; justify-content: center; }
        .footer-legal a { color: #374151; text-decoration: none; }
        .footer-legal a:hover { color: #111827; text-decoration: underline; }

        /* Spacing fix for fixed header */
        body { margin-top: 90px; background: white; margin: 0; font-family: 'Poppins', sans-serif; }

        /* Lowongan Terbaru section */
        .talent-results { background: #ffffff; padding: 3rem 0; }
        .talent-results .results-title { color: #667eea; }
        .talent-results .results-count { color: #6b7280; }

        /* Stats section (match homepage) */
        .stats,
        .stats-strip {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 5rem 0;
            position: relative;
        }
        
        .stats::before,
        .stats-strip::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(148,163,184,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }
        
        .stats .container,
        .stats-strip .container { 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 0 2rem;
            position: relative;
            z-index: 1;
        }
        
        .stats-grid { 
            display: grid; 
            grid-template-columns: repeat(4, 1fr); 
            gap: 2rem; 
        }
        
        /* Hero stat cards - white background */
        .stat-card {
            background: rgba(255,255,255,.95);
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 16px;
            padding: 0.875rem 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,.08);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,.1);
        }
        
        /* Stats strip - orange transparent */
        .stat-item {
            background: rgba(249,115,22,.12);
            border: 2px solid rgba(249,115,22,.25);
            background-clip: padding-box;
            border-radius: 24px;
            padding: 2.5rem 2rem;
            min-height: 180px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(249,115,22,.1), 
                        0 1px 3px rgba(249,115,22,.05);
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center; 
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f97316, #ea580c, #dc2626);
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        .stat-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(249,115,22,.2),
                        0 5px 15px rgba(249,115,22,.1);
            border-color: rgba(249,115,22,.4);
        }
        
        .stat-item:hover::before {
            opacity: 1;
        }
        
        .stat-number { 
            color: #f97316; 
            font-weight: 900; 
            font-size: 3rem; 
            letter-spacing: -1px; 
            line-height: 1;
            background: linear-gradient(135deg, #f97316, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            filter: drop-shadow(0 2px 4px rgba(249, 115, 22, 0.2));
        }
        
        .stat-label { 
            color: #64748b; 
            font-weight: 600; 
            font-size: 1rem; 
            margin-top: 0.25rem;
            letter-spacing: 0.3px;
        }
        
        .stat-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
        }
        
        @media (max-width: 992px) { 
            .stats-grid { 
                grid-template-columns: 1fr 1fr; 
                gap: 1.5rem;
            } 
        }
        
        @media (max-width: 600px) { 
            .stats-grid { 
                grid-template-columns: 1fr;
                gap: 1.25rem;
            }
            
            .stat-card,
            .stat-item {
                min-height: 160px;
                padding: 2rem 1.5rem;
            }
            
            .stat-number {
                font-size: 2.5rem;
            }
        }

        /* How It Works section -> hero blue */
        .how-it-works { background: #667eea; padding: 6rem 0; }
        .how-it-works .section-title { color: #ffffff; }
        .how-it-works .section-subtitle { color: rgba(255,255,255,0.9); }
        
        .steps-container { 
            display: grid; 
            grid-template-columns: repeat(4, minmax(0,1fr)); 
            gap: 2rem; 
            align-items: stretch; 
            position: relative;
        }
        
        .steps-container::before { content: none; }
        
        .step-item {
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255,255,255,0.22);
            backdrop-filter: blur(6px);
            padding: 2rem 1.75rem;
            border-radius: 20px;
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-height: 280px;
        }
        
        .step-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        }
        
        .step-item:not(:last-child)::after { content: none; }
        
        .step-number {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            color: white;
            box-shadow: 0 8px 20px rgba(249, 115, 22, 0.4);
            margin-bottom: 1.5rem;
            flex-shrink: 0;
        }
        
        .step-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .step-title { 
            font-size: 1.25rem; 
            font-weight: 700; 
            color: #ffffff; 
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }
        
        .step-description { 
            color: rgba(255, 255, 255, 0.9); 
            font-size: 0.95rem; 
            line-height: 1.6;
            max-width: 280px;
        }
        
        .step-icon { 
            margin-top: 1.25rem; 
            font-size: 2.5rem; 
            color: rgba(255, 255, 255, 0.6);
            flex-shrink: 0;
        }
        
        @media (max-width: 768px) {
            .steps-container {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .step-item {
                min-height: auto;
            }
        }
        
        @media (max-width: 992px) {
            .steps-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.25rem;
            }
            
            .step-item {
                padding: 1.75rem 1.5rem;
                min-height: 260px;
            }
            
            .step-number {
                width: 48px;
                height: 48px;
                font-size: 1.3rem;
            }
            
            .step-title {
                font-size: 1.1rem;
            }
            
            .step-description {
                font-size: 0.9rem;
            }
            
            .step-icon {
                font-size: 2rem;
            }
        }

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
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:9999px;display:block;">
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
        <section class="talent-hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            <span class="title-line">Temukan Lowongan</span>
                            <span class="title-line">Kerja Terbaik di</span>
                            <span class="title-line">Bogor untuk Anda</span>
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
                                    <option value="">Semua area Bogor</option>
                                    <option value="bogor-tengah" {{ request('location') == 'bogor-tengah' ? 'selected' : '' }}>Bogor Tengah</option>
                                    <option value="bogor-utara" {{ request('location') == 'bogor-utara' ? 'selected' : '' }}>Bogor Utara</option>
                                    <option value="bogor-selatan" {{ request('location') == 'bogor-selatan' ? 'selected' : '' }}>Bogor Selatan</option>
                                    <option value="bogor-timur" {{ request('location') == 'bogor-timur' ? 'selected' : '' }}>Bogor Timur</option>
                                    <option value="bogor-barat" {{ request('location') == 'bogor-barat' ? 'selected' : '' }}>Bogor Barat</option>
                                    <option value="tanah-sareal" {{ request('location') == 'tanah-sareal' ? 'selected' : '' }}>Tanah Sareal</option>
                                </select>
                            </div>
                            <button type="submit" class="search-button"><i class="fas fa-search"></i> Cari Pekerjaan</button>
                        </form>
                    </div>
                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-briefcase"></i></div>
                            <div class="stat-info"><h3>1,500+</h3><p>Lowongan Tersedia</p></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-building"></i></div>
                            <div class="stat-info"><h3>4.7/5</h3><p>Rating Perusahaan</p></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                            <div class="stat-info"><h3>24 Jam</h3><p>Waktu Pencarian</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter and Results Section -->
        <section class="filter-section">
            </div>
        </section>

        <!-- Statistics -->
        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number" data-target="2100">2,100</div>
                        <div class="stat-label">Pencari Kerja</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-number" data-target="450">450</div>
                        <div class="stat-label">Perusahaan Terdaftar</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="stat-number" data-target="5">5</div>
                        <div class="stat-label">Lowongan Aktif</div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-number" data-target="85">85%</div>
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
                            $count = 0;
                            if (isset($category->job_postings_count)) {
                                $count = (int) $category->job_postings_count;
                            } elseif (isset($category->jobs_count)) {
                                $count = (int) $category->jobs_count;
                            } elseif (isset($category->postings_count)) {
                                $count = (int) $category->postings_count;
                            } elseif (method_exists($category, 'relationLoaded') && $category->relationLoaded('jobs')) {
                                $count = $category->jobs ? $category->jobs->count() : 0;
                            } elseif (property_exists($category, 'jobs') && $category->jobs) {
                                $count = is_countable($category->jobs) ? count($category->jobs) : 0;
                            } elseif (method_exists($category, 'relationLoaded') && $category->relationLoaded('jobPostings')) {
                                $count = $category->jobPostings ? $category->jobPostings->count() : 0;
                            } elseif (property_exists($category, 'jobPostings') && $category->jobPostings) {
                                $count = is_countable($category->jobPostings) ? count($category->jobPostings) : 0;
                            }
                        @endphp
                        @continue($count <= 0)
                        <div class="category-card">
                            <div class="category-icon">
                                <div style="width:56px;height:56px;border-radius:14px;background:linear-gradient(135deg,#667eea,#8b5cf6);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:900;letter-spacing:.5px;box-shadow:0 10px 24px rgba(102,126,234,.35);">
                                    {{ strtoupper(substr($category->name,0,2)) }}
                                </div>
                            </div>
                            <h3 class="category-title">{{ $category->name }}</h3>
                            <p class="category-count">{{ $count }}+ Lowongan</p>
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
                                <div class="talent-avatar" style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,#667eea,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:900;letter-spacing:.5px;box-shadow:0 8px 18px rgba(102,126,234,.28);">
                                    {{ strtoupper(substr($job->category->name ?? 'JB',0,2)) }}
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
                                    <i class="fas fa-calendar"></i>
                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                            
                            <div class="talent-skills">
                                <h4>Kualifikasi:</h4>
                                <div class="skills-list">
                                    @if($job->requirements)
                                        @php
                                            $reqs = is_array($job->requirements)
                                                ? $job->requirements
                                                : explode(',', (string) $job->requirements);
                                        @endphp
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

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div>
                        <div class="logo">
                            <img src="{{ asset('img/icon.svg') }}" alt="Logo JobRescue" style="width:28px;height:28px;filter:brightness(0) invert(1);" />
                        </div>
                        <span class="brand-text">JobRescue</span>
                    </div>
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

            // Stats counter animation
            const statNumbers = document.querySelectorAll('.stat-number[data-target]');
            const animateCounter = (element) => {
                const target = parseInt(element.getAttribute('data-target'));
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;
                
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        element.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        // Final value with proper formatting
                        if (element.parentElement.querySelector('.stat-label').textContent.includes('Keberhasilan')) {
                            element.textContent = target + '%';
                        } else {
                            element.textContent = target.toLocaleString();
                        }
                    }
                };
                updateCounter();
            };

            // Intersection Observer for stats animation
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const statNumber = entry.target;
                        if (!statNumber.classList.contains('animated')) {
                            statNumber.classList.add('animated');
                            animateCounter(statNumber);
                        }
                    }
                });
            }, { threshold: 0.5 });

            // Start observing stats when in view
            statNumbers.forEach(stat => {
                statsObserver.observe(stat);
            });
        });
    </script>
</body>
</html>
