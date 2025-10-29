<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Job Rescue</title>
    <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background:#f8fafc; }
        .admin-container { max-width: 1100px; margin: 0 auto; padding: 24px; }
        .admin-grid { display:grid; grid-template-columns: 1fr 2fr; gap: 20px; }
        .admin-card { background:#fff; border:1px solid #eef2f7; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.06); }
        .admin-card .hd { padding:14px 16px; border-bottom:1px solid #eef2f7; font-weight:700; color:#111827; }
        .admin-card .bd { padding:16px; }
        .input { width:100%; padding:10px 12px; border-radius:12px; border:1px solid #e5e7eb; outline:none; font-size:14px; }
        .input:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.12); }
        .label { display:block; font-size:12px; color:#64748b; margin-bottom:6px; }
        .btn-orange { background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; border:none; padding:10px 14px; border-radius:12px; font-weight:700; font-size:12px; box-shadow:0 8px 20px rgba(249,115,22,.25); }
        .profile-box { display:flex; flex-direction:column; align-items:center; gap:10px; padding:20px; }
        .avatar-img { width:112px; height:112px; border-radius:9999px; object-fit:cover; box-shadow:0 10px 24px rgba(0,0,0,.10); border:4px solid #fff; outline:3px solid rgba(102,126,234,.25); }
        .muted { color:#6b7280; font-size:12px; }
        @media (max-width: 860px) { .admin-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Profil Admin</h1>

        @if (session('success'))
            <div class="mb-4 bg-green-50 text-green-800 px-4 py-2 rounded-lg">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-4 bg-red-50 text-red-700 px-4 py-2 rounded-lg">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-grid">
            <div class="admin-card">
                <div class="hd">Profil</div>
                <div class="bd">
                    <div class="profile-box">
                        <img id="avatarPreview" src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : 'https://via.placeholder.com/150' }}" class="avatar-img" alt="Avatar">
                        <div class="text-center">
                            <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                            <p class="muted">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="admin-card mb-6">
                    <div class="hd">Ubah Profil</div>
                    <div class="bd">
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="label">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="input" required>
                            </div>
                            <div>
                                <label class="label">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="input" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="label">No. HP (opsional)</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="input">
                            </div>
                            <div>
                                <label class="label">Foto Profil</label>
                                <input id="avatarInput" type="file" name="avatar" accept="image/*" class="input">
                            </div>
                        </div>
                        <button class="btn-orange">Simpan Perubahan</button>
                    </form>
                    </div>
                </div>

                <div class="admin-card">
                    <div class="hd">Ganti Password</div>
                    <div class="bd">
                    <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="label">Password Lama</label>
                                <input type="password" name="current_password" class="input" required>
                            </div>
                            <div>
                                <label class="label">Password Baru</label>
                                <input type="password" name="password" class="input" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="input" required>
                            </div>
                        </div>
                        <button class="btn-orange">Update Password</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const input = document.getElementById('avatarInput');
            const preview = document.getElementById('avatarPreview');
            if(input && preview){
                input.addEventListener('change', function(){
                    const file = this.files && this.files[0];
                    if(file){
                        const url = URL.createObjectURL(file);
                        preview.src = url;
                    }
                });
            }
        });
    </script>
</body>
</html>
