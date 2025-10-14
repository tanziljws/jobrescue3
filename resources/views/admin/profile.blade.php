<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin - Job Rescue</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-4xl mx-auto p-6">
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

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1 bg-white rounded-xl border border-gray-100 shadow-sm p-4">
                <div class="flex flex-col items-center">
                    <img src="{{ $user->profile_photo ? Storage::url($user->profile_photo) : 'https://via.placeholder.com/120' }}" class="w-24 h-24 rounded-full object-cover" alt="Avatar">
                    <p class="mt-3 font-semibold text-gray-800">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            </div>
            <div class="md:col-span-2">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-6">
                    <h2 class="font-semibold text-gray-800 mb-3">Ubah Profil</h2>
                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Nama</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">No. HP (opsional)</label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}" class="w-full border rounded-lg px-3 py-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Foto Profil</label>
                                <input type="file" name="avatar" accept="image/*" class="w-full border rounded-lg px-3 py-2 text-sm">
                            </div>
                        </div>
                        <button class="px-4 py-2 rounded-lg bg-orange-500 text-white font-semibold">Simpan Perubahan</button>
                    </form>
                </div>

                <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
                    <h2 class="font-semibold text-gray-800 mb-3">Ganti Password</h2>
                    <form action="{{ route('admin.password.update') }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PATCH')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Password Lama</label>
                                <input type="password" name="current_password" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                            </div>
                            <div>
                                <label class="block text-sm text-gray-700 mb-1">Password Baru</label>
                                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                            </div>
                        </div>
                        <button class="px-4 py-2 rounded-lg bg-orange-500 text-white font-semibold">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
