<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - JobRescue</title>
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
        .admin-auth-shell{max-width:900px;margin:0 auto;padding:16px;}
        .auth-split-card{display:grid;grid-template-columns:1.1fr 1fr;background:rgba(255,255,255,0.95);backdrop-filter:blur(12px);border-radius:20px;box-shadow:0 20px 60px rgba(0,0,0,.15);overflow:hidden;border:1px solid rgba(255,255,255,.3)}
        @media(max-width:900px){.auth-split-card{grid-template-columns:1fr}}
        .left-panel{position:relative;min-height:520px;background:#667eea;}
        .left-panel:before{content:"";position:absolute;inset:0;background:radial-gradient(800px 400px at 20% 80%, rgba(255,255,255,.18), transparent 60%),radial-gradient(600px 300px at 90% 10%, rgba(255,255,255,.12), transparent 60%);}
        .lp-content{position:relative;z-index:2;color:#fff;display:flex;flex-direction:column;justify-content:center;align-items:flex-start;height:100%;padding:48px}
        .lp-badge{width:72px;height:72px;border-radius:10px;display:grid;place-items:center;background:rgba(255,255,255,.2)}
        .lp-title{font-family:'Poppins',sans-serif;font-weight:800;font-size:48px;line-height:1.1;margin:24px 0}
        .lp-sub{opacity:.9;font-weight:500}
        .right-panel{padding:40px;background:#fff}
        .right-panel .form-title{font-family:'Poppins',sans-serif;font-weight:800;font-size:26px;margin:0 0 6px;color:#1e293b}
        .right-panel .form-desc{color:#64748b;margin:0 0 24px;font-family:'Poppins',sans-serif}
        .form-group{margin-bottom:20px}
        .input-with-icon{position:relative;display:block}
        .input-with-icon > i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#64748b;font-size:16px;z-index:2}
        .input-with-icon .form-input{padding:14px 50px 14px 44px;width:100%;border:1px solid #e2e8f0;border-radius:12px;font-size:15px;transition:all 0.2s;background:#f8fafc;box-sizing:border-box;font-family:'Poppins',sans-serif}
        .input-with-icon .form-input:focus{outline:none;border-color:#f97316;box-shadow:0 0 0 3px rgba(249,115,22,0.1);background:#fff}
        .input-with-icon .form-input::placeholder{color:#94a3b8;font-weight:400}
        .toggle-password{position:absolute;right:16px;top:50%;transform:translateY(-50%);background:rgba(255,255,255,0.9);border:1px solid #e2e8f0;color:#64748b;cursor:pointer;padding:6px;border-radius:6px;transition:all 0.2s;z-index:15;width:28px;height:28px;display:flex;align-items:center;justify-content:center}
        .toggle-password:hover{color:#f97316;background:#fff;border-color:#f97316}
        .toggle-password:active{transform:translateY(-50%) scale(0.95)}
        .toggle-password i{font-size:14px;pointer-events:none}
        .form-button{width:100%;background:#f97316;color:white;border:none;padding:16px 24px;border-radius:12px;font-weight:600;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all 0.2s;font-size:15px;margin-top:0;font-family:'Poppins',sans-serif}
        .form-button:hover{transform:translateY(-1px);box-shadow:0 8px 25px rgba(249,115,22,0.35)}
        .login-extra{display:flex;align-items:center;justify-content:space-between;margin:16px 0 24px 0}
        .remember-me{display:flex;align-items:center;gap:8px;font-size:14px;color:#64748b;cursor:pointer;font-family:'Poppins',sans-serif}
        .remember-me input[type="checkbox"]{width:16px;height:16px;accent-color:#f97316;cursor:pointer}
        .forgot-password{color:#f97316;text-decoration:none;font-size:14px;font-family:'Poppins',sans-serif}
        .forgot-password:hover{text-decoration:underline}
        .login-footer{margin-top:14px;color:#64748b;font-size:14px;font-family:'Poppins',sans-serif}
        .login-footer a{color:#f97316;text-decoration:none}
        .login-footer a:hover{text-decoration:underline}
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
                            <h2 class="lp-title">Selamat<br>Datang!</h2>
                            <p class="lp-sub">Masuk ke akun JobRescue Anda</p>
                        </div>
                    </div>
                    <div class="right-panel">
                        <h3 class="form-title">Masuk</h3>
                        <p class="form-desc">Selamat datang kembali! Silakan masuk ke akun Anda.</p>
                
                @if (session('status'))
                    <div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-4">
                        <div class="flex">
                            <span class="text-green-400 mr-2">✅</span>
                            <div>
                                <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                            </div>
                        </div>
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

                        <form class="form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" class="form-input" placeholder="Alamat Email" name="email" id="email" required value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-with-icon">
                                    <i class="fas fa-lock"></i>
                                    <input type="password" class="form-input" placeholder="Kata Sandi" name="password" id="password" required>
                                    <button type="button" class="toggle-password" id="togglePassword" aria-label="Toggle password visibility">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="login-extra">
                                <label class="remember-me">
                                    <input type="checkbox" id="remember" name="remember">
                                    <span class="checkmark"></span> Ingat Saya
                                </label>
                                <a href="{{ route('password.request') }}" class="forgot-password">Lupa Password?</a>
                            </div>
                            <button type="submit" class="form-button">
                                <span class="button-text">LOGIN</span>
                                <i class="fas fa-arrow-right"></i>
                            </button>
                            <div class="login-footer">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const icon = this.querySelector('i');
                    
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }
        });
    </script>
</body>
</html>
