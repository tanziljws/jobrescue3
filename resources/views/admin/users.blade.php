<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Pengguna - Job Rescue</title>
  <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background: #ffffff; }
    .admin-container { max-width: 1100px; margin: 0 auto; padding: 24px; }
    .admin-card { background: #ffffff; border: 1px solid #eef2f7; border-radius: 16px; box-shadow: 0 6px 18px rgba(0,0,0,.06); }
    .admin-card-header { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:16px; border-bottom:1px solid #eef2f7; }
    .filter-tabs { display:flex; gap:8px; }
    .filter-tab { display:inline-flex; align-items:center; gap:6px; padding:8px 12px; border-radius:12px; font-weight:600; font-size:12px; color:#1f2937; background:#f3f4f6; border:1px solid #e5e7eb; transition:.2s; }
    .filter-tab:hover { background:#eef2ff; border-color:#e0e7ff; }
    .filter-tab.active { background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; border-color:transparent; }
    .search-wrap { display:flex; gap:8px; align-items:center; }
    .search-input { padding:10px 12px; border-radius:9999px; border:1px solid #e5e7eb; background:#fff; min-width:240px; outline:none; transition:.2s; }
    .search-input:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.12); }
    .btn-orange { background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; border:none; padding:10px 14px; border-radius:9999px; font-weight:700; font-size:12px; box-shadow:0 8px 20px rgba(249,115,22,.25); }
    /* Card grid */
    .cards { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:14px; padding:14px; }
    .user-card { background: rgba(102,126,234,0.12); border:1px solid rgba(102,126,234,0.25); border-radius:14px; padding:14px; box-shadow:0 4px 12px rgba(102,126,234,.08); display:flex; flex-direction:column; gap:10px; transition:.2s; }
    .user-card:hover { transform:translateY(-2px); box-shadow:0 10px 24px rgba(0,0,0,.08); }
    .user-head { display:flex; align-items:center; gap:10px; }
    .avatar { width:42px; height:42px; border-radius:50%; display:grid; place-items:center; color:#fff; font-weight:700; }
    .avatar-initial { background:#667eea; }
    .user-meta { line-height:1.2; }
    .user-name { font-weight:700; color:#1f2937; }
    .user-email { font-size:12px; color:#64748b; }
    .chip-row { display:flex; gap:6px; flex-wrap:wrap; }
    .chip { display:inline-block; padding:4px 8px; font-size:11px; border-radius:9999px; font-weight:700; border:1px solid transparent; }
    .chip-role-admin { background:#dbeafe; color:#1e40af; }
    .chip-role-employer { background:#ffedd5; color:#9a3412; }
    .chip-role-worker { background:#dcfce7; color:#166534; }
    .chip-status-active { background:#dcfce7; color:#166534; }
    .chip-status-inactive { background:#e5e7eb; color:#374151; }
    .card-actions { display:flex; gap:8px; margin-top:6px; }
    .btn-outline { padding:6px 10px; border-radius:10px; font-size:12px; font-weight:700; border:1px solid #e5e7eb; color:#374151; background:#fff; }
    .btn-outline:hover { border-color:#9ca3af; }
    .btn-danger { border-color:#fecaca; color:#b91c1c; background:#fff5f5; }
    .btn-danger:hover { background:#fee2e2; }
    .btn-warning { border-color:#fed7aa; color:#9a3412; background:#fff7ed; }
    .btn-warning:hover { background:#ffedd5; }
    .badge-role { display:inline-block; padding:4px 8px; font-size:11px; border-radius:9999px; font-weight:700; }
    .badge-admin { background:#dbeafe; color:#1e40af; }
    .badge-employer { background:#ffedd5; color:#9a3412; }
    .badge-worker { background:#dcfce7; color:#166534; }
    .badge-status { display:inline-block; padding:4px 8px; font-size:11px; border-radius:9999px; font-weight:700; }
    .status-active { background:#dcfce7; color:#166534; }
    .status-inactive { background:#e5e7eb; color:#374151; }
    .link-orange { color:#f97316; font-weight:600; }
  </style>
</head>
<body>
  <div class="admin-container">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Pengguna</h1>
    <div class="admin-card">
      <div class="admin-card-header">
        <div class="filter-tabs">
          <a href="{{ route('admin.users') }}" class="filter-tab {{ request('role') ? '' : 'active' }}">Semua</a>
          <a href="{{ route('admin.users') }}?role=worker" class="filter-tab {{ request('role')=='worker' ? 'active' : '' }}">Pekerja</a>
          <a href="{{ route('admin.users') }}?role=employer" class="filter-tab {{ request('role')=='employer' ? 'active' : '' }}">Pemberi Kerja</a>
        </div>
        <form method="GET" class="search-wrap">
          @if(request('role'))
            <input type="hidden" name="role" value="{{ request('role') }}">
          @endif
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama/email" class="search-input">
          <button class="btn-orange">Cari</button>
        </form>
      </div>
      @php
        $hasBlock = \Illuminate\Support\Facades\Route::has('admin.users.block');
        $hasUnblock = \Illuminate\Support\Facades\Route::has('admin.users.unblock');
        $hasDelete = \Illuminate\Support\Facades\Route::has('admin.users.destroy');
      @endphp
      <div class="cards">
        @forelse($users as $u)
          @php
            $initials = strtoupper(substr($u->name,0,1));
            $roleClass = $u->role=='admin'?'chip-role-admin':($u->role=='employer'?'chip-role-employer':'chip-role-worker');
          @endphp
          <div class="user-card">
            <div class="user-head">
              <div class="avatar avatar-initial">{{ $initials }}</div>
              <div class="user-meta">
                <div class="user-name">{{ $u->name }}</div>
                <div class="user-email">{{ $u->email }}</div>
              </div>
            </div>
            <div class="chip-row">
              <span class="chip {{ $roleClass }}">{{ ucfirst($u->role) }}</span>
              <span class="chip {{ $u->is_active ? 'chip-status-active' : 'chip-status-inactive' }}">{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}</span>
            </div>
            <div class="card-actions">
              <button type="button"
                class="btn-outline btn-detail"
                data-name="{{ $u->name }}"
                data-email="{{ $u->email }}"
                data-role="{{ ucfirst($u->role) }}"
                data-status="{{ $u->is_active ? 'Aktif' : 'Nonaktif' }}"
                data-phone="{{ $u->phone ?? '-' }}"
                data-city="{{ $u->city ?? '-' }}"
                data-district="{{ $u->district ?? '-' }}"
                data-subdistrict="{{ $u->subdistrict ?? '-' }}"
                data-address="{{ $u->address ?? '-' }}"
                data-bio="{{ $u->bio ?? '-' }}"
                data-joined="{{ $u->created_at ? $u->created_at->format('d M Y') : '-' }}"
              >Detail</button>
              @if($u->is_active)
                <form method="POST" action="{{ $hasBlock ? route('admin.users.block',$u->id) : '#' }}" onsubmit="return {{ $hasBlock ? 'confirm(\'Blokir akun ini?\')' : 'alert(\'Route admin.users.block belum tersedia\'), false' }}">
                  @csrf
                  <button type="submit" class="btn-outline btn-warning">Blokir</button>
                </form>
              @else
                <form method="POST" action="{{ $hasUnblock ? route('admin.users.unblock',$u->id) : '#' }}" onsubmit="return {{ $hasUnblock ? 'confirm(\'Aktifkan kembali akun ini?\')' : 'alert(\'Route admin.users.unblock belum tersedia\'), false' }}">
                  @csrf
                  <button type="submit" class="btn-outline">Aktifkan</button>
                </form>
              @endif
              <form method="POST" action="{{ $hasDelete ? route('admin.users.destroy',$u->id) : '#' }}" onsubmit="return {{ $hasDelete ? 'confirm(\'Hapus akun ini? Tindakan tidak dapat dibatalkan.\')' : 'alert(\'Route admin.users.destroy belum tersedia\'), false' }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn-outline btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        @empty
          <p class="text-sm text-gray-500 px-4 pb-4">Belum ada data.</p>
        @endforelse
      </div>
      <div class="p-3">{{ $users->appends(request()->query())->links() }}</div>
    </div>
  </div>
  
  <!-- Floating Modal for User Detail -->
  <div id="userDetailModal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/40" data-dismiss="modal"></div>
    <div class="absolute right-4 bottom-4 md:right-8 md:bottom-8 max-w-md w-[92vw]">
      <div class="bg-white rounded-2xl shadow-2xl border border-orange-100 overflow-hidden">
        <div class="px-5 py-4 border-b border-orange-100 flex items-center justify-between" style="background: rgba(249,115,22,0.08);">
          <div class="font-bold text-gray-900">Detail Profil Pengguna</div>
          <button class="text-gray-500 hover:text-orange-600 font-bold text-xl ml-4 flex-shrink-0" data-dismiss="modal">✕</button>
        </div>
        <div class="p-5 space-y-4 text-sm">
          <div class="pb-3 border-b border-orange-50">
            <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Nama</div>
            <div id="ud-name" class="font-bold text-gray-900 text-base"></div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Email</div>
              <div id="ud-email" class="text-gray-900 break-all font-medium"></div>
            </div>
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Telepon</div>
              <div id="ud-phone" class="text-gray-900 font-medium"></div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Role</div>
              <div id="ud-role" class="text-gray-900 font-medium"></div>
            </div>
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Status</div>
              <div id="ud-status" class="text-gray-900 font-medium"></div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Kota</div>
              <div id="ud-city" class="text-gray-900 font-medium"></div>
            </div>
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Kecamatan</div>
              <div id="ud-district" class="text-gray-900 font-medium"></div>
            </div>
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Kelurahan</div>
              <div id="ud-subdistrict" class="text-gray-900 font-medium"></div>
            </div>
            <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
              <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Bergabung</div>
              <div id="ud-joined" class="text-gray-900 font-medium"></div>
            </div>
          </div>
          <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
            <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Alamat</div>
            <div id="ud-address" class="text-gray-900 font-medium"></div>
          </div>
          <div class="p-3 rounded-lg" style="background: rgba(249,115,22,0.05);">
            <div class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Bio</div>
            <div id="ud-bio" class="text-gray-900 font-medium leading-relaxed"></div>
          </div>
        </div>
        <div class="px-5 py-4 border-t border-orange-100 flex items-center justify-end gap-2" style="background: rgba(249,115,22,0.05);">
          <button class="px-4 py-2 rounded-lg font-semibold text-sm transition-all" style="background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; box-shadow:0 4px 12px rgba(249,115,22,.25);" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      const modal = document.getElementById('userDetailModal');
      const bindings = {
        name: document.getElementById('ud-name'),
        email: document.getElementById('ud-email'),
        role: document.getElementById('ud-role'),
        status: document.getElementById('ud-status'),
        phone: document.getElementById('ud-phone'),
        city: document.getElementById('ud-city'),
        district: document.getElementById('ud-district'),
        subdistrict: document.getElementById('ud-subdistrict'),
        address: document.getElementById('ud-address'),
        bio: document.getElementById('ud-bio'),
        joined: document.getElementById('ud-joined'),
      };
      function openModal(){ modal.classList.remove('hidden'); }
      function closeModal(){ modal.classList.add('hidden'); }
      modal.querySelectorAll('[data-dismiss="modal"]').forEach(el=>el.addEventListener('click', closeModal));
      document.querySelectorAll('.btn-detail').forEach(btn=>{
        btn.addEventListener('click', ()=>{
          Object.keys(bindings).forEach(k=>{ bindings[k].textContent = btn.dataset[k] || '-'; });
          openModal();
        });
      });
    });
  </script>
</body>
</html>
