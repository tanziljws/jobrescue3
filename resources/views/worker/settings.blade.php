<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Akun - Worker</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Pengaturan Akun</h1>

        @if (session('success'))
            <div class="mb-3 rounded-lg bg-green-50 text-green-800 px-4 py-2">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="mb-3 rounded-lg bg-red-50 text-red-700 px-4 py-2">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-semibold text-gray-800 mb-3">Ganti Password</h2>
            <form action="{{ route('worker.password.update') }}" method="POST" class="space-y-3">
                @csrf
                @method('PATCH')
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Password Lama</label>
                    <input type="password" name="current_password" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Password Baru</label>
                        <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded-lg px-3 py-2 text-sm" required>
                    </div>
                </div>
                <button class="px-4 py-2 rounded-lg bg-orange-500 text-white font-semibold">Simpan</button>
            </form>
        </div>

        <div class="mt-6 bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h2 class="font-semibold text-gray-800 mb-3">Nonaktifkan Akun</h2>
            <p class="text-sm text-gray-600 mb-3">Anda dapat menonaktifkan akun sementara waktu. Hubungi admin untuk reaktivasi.</p>
            <button class="px-4 py-2 rounded-lg bg-gray-200 text-gray-700 font-semibold" disabled>Nonaktifkan (Hubungi Admin)</button>
        </div>
    </div>
</body>
</html>
