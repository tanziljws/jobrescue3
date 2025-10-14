<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Pengguna - Job Rescue</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Pengguna</h1>
    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
      <div class="flex items-center justify-between mb-4">
        <div class="flex gap-2">
          <a href="{{ route('admin.users') }}" class="px-3 py-1.5 text-sm rounded-lg bg-orange-500 text-white">Semua</a>
          <a href="{{ route('admin.users') }}?role=worker" class="px-3 py-1.5 text-sm rounded-lg bg-gray-100">Pekerja</a>
          <a href="{{ route('admin.users') }}?role=employer" class="px-3 py-1.5 text-sm rounded-lg bg-gray-100">Pemberi Kerja</a>
        </div>
        <form method="GET" class="flex gap-2">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/email" class="border rounded-lg px-3 py-2 text-sm">
          <button class="px-3 py-2 text-sm rounded-lg bg-orange-500 text-white">Cari</button>
        </form>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-gray-600 border-b">
              <th class="py-2 pr-4">Nama</th>
              <th class="py-2 pr-4">Email</th>
              <th class="py-2 pr-4">Role</th>
              <th class="py-2 pr-4">Status</th>
              <th class="py-2 pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($users as $u)
            <tr class="border-b">
              <td class="py-3 pr-4">{{ $u->name }}</td>
              <td class="py-3 pr-4">{{ $u->email }}</td>
              <td class="py-3 pr-4 capitalize">{{ $u->role }}</td>
              <td class="py-3 pr-4">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</td>
              <td class="py-3 pr-4">
                <a href="#" class="text-orange-600">Detail</a>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="py-6 text-center text-gray-500">Belum ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-4">{{ $users->links() }}</div>
    </div>
  </div>
</body>
</html>
