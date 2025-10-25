<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - JobRescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style id="admin-auth-inline">
        body {
            background: rgba(249,115,22,0.08);
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }
        .auth-hero{padding:48px 16px;min-height:100vh;display:flex;align-items:center;}
        .admin-auth-shell{max-width:1000px;margin:0 auto;padding:16px;}
        .auth-split-card{display:grid;grid-template-columns:1fr 1.2fr;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,.15);overflow:hidden;border:1px solid rgba(255,255,255,.3)}
        @media(max-width:900px){.auth-split-card{grid-template-columns:1fr}}
        .left-panel{position:relative;min-height:700px;background:#667eea;}
        .left-panel:before{content:"";position:absolute;inset:0;background:radial-gradient(800px 400px at 20% 80%, rgba(255,255,255,.18), transparent 60%),radial-gradient(600px 300px at 90% 10%, rgba(255,255,255,.12), transparent 60%);}
        .lp-content{position:relative;z-index:2;color:#fff;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;height:100%;padding:48px}
        .lp-badge{width:72px;height:72px;border-radius:10px;display:grid;place-items:center;background:rgba(255,255,255,.2)}
        .lp-title{font-family:'Poppins',sans-serif;font-weight:800;font-size:48px;line-height:1.1;margin:24px 0}
        .lp-sub{opacity:.9;font-weight:500}
        .right-panel{padding:32px;background:#fff;max-height:700px;overflow-y:auto}
        .right-panel .form-title{font-family:'Poppins',sans-serif;font-weight:800;font-size:24px;margin:0 0 4px;color:#1e293b}
        .right-panel .form-desc{color:#64748b;margin:0 0 20px;font-family:'Poppins',sans-serif;font-size:14px}
        .form-group{margin-bottom:18px}
        .form-label{display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:7px;font-family:'Poppins',sans-serif}
        .input-with-icon{position:relative;display:block}
        .input-with-icon i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#64748b;font-size:16px;z-index:2}
        .form-input{padding:12px 16px;width:100%;border:2px solid #e2e8f0;border-radius:14px;font-size:14px;transition:all 0.3s ease;background:#f8fafc;box-sizing:border-box;font-family:'Poppins',sans-serif;font-weight:400}
        .form-input:focus{outline:none;border-color:#f97316;box-shadow:0 0 0 4px rgba(249,115,22,0.12);background:#fff;transform:translateY(-1px)}
        .form-input::placeholder{color:#94a3b8;font-weight:400}
        .form-input:hover{border-color:#cbd5e1;background:#fff}
        .form-button{width:100%;background:#f97316;color:white;border:none;padding:14px 24px;border-radius:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all 0.3s ease;font-size:14px;margin-top:20px;font-family:'Poppins',sans-serif;box-shadow:0 4px 15px rgba(249,115,22,0.3)}
        .form-button:hover{transform:translateY(-2px);box-shadow:0 8px 30px rgba(249,115,22,0.4)}
        .form-button:active{transform:translateY(0);box-shadow:0 4px 15px rgba(249,115,22,0.3)}
        .role-selection{display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px}
        .role-option{position:relative;cursor:pointer}
        .role-option input[type="radio"]{position:absolute;opacity:0}
        .role-card{padding:16px;border:2px solid #e2e8f0;border-radius:14px;transition:all 0.3s ease;background:#f8fafc;position:relative;overflow:hidden;min-height:80px;display:flex;align-items:center}
        .role-card:before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(135deg,#667eea 0%,#f97316 50%,#764ba2 100%);transform:scaleX(0);transition:transform 0.3s ease;transform-origin:left}
        .role-card:hover{border-color:#f97316;background:#fff;transform:translateY(-2px);box-shadow:0 8px 25px rgba(0,0,0,0.12)}
        .role-card:hover:before{transform:scaleX(1)}
        .role-option input[type="radio"]:checked + .role-card{border-color:#f97316;background:#fff;box-shadow:0 8px 30px rgba(249,115,22,0.15);transform:translateY(-2px)}
        .role-option input[type="radio"]:checked + .role-card:before{transform:scaleX(1)}
        .role-info{display:flex;align-items:center;gap:14px;width:100%}
        .role-icon{font-size:28px;filter:drop-shadow(0 2px 4px rgba(0,0,0,0.1));flex-shrink:0}
        .role-text{flex:1}
        .role-text h4{font-weight:700;color:#1e293b;margin:0 0 4px;font-family:'Poppins',sans-serif;font-size:15px;line-height:1.2}
        .role-text p{font-size:12px;color:#64748b;margin:0;font-family:'Poppins',sans-serif;line-height:1.4}
        .form-row{display:grid;grid-template-columns:1fr 1fr;gap:18px;align-items:start;margin-bottom:18px}
        .form-row .form-group{margin-bottom:0}
        @media(max-width:768px){.form-row{grid-template-columns:1fr}
        .form-row .form-group{margin-bottom:18px}}
        .checkbox-group{display:flex;align-items:start;gap:10px;margin:20px 0;padding:14px;background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0;transition:all 0.3s ease}
        .checkbox-group:hover{background:#fff;border-color:#f97316}
        .checkbox-group input[type="checkbox"]{width:16px;height:16px;accent-color:#f97316;margin-top:1px;cursor:pointer}
        .checkbox-group label{font-size:12px;color:#64748b;line-height:1.4;font-family:'Poppins',sans-serif;cursor:pointer}
        .checkbox-group a{color:#f97316;text-decoration:none;font-weight:600}
        .checkbox-group a:hover{text-decoration:underline}
        .login-footer{margin-top:18px;text-align:center;color:#64748b;font-size:13px;font-family:'Poppins',sans-serif}
        .login-footer a{color:#f97316;text-decoration:none;font-weight:600}
        .login-footer a:hover{text-decoration:underline}
        .form-section{background:#f8fafc;padding:20px;border-radius:16px;margin:16px 0;border:1px solid #e2e8f0}
        .form-section-title{font-size:16px;font-weight:700;color:#1e293b;margin-bottom:16px;font-family:'Poppins',sans-serif}

        /* Unify all form controls appearance (inputs, selects, textareas) */
        .right-panel input[type="text"],
        .right-panel input[type="email"],
        .right-panel input[type="tel"],
        .right-panel input[type="password"],
        .right-panel select,
        .right-panel textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            background: #f8fafc;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            transition: all 0.25s ease;
            box-sizing: border-box;
        }
        .right-panel textarea { min-height: 120px; resize: vertical; }
        .right-panel select { appearance: none; background-image: linear-gradient(45deg, transparent 50%, #9ca3af 50%), linear-gradient(135deg, #9ca3af 50%, transparent 50%); background-position: calc(100% - 22px) calc(1em + 2px), calc(100% - 16px) calc(1em + 2px); background-size: 6px 6px, 6px 6px; background-repeat: no-repeat; }
        .right-panel input:focus,
        .right-panel select:focus,
        .right-panel textarea:focus {
            outline: none;
            border-color: #f97316;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(249,115,22,0.12);
            transform: translateY(-1px);
        }
        .right-panel input::placeholder,
        .right-panel textarea::placeholder { color: #94a3b8; }
        .right-panel .grid { gap: 18px; }
    </style>
</head>
<body>
    <main class="main">
        <section class="hero auth-hero">
            <div class="admin-auth-shell">
                <div class="auth-split-card">
                    <div class="left-panel">
                        <div class="lp-content">
                            <div class="lp-badge">
                                <img src="{{ asset('img/icon.svg') }}" alt="JobRescue Logo" style="width:42px;height:42px;">
                            </div>
                            <h2 class="lp-title">Bergabung<br>dengan Kami!</h2>
                            <p class="lp-sub">Platform terpercaya untuk pekerjaan mikro dan UMKM di Kota Bogor</p>
                            <div class="space-y-3 text-sm text-white" style="opacity:0.9;margin-top:24px;">
                                <div class="flex items-center space-x-2">
                                    <span>✓</span>
                                    <span>Temukan pekerjaan sesuai keahlian</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span>✓</span>
                                    <span>Hubungkan dengan pemberi kerja terpercaya</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span>✓</span>
                                    <span>Sistem pembayaran yang aman</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="right-panel">
                        <h3 class="form-title">Bergabung dengan JobRescue</h3>
                        <p class="form-desc">
                            Sudah punya akun? 
                            <a href="{{ route('login') }}" style="color:#f97316;text-decoration:none;">
                                Masuk di sini
                            </a>
                        </p>
                        
                        @if(request('plan'))
                            <div style="background:#f0f9ff;border:2px solid #0ea5e9;border-radius:12px;padding:16px;margin-bottom:20px;color:#0c4a6e;font-size:14px;">
                                <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                                    <i class="fas fa-crown" style="color:#f97316;"></i>
                                    <strong>Paket {{ ucfirst(request('plan')) }} Dipilih!</strong>
                                </div>
                                <p style="margin:0;">Setelah mendaftar, Anda akan dapat mengakses fitur paket {{ ucfirst(request('plan')) }}. Daftar sekarang untuk memulai!</p>
                            </div>
                        @endif
                @if ($errors->any())
                    <div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <span class="text-red-400 mr-2">⚠️</span>
                            <div>
                                <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                        <form method="POST" action="{{ route('register') }}" class="form">
                            @csrf
                            
                            <!-- Role Selection -->
                            <div class="form-group">
                                <label class="form-label">
                                    Daftar Sebagai
                                </label>
                                <div class="role-selection">
                                    <div class="role-option">
                                        <input type="radio" name="role" value="worker" id="worker" required>
                                        <label for="worker" class="role-card">
                                            <div class="role-info">
                                                <span class="role-icon">👷‍♂️</span>
                                                <div class="role-text">
                                                    <h4>Pekerja</h4>
                                                    <p>Cari pekerjaan dan proyek</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="role-option">
                                        <input type="radio" name="role" value="employer" id="employer" required>
                                        <label for="employer" class="role-card">
                                            <div class="role-info">
                                                <span class="role-icon">🧑‍💻</span>
                                                <div class="role-text">
                                                    <h4>Pemberi Kerja</h4>
                                                    <p>Post pekerjaan dan cari talent</p>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Basic Information -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="name" class="form-label">
                                        Nama Lengkap / Nama Perusahaan
                                    </label>
                                    <input 
                                        id="name" 
                                        name="name" 
                                        type="text" 
                                        required 
                                        value="{{ old('name') }}"
                                        class="form-input"
                                        placeholder="Masukkan nama lengkap"
                                    >
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        Email
                                    </label>
                                    <input 
                                        id="email" 
                                        name="email" 
                                        type="email" 
                                        required 
                                        value="{{ old('email') }}"
                                        class="form-input"
                                        placeholder="nama@email.com"
                                    >
                                </div>
                            </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                Password
                            </label>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                required 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-all"
                                placeholder="Minimal 8 karakter"
                            >
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                                Konfirmasi Password
                            </label>
                            <input 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                type="password" 
                                required 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-all"
                                placeholder="Ulangi password"
                            >
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                No. Telepon
                            </label>
                            <input 
                                id="phone" 
                                name="phone" 
                                type="tel" 
                                required 
                                value="{{ old('phone') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-all"
                                placeholder="081234567890"
                            >
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                Kota
                            </label>
                            <select 
                                id="city" 
                                name="city" 
                                required 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-all"
                            >
                                <option value="">Pilih Kota</option>
                                <option value="Bogor" {{ old('city') == 'Bogor' ? 'selected' : '' }}>Bogor</option>
                            </select>
                        </div>
                    </div>

                    <!-- Location Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="district" class="block text-sm font-medium text-gray-700 mb-2">
                                Kecamatan
                            </label>
                            <select 
                                id="district" 
                                name="district" 
                                required 
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-all"
                            >
                                <option value="">Pilih Kecamatan</option>
                                <option value="Bogor Tengah" {{ old('district') == 'Bogor Tengah' ? 'selected' : '' }}>Bogor Tengah</option>
                                <option value="Bogor Utara" {{ old('district') == 'Bogor Utara' ? 'selected' : '' }}>Bogor Utara</option>
                                <option value="Bogor Selatan" {{ old('district') == 'Bogor Selatan' ? 'selected' : '' }}>Bogor Selatan</option>
                                <option value="Bogor Barat" {{ old('district') == 'Bogor Barat' ? 'selected' : '' }}>Bogor Barat</option>
                                <option value="Bogor Timur" {{ old('district') == 'Bogor Timur' ? 'selected' : '' }}>Bogor Timur</option>
                            </select>
                        </div>

                        <div>
                            <label for="subdistrict" class="block text-sm font-medium text-gray-700 mb-2">
                                Kelurahan
                            </label>
                            <input 
                                id="subdistrict" 
                                name="subdistrict" 
                                type="text" 
                                required 
                                value="{{ old('subdistrict') }}"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent bg-gray-50 transition-all"
                                placeholder="Nama kelurahan"
                            >
                        </div>
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Lengkap
                        </label>
                        <textarea 
                            id="address" 
                            name="address" 
                            rows="3" 
                            required
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Jl. Contoh No. 123, RT/RW 01/02"
                        >{{ old('address') }}</textarea>
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Singkat (Opsional)
                        </label>
                        <textarea 
                            id="bio" 
                            name="bio" 
                            rows="3" 
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Ceritakan tentang diri Anda atau perusahaan Anda..."
                        >{{ old('bio') }}</textarea>
                    </div>

                    <!-- Skills (for workers) -->
                    <div id="skills-section" class="hidden">
                        <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">
                            Keahlian (Pisahkan dengan koma)
                        </label>
                        <input 
                            id="skills" 
                            name="skills" 
                            type="text" 
                            value="{{ old('skills') }}"
                            class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                            placeholder="Contoh: Desain Grafis, Adobe Photoshop, Illustrator"
                        >
                    </div>

                            <!-- Terms and Conditions -->
                            <div class="checkbox-group">
                                <input 
                                    id="terms" 
                                    name="terms" 
                                    type="checkbox" 
                                    required
                                >
                                <label for="terms">
                                    Saya menyetujui 
                                    <a href="#">Syarat dan Ketentuan</a> 
                                    serta 
                                    <a href="#">Kebijakan Privasi</a> 
                                    JobRescue
                                </label>
                            </div>

                            <button type="submit" class="form-button">
                                <span class="button-text">DAFTAR SEKARANG</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                            
                            <div class="login-footer">
                                <a href="{{ route('home') }}">← Kembali ke beranda</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Show/hide skills section based on role selection
        document.addEventListener('DOMContentLoaded', function() {
            const roleInputs = document.querySelectorAll('input[name="role"]');
            const skillsSection = document.getElementById('skills-section');
            const skillsInput = document.getElementById('skills');

            roleInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value === 'worker') {
                        skillsSection.classList.remove('hidden');
                        skillsInput.setAttribute('required', 'required');
                    } else {
                        skillsSection.classList.add('hidden');
                        skillsInput.removeAttribute('required');
                        skillsInput.value = '';
                    }
                });
            });

            // Check if role is already selected (on validation error)
            const selectedRole = document.querySelector('input[name="role"]:checked');
            if (selectedRole && selectedRole.value === 'worker') {
                skillsSection.classList.remove('hidden');
                skillsInput.setAttribute('required', 'required');
            }
        });
    </script>
</body>
</html>
