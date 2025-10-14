<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori Pekerjaan - Job Rescue</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Kategori Pekerjaan</h1>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-6">
      <form action="#" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <input type="text" name="name" placeholder="Nama kategori" class="border rounded-lg px-3 py-2 text-sm">
        <input type="text" name="icon" placeholder="Ikon (opsional)" class="border rounded-lg px-3 py-2 text-sm">
        <button class="px-3 py-2 text-sm rounded-lg bg-orange-500 text-white">Tambah</button>
      </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-gray-600 border-b">
              <th class="py-2 pr-4">Nama</th>
              <th class="py-2 pr-4">Ikon</th>
              <th class="py-2 pr-4">Jumlah Lowongan</th>
              <th class="py-2 pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($categories as $c)
            <tr class="border-b">
              <td class="py-3 pr-4">{{ $c->name }}</td>
              <td class="py-3 pr-4">{{ $c->icon ?? '-' }}</td>
              <td class="py-3 pr-4">{{ $c->jobs_count ?? 0 }}</td>
              <td class="py-3 pr-4">
                <a href="#" class="text-orange-600">Edit</a>
              </td>
            </tr>
            @empty
            <tr><td colspan="4" class="py-6 text-center text-gray-500">Belum ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-4">{{ $categories->links() }}</div>
    </div>
  </div>
</body>
</html>
