<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Lowongan - Job Rescue</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
  <div class="max-w-6xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Lowongan</h1>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
      <div class="flex items-center justify-between mb-4">
        <form method="GET" class="flex gap-2">
          <select name="status" class="border rounded-lg px-3 py-2 text-sm">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
            <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Selesai</option>
          </select>
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul/emp" class="border rounded-lg px-3 py-2 text-sm">
          <button class="px-3 py-2 text-sm rounded-lg bg-orange-500 text-white">Filter</button>
        </form>
      </div>

      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-gray-600 border-b">
              <th class="py-2 pr-4">Judul</th>
              <th class="py-2 pr-4">Kategori</th>
              <th class="py-2 pr-4">Employer</th>
              <th class="py-2 pr-4">Status</th>
              <th class="py-2 pr-4">Dibuat</th>
              <th class="py-2 pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($jobs as $job)
            <tr class="border-b">
              <td class="py-3 pr-4 font-medium text-gray-800">{{ $job->title }}</td>
              <td class="py-3 pr-4">{{ $job->category->name ?? '-' }}</td>
              <td class="py-3 pr-4">{{ $job->employer->name ?? '-' }}</td>
              <td class="py-3 pr-4 capitalize">{{ $job->status }}</td>
              <td class="py-3 pr-4">{{ $job->created_at->diffForHumans() }}</td>
              <td class="py-3 pr-4">
                <div class="flex gap-3">
                  <a href="#" class="text-blue-600">Detail</a>
                  <a href="#" class="text-orange-600">Edit</a>
                  <form method="POST" action="{{ route('employer.jobs.delete', $job->id) }}" onsubmit="return confirm('Hapus lowongan ini?')">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr><td colspan="6" class="py-6 text-center text-gray-500">Belum ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-4">{{ $jobs->links() }}</div>
    </div>
  </div>
</body>
</html>
