<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kategori Pekerjaan - Job Rescue</title>
  <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background:#ffffff; }
    .admin-container { max-width: 1100px; margin: 0 auto; padding: 24px; }
    .admin-card { background:#fff; border:1px solid #eef2f7; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.06); }
    .admin-card-header { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:16px; border-bottom:1px solid #eef2f7; }
    .add-form { display:grid; grid-template-columns: 1fr auto; gap:10px; }
    .input { padding:10px 12px; border-radius:12px; border:1px solid #e5e7eb; outline:none; }
    .input:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.12); }
    .btn-orange { background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; border:none; padding:10px 14px; border-radius:12px; font-weight:700; font-size:12px; box-shadow:0 8px 20px rgba(249,115,22,.25); }
    .grid-cats { display:grid; grid-template-columns:repeat(auto-fill,minmax(220px,1fr)); gap:14px; padding:16px; }
    .cat-card { background: rgba(102,126,234,0.12); border:1px solid rgba(102,126,234,0.25); border-radius:14px; padding:14px; box-shadow:0 6px 16px rgba(102,126,234,.10); display:flex; flex-direction:column; gap:10px; }
    .cat-top { display:flex; align-items:center; justify-content:space-between; }
    .cat-name { font-weight:700; color:#111827; }
    .cat-icon { font-size:18px; }
    .muted { color:#6b7280; font-size:12px; }
    .edit-link { color:#f97316; font-weight:600; font-size:12px; align-self:flex-start; }
  </style>
</head>
<body>
  <div class="admin-container">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Kategori Pekerjaan</h1>

    <div class="admin-card">
      <div class="admin-card-header">
        <div class="font-semibold text-gray-700">Tambah Kategori</div>
      </div>
      <div class="p-4">
        @if(session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
          </div>
        @endif
        
        @if($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        
        <form action="{{ route('admin.categories.store') }}" method="POST" class="add-form">
          @csrf
          <input type="text" name="name" placeholder="Nama kategori" class="input" value="{{ old('name') }}" required>
          <button type="submit" class="btn-orange">Tambah</button>
        </form>
      </div>
    </div>

    <div class="admin-card mt-6">
      <div class="admin-card-header">
        <div class="font-semibold text-gray-700">Daftar Kategori</div>
        <div class="muted">Total: {{ $categories->total() ?? count($categories) }}</div>
      </div>
      <div class="grid-cats">
        @forelse($categories as $c)
          <div class="cat-card">
            <div class="cat-top">
              <div class="cat-name">{{ $c->name }}</div>
              <div class="cat-icon">{{ $c->icon ?? '📁' }}</div>
            </div>
            <div class="muted">{{ $c->jobs_count ?? 0 }} lowongan</div>
            <a href="#" class="edit-link">Edit</a>
          </div>
        @empty
          <p class="text-sm text-gray-500 px-4 pb-4">Belum ada data.</p>
        @endforelse
      </div>
      <div class="p-3">{{ $categories->links() }}</div>
    </div>
  </div>
</body>
</html>
