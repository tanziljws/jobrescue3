<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Laporan - Job Rescue</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
  <div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Laporan</h1>

    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-gray-600 border-b">
              <th class="py-2 pr-4">Pelapor</th>
              <th class="py-2 pr-4">Terlapor</th>
              <th class="py-2 pr-4">Lowongan</th>
              <th class="py-2 pr-4">Status</th>
              <th class="py-2 pr-4">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($reports as $r)
            <tr class="border-b">
              <td class="py-3 pr-4">{{ $r->reporter->name ?? '-' }}</td>
              <td class="py-3 pr-4">{{ $r->reportedUser->name ?? '-' }}</td>
              <td class="py-3 pr-4">{{ $r->reportedJob->title ?? '-' }}</td>
              <td class="py-3 pr-4 capitalize">{{ $r->status ?? 'pending' }}</td>
              <td class="py-3 pr-4">
                <form action="{{ route('admin.reports.update-status', $r->id) }}" method="POST" class="flex gap-2 items-center">
                  @csrf @method('PATCH')
                  <select name="status" class="border rounded-lg px-2 py-1 text-xs">
                    <option value="pending" {{ $r->status=='pending'?'selected':'' }}>Pending</option>
                    <option value="in_review" {{ $r->status=='in_review'?'selected':'' }}>Review</option>
                    <option value="resolved" {{ $r->status=='resolved'?'selected':'' }}>Resolved</option>
                  </select>
                  <button class="px-3 py-1.5 text-xs rounded-lg bg-orange-500 text-white">Update</button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="py-6 text-center text-gray-500">Belum ada laporan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="mt-4">{{ $reports->links() }}</div>
    </div>
  </div>
</body>
</html>
