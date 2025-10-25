<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Rescue - Temukan Pekerjaan Mikro & UMKM di Kota Bogor</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    <meta name="description" content="Platform terpercaya untuk mencari dan menawarkan pekerjaan mikro dan UMKM di Kota Bogor. Hubungkan pekerja dengan pemberi kerja secara mudah dan aman.">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(248, 250, 252, 0.95) 100%);
            z-index: -1;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.4rem;
            box-shadow: 0 10px 30px rgba(249, 115, 22, 0.4), 
                        0 0 0 1px rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .logo::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
        }

        .logo:hover::before {
            left: 100%;
        }

        .logo:hover {
            transform: scale(1.15) rotate(8deg);
            box-shadow: 0 15px 40px rgba(249, 115, 22, 0.6),
                        0 0 0 2px rgba(255, 255, 255, 0.2);
        }

        .logo img {
            width: 36px;
            height: 36px;
            filter: brightness(0) invert(1);
        }

        .brand-text {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1f2937;
            text-shadow: none;
            letter-spacing: -0.5px;
            transition: all 0.3s ease;
        }

        .brand-text:hover {
            color: #f97316;
            transform: translateY(-1px);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 0.25rem;
            align-items: center;
            background: rgba(249, 115, 22, 0.05);
            backdrop-filter: blur(10px);
            padding: 0.4rem;
            border-radius: 50px;
            border: 1px solid rgba(249, 115, 22, 0.1);
            margin: 0;
        }

        .nav-link {
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            padding: 0.65rem 1.25rem;
            border-radius: 25px;
            font-size: 0.9rem;
            letter-spacing: 0.2px;
        }

        .nav-link:hover:not(.active) {
            color: #f97316;
        }

        .nav-link.active {
            color: #ffffff;
            background: linear-gradient(135deg, #f97316, #ea580c);
            backdrop-filter: blur(15px);
            font-weight: 600;
            pointer-events: none;
        }

        .btn-register {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            border: none;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4);
            background: linear-gradient(135deg, #ea580c, #dc2626);
        }

        .hamburger {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 4px;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #4b5563;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }
            .hamburger {
                display: flex;
            }
        }

        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #667eea;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading-content {
            text-align: center;
            color: white;
        }

        .loading-logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .logo-spinner {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-spinner img {
            width: 40px;
            height: auto;
            animation: spin 2s linear infinite;
            filter: brightness(0) invert(1);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            font-size: 2rem;
            font-weight: 700;
        }

        .loading-bar {
            width: 300px;
            height: 4px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 2px;
            overflow: hidden;
            margin: 0 auto 1rem;
        }

        .loading-progress {
            height: 100%;
            background: linear-gradient(90deg, #f97316, #ea580c);
            border-radius: 2px;
            width: 0%;
            transition: width 0.3s ease;
        }

        .loading-message {
            font-size: 1rem;
            opacity: 0.8;
        }

        /* Particle Background */
        .particles-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Hero Section Styles */
        .hero {
            background: #667eea;
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            line-height: 1.1;
            margin-bottom: 2rem;
        }

        .title-line {
            display: block;
        }

        .rocket {
            display: inline-block;
            font-size: 3rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        .btn-primary {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 25px rgba(249, 115, 22, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4);
        }

        .search-container {
            display: flex;
            gap: 1rem;
            align-items: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-box, .location-box {
            flex: 1;
            position: relative;
        }

        .search-input, .location-select {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            outline: none;
        }

        .search-icon, .location-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            z-index: 2;
        }

        .search-button {
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.35);
            width: 44px;
            height: 44px;
            padding: 0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 8px 24px rgba(249, 115, 22, 0.35);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .search-button:hover {
            transform: translateY(-1px) scale(1.03);
            box-shadow: 0 12px 32px rgba(249, 115, 22, 0.45);
        }

        .hero-illustration {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .illustration-container {
            position: relative;
            width: 580px;
            height: 580px;
            background: transparent;
            border-radius: 20px;
            backdrop-filter: none;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Person Illustration */
        .person {
            position: relative;
            z-index: 2;
        }

        .head {
            width: 80px;
            height: 80px;
            background: #fbbf24;
            border-radius: 50%;
            position: relative;
            margin: 0 auto 10px;
        }

        .face {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        .eyes {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .eye {
            width: 8px;
            height: 8px;
            background: #1f2937;
            border-radius: 50%;
        }

        .smile {
            width: 20px;
            height: 10px;
            border: 2px solid #1f2937;
            border-top: none;
            border-radius: 0 0 20px 20px;
            margin: 0 auto;
        }

        .hair {
            position: absolute;
            top: -10px;
            left: 10px;
            right: 10px;
            height: 30px;
            background: #92400e;
            border-radius: 30px 30px 0 0;
        }

        .body {
            width: 60px;
            height: 80px;
            margin: 0 auto;
            position: relative;
        }

        .shirt {
            width: 100%;
            height: 60px;
            background: #3b82f6;
            border-radius: 10px 10px 0 0;
        }

        .laptop {
            width: 100px;
            height: 60px;
            background: #374151;
            border-radius: 8px;
            margin: 20px auto 0;
            position: relative;
        }

        .screen {
            width: 80px;
            height: 45px;
            background: #1f2937;
            border-radius: 4px;
            margin: 5px auto;
            position: relative;
        }

        .screen::after {
            content: '';
            position: absolute;
            top: 10px;
            left: 10px;
            right: 10px;
            bottom: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 2px;
        }

        .keyboard {
            width: 90px;
            height: 8px;
            background: #6b7280;
            border-radius: 2px;
            margin: 2px auto;
        }

        /* Background Elements */
        .background-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }

        .building {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 4px 4px 0 0;
        }

        .building-1 {
            width: 40px;
            height: 100px;
            bottom: 0;
            left: 20px;
        }

        .building-2 {
            width: 30px;
            height: 80px;
            bottom: 0;
            left: 70px;
        }

        .building-3 {
            width: 35px;
            height: 120px;
            bottom: 0;
            right: 30px;
        }

        .cloud {
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50px;
            animation: float 6s ease-in-out infinite;
        }

        .cloud-1 {
            width: 60px;
            height: 30px;
            top: 40px;
            left: 50px;
            animation-delay: 0s;
        }

        .cloud-2 {
            width: 80px;
            height: 40px;
            top: 60px;
            right: 40px;
            animation-delay: 2s;
        }

        /* How It Works Section */
        .how-it-works {
            padding: 6rem 0;
            background: #667eea; /* match hero */
        }
        .how-it-works .section-title { color: #ffffff; }
        .how-it-works .section-subtitle { color: rgba(255,255,255,0.9); }

        .steps-container {
            display: grid;
            grid-template-columns: repeat(3, minmax(0,1fr));
            gap: 2rem;
            align-items: stretch;
            position: relative;
        }

        /* remove connectors */
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

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content {
                grid-template-columns: 1fr;
                gap: 2rem;
                text-align: center;
            }
            
            .hero-title {
                font-size: 2.5rem;
            }
            
            .search-container {
                flex-direction: column;
                gap: 0.5rem;
            }

            .illustration-container {
                width: 300px;
                height: 300px;
            }

            .section-title {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

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

        /* Features Section (reverted) */
        .features-section {
            padding: 5rem 0;
            background: white;
        }

        .features-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.25rem;
            color: #6b7280;
            max-width: 48rem;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            text-align: center;
            padding: 2rem;
            border-radius: 1rem;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            transition: all 0.3s ease;
            border: 1px solid #e0f2fe;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .feature-card:nth-child(2) {
            background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
            border-color: #fed7aa;
        }

        .feature-card:nth-child(3) {
            background: linear-gradient(135deg, #f0fdf4 0%, #bbf7d0 100%);
            border-color: #bbf7d0;
        }

        .feature-icon {
            width: 4rem;
            height: 4rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .feature-card:nth-child(1) .feature-icon { background: #3b82f6; }
        .feature-card:nth-child(2) .feature-icon { background: #f97316; }
        .feature-card:nth-child(3) .feature-icon { background: #10b981; }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 1rem;
        }

        .feature-description { color: #6b7280; line-height: 1.6; }

        /* Features section: match hero background and readable headers */
        .features {
            background: #667eea;
            padding: 5rem 0;
        }
        .features .section-title { color: #ffffff; }
        .features .section-subtitle { color: rgba(255, 255, 255, 0.9); }

        /* Stats Strip Section */
        .stats-strip,
        .stats {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            padding: 5rem 0;
            position: relative;
        }
        
        .stats-strip::before,
        .stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><defs><pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse"><path d="M 100 0 L 0 0 0 100" fill="none" stroke="rgba(148,163,184,0.1)" stroke-width="1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }
        
        .stats-strip .container,
        .stats .container { 
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
        
        .stat-card,
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
        
        .stat-card::before,
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
        
        .stat-card:hover,
        .stat-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 50px rgba(249,115,22,.2),
                        0 5px 15px rgba(249,115,22,.1);
            border-color: rgba(249,115,22,.4);
        }
        
        .stat-card:hover::before,
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

        /* Categories Section (reverted) */
        .categories-section { background: #f8fafc; padding: 4rem 0; }
        .categories-container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; }
        .categories-header { text-align: center; margin-bottom: 2rem; }
        .categories-title { font-size: 2.25rem; font-weight: 800; color: #2563eb; }
        .categories-subtitle { color: #64748b; margin-top: .5rem; }
        .categories-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
        .category-card { background: #ffe9d6; border: 1px solid rgba(249,115,22,0.25); border-radius: 22px; padding: 1.75rem; box-shadow: 0 8px 18px rgba(0,0,0,0.06); cursor: pointer; transition: all .3s ease; text-decoration: none; display: block; }
        .category-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px rgba(249,115,22,0.2); border-color: rgba(249,115,22,0.4); }
        .category-head { display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.6rem; margin-bottom: 1rem; text-align: center; }
        .category-icon { width: 56px; height: 56px; border-radius: 16px; background: linear-gradient(135deg,#3b82f6,#1d4ed8); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 1.4rem; box-shadow: 0 8px 24px rgba(59,130,246,.35); }
        .category-title { font-weight: 700; color: #0f172a; font-size: 1.15rem; text-align: center; }
        .category-badge { margin-left: 0; margin-top: 0.25rem; background: #fff3ea; color: #e6570b; font-weight: 700; font-size: .85rem; padding: .35rem .6rem; border-radius: 9999px; border: 1px solid rgba(230,87,11,.35); }
        .category-tags { display: flex; flex-wrap: wrap; gap: .5rem; justify-content: center; }
        .category-tag { background: #f97316; color: #fff; font-weight: 600; padding: .35rem .7rem; border-radius: 9999px; font-size: .8rem; box-shadow: 0 6px 16px rgba(249,115,22,.25); }
        @media (max-width: 992px) { .categories-grid { grid-template-columns: 1fr 1fr; } }
        @media (max-width: 600px) { .categories-grid { grid-template-columns: 1fr; } }

        /* Pricing Section */
        .pricing {
            padding: 6rem 0;
            background: #ffffff;
            border-top: 1px solid rgba(0,0,0,0.06);
            border-bottom: 1px solid rgba(0,0,0,0.06);
        }
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            align-items: stretch;
        }
        @media (max-width: 992px) { .pricing-grid { grid-template-columns: 1fr; } }

        .pricing-card {
            background: #ffffff;
            border: 1px solid rgba(0,0,0,0.08);
            border-radius: 22px;
            padding: 2.25rem;
            box-shadow: 0 12px 30px rgba(0,0,0,0.06);
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
            min-height: 440px;
        }
        .pricing-card.featured {
            border: 2px solid rgba(249,115,22,0.45);
            box-shadow: 0 20px 50px rgba(249,115,22,0.18);
            transform: scale(1.03);
        }
        .popular-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #fff;
            font-weight: 700;
            padding: .4rem .9rem;
            border-radius: 9999px;
            box-shadow: 0 10px 25px rgba(249,115,22,0.35);
        }
        .pricing-header { text-align: center; }
        .plan-name { font-size: 1.25rem; font-weight: 800; color: #111827; }
        .plan-price { display: flex; align-items: baseline; justify-content: center; gap: .35rem; margin-top: .35rem; }
        .plan-price .currency { color: #6b7280; font-weight: 600; }
        .plan-price .amount { color: #ea580c; font-weight: 900; font-size: 2.5rem; letter-spacing: .3px; }
        .plan-price .period { color: #6b7280; }

        /* Emphasize featured plan amount size */
        .pricing-card.featured .plan-price .amount { font-size: 3rem; }

        .plan-features { display: flex; flex-direction: column; gap: 1rem; }
        .plan-features .feature-item { display: flex; align-items: center; gap: .6rem; color: #374151; line-height: 1.6; padding: .15rem 0; }
        .plan-features .feature-item i { color: #10b981; }

        .plan-button {
            margin-top: auto;
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #ffffff;
            border: none;
            padding: .9rem 1.4rem;
            border-radius: 9999px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 12px 30px rgba(249,115,22,0.28);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .plan-button:hover { transform: translateY(-2px); box-shadow: 0 16px 36px rgba(249,115,22,0.35); }

        /* FAQ Section */
        .faq {
            padding: 6rem 0;
            background: #667eea; /* match hero */
        }
        .faq .section-title { color: #ffffff; }
        .faq .section-subtitle { color: rgba(255,255,255,0.9); }
        .faq-container { display: flex; flex-direction: column; gap: 1rem; max-width: 900px; margin: 0 auto; }
        .faq-item { background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); border-radius: 18px; overflow: hidden; backdrop-filter: blur(6px); }
        .faq-question { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: 1.25rem 1.5rem; cursor: pointer; color: #ffffff; font-weight: 700; }
        .faq-question i { color: #ffffff; transition: transform .25s ease; }
        .faq-answer { color: rgba(255,255,255,0.95); padding: 0 1.5rem; max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s ease; }
        .faq-item.active .faq-answer { padding: 0 1.5rem 1.25rem; max-height: 300px; }
        .faq-item.active .faq-question i { transform: rotate(180deg); }

        /* Testimonials Section */
        .testimonials { padding: 6rem 0; background: #f8fafc; }
        .testimonials .section-title { color: #2563eb; }
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
        }
        @media (max-width: 992px) { .testimonials-grid { grid-template-columns: 1fr; } }

        .testimonial-card {
            background: #ffedd5; /* peach tint like screenshot */
            border: 1px solid rgba(249,115,22,0.25);
            border-radius: 22px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.06);
            padding: 1.75rem;
        }
        .testimonial-content { color: #374151; margin-bottom: 1.25rem; }
        .testimonial-content .stars { color: #f59e0b; margin-bottom: .75rem; }
        .testimonial-content p { font-style: italic; color: #374151; }

        .testimonial-author { display: flex; align-items: center; gap: .9rem; }
        .author-avatar {
            width: 42px; height: 42px; border-radius: 9999px;
            background: linear-gradient(135deg, #f97316, #ea580c);
            color: #fff; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 22px rgba(249,115,22,0.35);
        }
        .author-info h4 { margin: 0; font-weight: 800; color: #111827; }
        .author-info span { display: block; color: #6b7280; font-size: .9rem; }

        /* Newsletter Section */
        .newsletter { padding: 4rem 0; background: #667eea; }
        .newsletter-title { color: #ffffff; }
        .newsletter-subtitle { color: rgba(255,255,255,0.92); }
        .newsletter-content { display: flex; align-items: center; justify-content: space-between; gap: 2rem; }
        @media (max-width: 992px) { .newsletter-content { flex-direction: column; align-items: stretch; } }

        .newsletter-form { background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); border-radius: 18px; padding: 1.25rem 1.5rem; box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
        .newsletter-form .form-group { display: flex; align-items: center; gap: .75rem; }
        .newsletter-input { flex: 1; height: 46px; border-radius: 9999px; border: none; padding: 0 1rem; background: #ffffff; color: #111827; }
        .newsletter-input::placeholder { color: #9ca3af; }
        .newsletter-button { height: 46px; padding: 0 1rem; border: none; border-radius: 9999px; background: linear-gradient(135deg, #f97316, #ea580c); color: #ffffff; font-weight: 700; display: inline-flex; align-items: center; gap: .45rem; cursor: pointer; box-shadow: 0 10px 25px rgba(249,115,22,0.35); }
        .newsletter-button:hover { transform: translateY(-1px); box-shadow: 0 14px 32px rgba(249,115,22,0.42); }
        .newsletter-privacy { margin-top: .6rem; color: rgba(255,255,255,0.9); }
        .newsletter-privacy a { color: #f59e0b; text-decoration: none; font-weight: 700; }
        .newsletter-privacy a:hover { text-decoration: underline; }

        /* CTA Section */
        .cta-section { background: #ffffff; padding: 4rem 0; border-top: 1px solid rgba(0,0,0,0.06); border-bottom: 1px solid rgba(0,0,0,0.06); }
        .cta-title { color: #2563eb; }
        .cta-section .cta-subtitle { color: #111827; }

        /* CTA Buttons to blue */
        .cta-buttons { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
        .cta-btn {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #ffffff;
            border: none;
            padding: 0.9rem 1.4rem;
            border-radius: 9999px;
            font-weight: 700;
            box-shadow: 0 12px 30px rgba(59,130,246,0.28);
            display: inline-flex; align-items: center; gap: .5rem;
            transition: transform .2s ease, box-shadow .2s ease;
            text-decoration: none;
        }
        .cta-btn i { color: #ffffff; }
        .cta-btn:hover {
            transform: translateY(-2px);
            background: #ffffff; /* turn white on hover */
            color: #f97316;
            border: 2px solid #f97316; /* orange outline */
            box-shadow: 0 16px 36px rgba(249,115,22,0.25);
        }
        .cta-btn:hover i { color: #f97316; }
        .cta-btn.secondary { background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #ffffff; }

        /* Contact Section */
        .contact { background: #667eea; padding: 5rem 0; }
        .contact .section-title { color: #ffffff; }
        .contact .section-subtitle { color: rgba(255,255,255,0.9); }
        .contact-content { display: grid; grid-template-columns: 1fr 1.1fr; gap: 2rem; align-items: start; }
        @media (max-width: 992px) { .contact-content { grid-template-columns: 1fr; } }

        .contact-info { display: flex; flex-direction: column; gap: 1rem; }
        .contact-item { background: #ffffff; border: 1px solid rgba(0,0,0,0.06); border-radius: 18px; padding: 1.5rem 1.25rem; display: flex; gap: 1rem; align-items: center; box-shadow: 0 10px 24px rgba(0,0,0,0.08); }
        .contact-icon { width: 44px; height: 44px; border-radius: 9999px; background: linear-gradient(135deg, #f97316, #ea580c); color: #ffffff; display: flex; align-items: center; justify-content: center; box-shadow: 0 10px 24px rgba(249,115,22,0.35); }
        .contact-details h3 { margin: 0; font-weight: 800; color: #111827; font-size: 1.35rem; }
        .contact-details p { margin: 0; color: #6b7280; font-size: 1.05rem; }

        .contact-form { background: rgba(255,255,255,0.9); backdrop-filter: blur(6px); border: 1px solid rgba(255,255,255,0.7); border-radius: 18px; padding: 1.5rem; box-shadow: 0 12px 28px rgba(0,0,0,0.08); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
        .form-group { width: 100%; }
        .form-input, .form-textarea { width: 100%; background: #ffffff; border: 1px solid rgba(0,0,0,0.08); border-radius: 14px; padding: 1rem 1.1rem; outline: none; color: #111827; font-size: 1rem; }
        .form-textarea { min-height: 160px; }
        .form-input::placeholder, .form-textarea::placeholder { color: #9ca3af; }
        .form-button { margin-top: 1rem; background: linear-gradient(135deg, #3b82f6, #1d4ed8); color: #ffffff; border: none; padding: 1rem 1.2rem; border-radius: 14px; font-weight: 700; display: block; width: 100%; text-align: center; cursor: pointer; box-shadow: 0 12px 30px rgba(59,130,246,0.28); }
        .form-button:hover { transform: translateY(-1px); background: #ffffff; color: #2563eb; border: 2px solid #2563eb; box-shadow: 0 16px 36px rgba(37,99,235,0.25); }

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

        * { box-sizing: border-box; }
    </style>
</head>
<body>
    <!-- Loading Screen -->
    <div class="loading-screen" id="loadingScreen">
        <div class="loading-content">
            <div class="loading-logo">
                <div class="logo-spinner">
                    <img src="{{ asset('img/icon.svg') }}" alt="Logo JobRescue" class="loading-logo-img">
                </div>
                <span class="loading-text">JobRescue</span>
            </div>
            <div class="loading-bar">
                <div class="loading-progress"></div>
            </div>
            <p class="loading-message">Memuat pengalaman terbaik...</p>
        </div>
    </div>

    <!-- Particle Background -->
    <div class="particles-container" id="particles"></div>

    <!-- Main Content -->
    <div id="main-content" class="hidden">
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
                    <li><a href="#" class="nav-link active">Beranda</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="nav-link">Cari Kerja</a></li>
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
                    <div class="user-menu" style="position:relative;">
                        <div class="user-avatar" style="width:36px;height:36px;border-radius:9999px;background:#f97316;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;cursor:pointer;overflow:hidden;">
                            @if(Auth::user()->profile_photo)
                                <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:9999px;display:block;">
                            @else
                                {{ strtoupper(substr(Auth::user()->name,0,1)) }}
                            @endif
                        </div>
                        <div class="user-dropdown" style="display:none;position:absolute;right:0;top:44px;background:#ffffff;border:1px solid rgba(0,0,0,0.08);border-radius:12px;box-shadow:0 12px 28px rgba(0,0,0,0.12);min-width:160px;z-index:1001;">
                            <div style="padding:.5rem 0;">
                                @if(Auth::user()->role === 'worker')
                                    <a href="{{ route('worker.dashboard') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Dashboard</a>
                                    <a href="{{ route('worker.profile') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Profil</a>
                                    <a href="{{ route('worker.jobs') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Cari Pekerjaan</a>
                                    <a href="{{ route('worker.history') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Riwayat</a>
                                    <a href="{{ route('worker.chat') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Chat</a>
                                    <a href="{{ route('worker.settings') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Pengaturan</a>
                                @elseif(Auth::user()->role === 'employer')
                                    <a href="{{ route('employer.dashboard') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Dashboard</a>
                                @elseif(Auth::user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Dashboard</a>
                                @endif
                                @if(Auth::user()->role === 'employer')
                                    <a href="{{ route('employer.jobs.create') }}" style="display:block;padding:.5rem 1rem;color:#111827;text-decoration:none;">Buat Lowongan</a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                    @csrf
                                    <button type="submit" style="width:100%;text-align:left;background:none;border:none;padding:.5rem 1rem;color:#111827;cursor:pointer;">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function(){
                            const avatar = document.querySelector('.user-menu .user-avatar');
                            const dropdown = document.querySelector('.user-menu .user-dropdown');
                            if(avatar && dropdown){
                                avatar.addEventListener('click', ()=>{
                                    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
                                });
                                document.addEventListener('click', (e)=>{
                                    if(!e.target.closest('.user-menu')) dropdown.style.display='none';
                                });
                            }
                        });
                    </script>
                @endguest
                
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title">
                            <span class="title-line">Temukan Pekerjaan</span>
                            <span class="title-line">Mikro & UMKM</span>
                            <span class="title-line">di Kota Bogor</span>
                            <span class="rocket">🚀</span>
                        </h1>
                        
                        <button class="btn-primary" onclick="window.location.href='{{ route('jobs.index') }}'">
                            Cari Kerja Sekarang
                            <i class="fas fa-arrow-right"></i>
                        </button>
                        
                        <div class="search-container">
                            <div class="search-box">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" placeholder="Masukkan skill atau kata kunci" class="search-input" id="heroSearchInput">
                            </div>
                            <div class="location-box">
                                <i class="fas fa-map-marker-alt location-icon"></i>
                                <select class="location-select" id="heroLocationSelect">
                                    <option value="">Pilih area di Bogor</option>
                                    <option value="bogor-tengah">Bogor Tengah</option>
                                    <option value="bogor-utara">Bogor Utara</option>
                                    <option value="bogor-selatan">Bogor Selatan</option>
                                    <option value="bogor-timur">Bogor Timur</option>
                                    <option value="bogor-barat">Bogor Barat</option>
                                    <option value="tanah-sareal">Tanah Sareal</option>
                                </select>
                            </div>
                            <button class="search-button" onclick="performHeroSearch()">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="hero-illustration">
                        <div class="illustration-container">
                            <img src="{{ asset('img/JOB.svg') }}" alt="JobRescue Illustration" style="max-width: 100%; height: auto; display: block;" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats">
            <div class="container">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="stat-number" data-target="1250">1,250</div>
                        <div class="stat-label">Pekerjaan di Bogor</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="stat-number" data-target="350">350</div>
                        <div class="stat-label">UMKM Bogor</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-number" data-target="2100">2,100</div>
                        <div class="stat-label">Talent Bogor</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-number" data-target="98">98%</div>
                        <div class="stat-label">Kepuasan</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="features-container">
                <div class="section-header">
                    <h2 class="section-title">Mengapa Memilih JobRescue?</h2>
                    <p class="section-subtitle">Platform yang dirancang khusus untuk ekosistem kerja mikro dan UMKM di Kota Bogor</p>
                </div>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <span>🎯</span>
                        </div>
                        <h3 class="feature-title">Fokus Lokal Bogor</h3>
                        <p class="feature-description">Khusus melayani area Kota Bogor dengan pemahaman mendalam tentang kebutuhan lokal</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <span>🛡️</span>
                        </div>
                        <h3 class="feature-title">Aman & Terpercaya</h3>
                        <p class="feature-description">Sistem verifikasi pengguna dan perlindungan transaksi untuk keamanan maksimal</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <span>⚡</span>
                        </div>
                        <h3 class="feature-title">Proses Cepat</h3>
                        <p class="feature-description">Matching otomatis dan proses aplikasi yang efisien untuk hasil maksimal</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Job Categories Section -->
        <section class="job-categories">
            <div class="categories-container">
                <div class="categories-header">
                    <h2 class="categories-title">Kategori Pekerjaan Populer</h2>
                    <p class="categories-subtitle">Temukan pekerjaan sesuai dengan keahlian dan minat Anda</p>
                </div>
                <div class="categories-grid">
                    <a href="{{ route('jobs.index', ['category' => 1]) }}" class="category-card">
                        <div class="category-head">
                            <div class="category-icon"><i class="fas fa-store"></i></div>
                            <div class="category-title">Retail & Toko</div>
                            <div class="category-badge">320+ Jobs</div>
                        </div>
                        <div class="category-tags">
                            <span class="category-tag">Kasir</span>
                            <span class="category-tag">Penjualan</span>
                            <span class="category-tag">Inventori</span>
                        </div>
                    </a>
                    <a href="{{ route('jobs.index', ['category' => 2]) }}" class="category-card">
                        <div class="category-head">
                            <div class="category-icon"><i class="fas fa-utensils"></i></div>
                            <div class="category-title">Kuliner Bogor</div>
                            <div class="category-badge">280+ Jobs</div>
                        </div>
                        <div class="category-tags">
                            <span class="category-tag">Koki</span>
                            <span class="category-tag">Pelayan</span>
                            <span class="category-tag">Pengantar</span>
                        </div>
                    </a>
                    <a href="{{ route('jobs.index', ['category' => 3]) }}" class="category-card">
                        <div class="category-head">
                            <div class="category-icon"><i class="fas fa-graduation-cap"></i></div>
                            <div class="category-title">Pendidikan</div>
                            <div class="category-badge">250+ Jobs</div>
                        </div>
                        <div class="category-tags">
                            <span class="category-tag">Guru Les</span>
                            <span class="category-tag">Tutor</span>
                            <span class="category-tag">Administrasi</span>
                        </div>
                    </a>
                    <a href="{{ route('jobs.index', ['category' => 4]) }}" class="category-card">
                        <div class="category-head">
                            <div class="category-icon"><i class="fas fa-motorcycle"></i></div>
                            <div class="category-title">Transportasi & Kurir</div>
                            <div class="category-badge">200+ Jobs</div>
                        </div>
                        <div class="category-tags">
                            <span class="category-tag">Driver</span>
                            <span class="category-tag">Ojek Online</span>
                            <span class="category-tag">Kurir</span>
                        </div>
                    </a>
                    <a href="{{ route('jobs.index', ['category' => 5]) }}" class="category-card">
                        <div class="category-head">
                            <div class="category-icon"><i class="fas fa-building"></i></div>
                            <div class="category-title">Properti</div>
                            <div class="category-badge">180+ Jobs</div>
                        </div>
                        <div class="category-tags">
                            <span class="category-tag">Agen</span>
                            <span class="category-tag">Pemasaran</span>
                            <span class="category-tag">Surveyor</span>
                        </div>
                    </a>
                    <a href="{{ route('jobs.index', ['category' => 6]) }}" class="category-card">
                        <div class="category-head">
                            <div class="category-icon"><i class="fas fa-code"></i></div>
                            <div class="category-title">IT & Digital</div>
                            <div class="category-badge">150+ Jobs</div>
                        </div>
                        <div class="category-tags">
                            <span class="category-tag">Pengembang Web</span>
                            <span class="category-tag">Desain</span>
                            <span class="category-tag">Pemasaran Digital</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="how-it-works">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Cara Kerja JobRescue</h2>
                    <p class="section-subtitle">Proses sederhana untuk mendapatkan pekerjaan impian Anda</p>
                </div>
                <div class="steps-container">
                    <div class="step-item">
                        <div class="step-number">1</div>
                        <div class="step-content">
                            <h3 class="step-title">Daftar & Buat Profil</h3>
                            <p class="step-description">Buat akun dan lengkapi profil dengan skill dan pengalaman Anda</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">2</div>
                        <div class="step-content">
                            <h3 class="step-title">Cari & Apply Pekerjaan</h3>
                            <p class="step-description">Jelajahi ribuan lowongan kerja dan apply sesuai keahlian</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                    
                    <div class="step-item">
                        <div class="step-number">3</div>
                        <div class="step-content">
                            <h3 class="step-title">Terima & Mulai Kerja</h3>
                            <p class="step-description">Dapatkan konfirmasi dan mulai bekerja dengan klien terpercaya</p>
                        </div>
                        <div class="step-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing Plans Section -->
        <section class="pricing">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Paket Langganan</h2>
                    <p class="section-subtitle">Pilih paket yang sesuai dengan kebutuhan Anda</p>
                </div>
                <div class="pricing-grid">
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3 class="plan-name">Free</h3>
                            <div class="plan-price">
                                <span class="currency">Rp</span>
                                <span class="amount">0</span>
                                <span class="period">/bulan</span>
                            </div>
                        </div>
                        <div class="plan-features">
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>5 Apply per bulan</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Akses job board</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Profil dasar</span>
                            </div>
                        </div>
                        <button class="plan-button" onclick="redirectToRegister()">Mulai Gratis</button>
                    </div>
                    
                    <div class="pricing-card featured">
                        <div class="popular-badge">Populer</div>
                        <div class="pricing-header">
                            <h3 class="plan-name">Pro</h3>
                            <div class="plan-price">
                                <span class="currency">Rp</span>
                                <span class="amount">99.000</span>
                                <span class="period">/bulan</span>
                            </div>
                        </div>
                        <div class="plan-features">
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Unlimited Apply</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Prioritas di pencarian</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Analytics mendalam</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Support 24/7</span>
                            </div>
                        </div>
                        <button class="plan-button" onclick="redirectToPricing()">Pilih Pro</button>
                    </div>
                    
                    <div class="pricing-card">
                        <div class="pricing-header">
                            <h3 class="plan-name">Enterprise</h3>
                            <div class="plan-price">
                                <span class="currency">Rp</span>
                                <span class="amount">299.000</span>
                                <span class="period">/bulan</span>
                            </div>
                        </div>
                        <div class="plan-features">
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Semua fitur Pro</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Team management</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>Custom branding</span>
                            </div>
                            <div class="feature-item">
                                <i class="fas fa-check"></i>
                                <span>API access</span>
                            </div>
                        </div>
                        <button class="plan-button" onclick="redirectToPricing()">Hubungi Sales</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="faq">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                    <p class="section-subtitle">Temukan jawaban untuk pertanyaan umum tentang JobRescue</p>
                </div>
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Bagaimana cara mendaftar di JobRescue?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Daftar sangat mudah! Klik tombol "Daftar" di pojok kanan atas, isi informasi dasar Anda, verifikasi email, dan lengkapi profil dengan skill dan pengalaman kerja Anda.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Apakah JobRescue benar-benar gratis?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Ya, JobRescue menawarkan paket gratis dengan 5 apply per bulan. Untuk fitur lebih lengkap, kami menyediakan paket Pro dan Enterprise dengan harga terjangkau.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Bagaimana sistem pembayaran bekerja?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>JobRescue menggunakan sistem escrow yang aman. Pembayaran akan ditahan hingga pekerjaan selesai dan disetujui oleh klien. Kami mendukung berbagai metode pembayaran termasuk bank transfer dan e-wallet.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Bagaimana jika ada masalah dengan klien?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Tim support kami siap membantu 24/7. Jika ada masalah, Anda bisa menghubungi customer service melalui chat, email, atau telepon. Kami akan mediasi dan mencari solusi terbaik.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <h3>Apakah ada jaminan keamanan data?</h3>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Keamanan data adalah prioritas utama kami. Semua data dilindungi dengan enkripsi SSL dan kami mengikuti standar keamanan internasional. Data pribadi Anda tidak akan dibagikan ke pihak ketiga.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials Section -->
        <section class="testimonials">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Kata Mereka Tentang JobRescue</h2>
                </div>
                <div class="testimonials-grid">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>"JobRescue Bogor membantu saya menemukan pekerjaan part-time yang sesuai dengan jadwal kuliah di IPB. Sangat membantu!"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h4>Sarah Putri</h4>
                                <span>Mahasiswa IPB</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>"Sebagai pemilik warung di Pasar Bogor, JobRescue sangat membantu saya menemukan karyawan yang tepat untuk bisnis saya."</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h4>Ahmad Wijaya</h4>
                                <span>Pemilik Warung</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>"Platform yang sangat cocok untuk warga Bogor yang ingin mencari pekerjaan sampingan atau freelance. Recommended!"</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="author-info">
                                <h4>Maya Sari</h4>
                                <span>Freelancer Bogor</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
            <div class="container">
                <div class="newsletter-content">
                    <div class="newsletter-text">
                        <h2 class="newsletter-title">Dapatkan Update Terbaru</h2>
                        <p class="newsletter-subtitle">Berlangganan newsletter untuk mendapatkan notifikasi pekerjaan terbaru dan tips karir</p>
                    </div>
                    <div class="newsletter-form">
                        <div class="form-group">
                            <input type="email" placeholder="Masukkan email Anda" class="newsletter-input">
                            <button class="newsletter-button" onclick="subscribeNewsletter()">
                                <i class="fas fa-paper-plane"></i>
                                Berlangganan
                            </button>
                        </div>
                        <p class="newsletter-privacy">Dengan berlangganan, Anda menyetujui <a href="#">Kebijakan Privasi</a> kami</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-container">
                <h2 class="cta-title">Siap Memulai Perjalanan Karir Anda?</h2>
                <p class="cta-subtitle">Bergabunglah dengan ribuan pekerja dan pemberi kerja yang sudah mempercayai JobRescue</p>
                <div class="cta-buttons">
                    <a href="{{ route('register') }}" class="cta-btn">
                        <i class="fas fa-user-plus"></i>
                        Daftar Sebagai Pekerja
                    </a>
                    <a href="{{ route('register') }}" class="cta-btn secondary">
                        <i class="fas fa-briefcase"></i>
                        Daftar Sebagai Pemberi Kerja
                    </a>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact">
            <div class="container">
                <div class="section-header">
                    <h2 class="section-title">Hubungi Kami</h2>
                    <p class="section-subtitle">Ada pertanyaan? Tim support kami siap membantu Anda</p>
                </div>
                <div class="contact-content">
                    <div class="contact-info">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Telepon</h3>
                                <p>+62 21 1234 5678</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <h3>Email</h3>
                                <p>support@jobrescue.com</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                        <div class="contact-details">
                            <h3>Alamat</h3>
                            <p>Jl. Pajajaran No. 123<br>Bogor Tengah 16128</p>
                        </div>
                        </div>
                    </div>
                    
                    <div class="contact-form">
                        <form class="form">
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="text" placeholder="Nama Lengkap" class="form-input" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" placeholder="Email" class="form-input" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Subjek" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <textarea placeholder="Pesan Anda" class="form-textarea" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="form-button" onclick="submitContactForm(event)">
                                <i class="fas fa-paper-plane"></i>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

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
        // Loading Screen Animation (with safety fallback)
        document.addEventListener('DOMContentLoaded', function() {
            const loadingScreens = Array.from(document.querySelectorAll('#loadingScreen, .loading-screen'));
            const loadingProgress = document.querySelector('.loading-progress');
            const mainContent = document.getElementById('main-content');
            
            let progress = 0;
            const loadingInterval = setInterval(() => {
                progress += Math.random() * 15;
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(loadingInterval);
                    setTimeout(() => {
                        loadingScreens.forEach(ls => {
                            if (ls) {
                                ls.classList.add('hidden');
                                setTimeout(() => { 
                                    ls.style.display = 'none';
                                    if (mainContent) {
                                        mainContent.classList.remove('hidden');
                                    }
                                }, 500);
                            }
                        });
                    }, 500);
                }
                if (loadingProgress) {
                    loadingProgress.style.width = progress + '%';
                }
            }, 100);

            // Create floating particles
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

        // Hero search functionality
        function performHeroSearch() {
            const searchTerm = document.getElementById('heroSearchInput').value.trim();
            const location = document.getElementById('heroLocationSelect').value;
            
            if (!searchTerm && !location) {
                alert('Silakan masukkan kata kunci atau pilih lokasi untuk mencari pekerjaan.');
                return;
            }
            
            // Redirect to jobs page with search parameters
            const params = new URLSearchParams();
            if (searchTerm) params.append('q', searchTerm);
            if (location) params.append('location', location);
            
            window.location.href = '{{ route("jobs.index") }}?' + params.toString();
        }

        // Add Enter key support for search
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('heroSearchInput');
            if (searchInput) {
                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        performHeroSearch();
                    }
                });
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
                        if (element.parentElement.querySelector('.stat-label').textContent.includes('Kepuasan')) {
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

            statNumbers.forEach(stat => {
                statsObserver.observe(stat);
            });

            // FAQ accordion behavior
            const faqItems = document.querySelectorAll('.faq-item');
            if (faqItems.length) {
                // open first by default
                faqItems[0].classList.add('active');
                faqItems.forEach(item => {
                    const q = item.querySelector('.faq-question');
                    if (q) {
                        q.addEventListener('click', () => {
                            // close others to behave like accordion
                            faqItems.forEach(other => { if (other !== item) other.classList.remove('active'); });
                            item.classList.toggle('active');
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>
