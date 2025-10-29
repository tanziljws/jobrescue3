<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Laporan - Job Rescue</title>
  <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background:#ffffff; }
    .admin-container { max-width: 1100px; margin: 0 auto; padding: 24px; }
    .admin-card { background:#fff; border:1px solid #eef2f7; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.06); }
    .admin-card-header { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:16px; border-bottom:1px solid #eef2f7; }
    .table { width:100%; border-collapse:separate; border-spacing:0; font-size:13px; }
    .table thead tr { color:#64748b; border-bottom:1px solid #eef2f7; }
    .table th, .table td { padding:12px 16px; text-align:left; }
    .table tbody tr { border-bottom:1px solid #f1f5f9; transition:.2s; }
    .table tbody tr:hover { background:#fff7ed; }
    .badge { display:inline-block; padding:4px 8px; font-size:11px; border-radius:9999px; font-weight:700; }
    .badge-pending { background:#ffedd5; color:#9a3412; }
    .badge-review { background:#fde68a; color:#92400e; }
    .badge-resolved { background:#dcfce7; color:#166534; }
    .select { padding:8px 10px; border-radius:10px; border:1px solid #e5e7eb; font-size:12px; }
    .btn-orange { background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; border:none; padding:8px 12px; border-radius:10px; font-weight:700; font-size:12px; box-shadow:0 8px 20px rgba(249,115,22,.18); }
  </style>
</head>
<body>
  <div class="admin-container">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Laporan</h1>

    <div class="admin-card">
      <div class="admin-card-header">
        <div class="font-semibold text-gray-700">Daftar Laporan</div>
      </div>
      <div class="overflow-x-auto p-2">
        <table class="table">
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
            <tr class="border-b hover:bg-white">
              <td class="py-3 pr-4 font-medium text-gray-800">{{ $r->reporter->name ?? '-' }}</td>
              <td class="py-3 pr-4">{{ $r->reportedUser->name ?? '-' }}</td>
              <td class="py-3 pr-4">{{ $r->reportedJob->title ?? '-' }}</td>
              <td class="py-3 pr-4 capitalize">
                @php $st = $r->status ?? 'pending'; @endphp
                <span class="badge {{ $st=='resolved'?'badge-resolved':($st=='in_review'?'badge-review':'badge-pending') }}">{{ str_replace('_',' ', ucfirst($st)) }}</span>
              </td>
              <td class="py-3 pr-4">
                <form action="{{ route('admin.reports.update-status', $r->id) }}" method="POST" class="flex gap-2 items-center">
                  @csrf @method('PATCH')
                  <select name="status" class="select">
                    <option value="pending" {{ $r->status=='pending'?'selected':'' }}>Pending</option>
                    <option value="in_review" {{ $r->status=='in_review'?'selected':'' }}>Review</option>
                    <option value="resolved" {{ $r->status=='resolved'?'selected':'' }}>Resolved</option>
                  </select>
                  <button class="btn-orange">Update</button>
                </form>
              </td>
            </tr>
            @empty
            <tr><td colspan="5" class="py-6 text-center text-gray-500">Belum ada laporan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="p-3">{{ $reports->links() }}</div>
    </div>
  </div>
</body>
</html>
