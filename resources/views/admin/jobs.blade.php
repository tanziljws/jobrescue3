<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Lowongan - Job Rescue</title>
  <link rel="icon" type="image/svg" href="{{ asset('img/favicon.svg') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Poppins', sans-serif; background:#ffffff; }
    .admin-container { max-width: 1100px; margin: 0 auto; padding: 24px; }
    .admin-card { background:#fff; border:1px solid #eef2f7; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.06); }
    .admin-card-header { display:flex; align-items:center; justify-content:space-between; gap:12px; padding:16px; border-bottom:1px solid #eef2f7; }
    .filters { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }
    .select, .input { padding:10px 12px; border-radius:12px; border:1px solid #e5e7eb; background:#fff; outline:none; transition:.2s; font-size:13px; }
    .input:focus, .select:focus { border-color:#f97316; box-shadow:0 0 0 3px rgba(249,115,22,.12); }
    .btn-orange { background: linear-gradient(135deg,#f97316,#ea580c); color:#fff; border:none; padding:10px 14px; border-radius:12px; font-weight:700; font-size:12px; box-shadow:0 8px 20px rgba(249,115,22,.25); }
    .table { width:100%; border-collapse:separate; border-spacing:0; font-size:13px; }
    .table thead tr { color:#64748b; border-bottom:1px solid #eef2f7; }
    .table th, .table td { padding:12px 16px; text-align:left; }
    .table tbody tr { border-bottom:1px solid #f1f5f9; transition:.2s; }
    .table tbody tr:hover { background:#fff7ed; }
    .badge { display:inline-block; padding:4px 8px; font-size:11px; border-radius:9999px; font-weight:700; }
    .badge-active { background:#dcfce7; color:#166534; }
    .badge-pending { background:#ffedd5; color:#9a3412; }
    .badge-completed { background:#dbeafe; color:#1e40af; }
    .actions { display:flex; gap:10px; }
    .link-orange { color:#f97316; font-weight:600; }
    /* Card grid like reference */
    .job-cards { display:grid; grid-template-columns:repeat(auto-fill,minmax(300px,1fr)); gap:14px; padding:16px; }
    .job-card { background: rgba(102,126,234,0.12); border:1px solid rgba(102,126,234,0.25); border-radius:14px; box-shadow:0 6px 16px rgba(102,126,234,.12); padding:14px; display:flex; flex-direction:column; gap:10px; }
    .job-head { display:flex; align-items:center; justify-content:space-between; }
    .job-company { font-size:12px; color:#6b7280; font-weight:600; }
    .job-title { font-weight:800; color:#111827; }
    .job-range { color:#6b7280; font-weight:700; font-size:12px; }
    .job-desc { font-size:12px; color:#6b7280; line-height:1.5; }
    .job-foot { display:flex; align-items:center; justify-content:space-between; gap:10px; }
    .pill { padding:6px 10px; border-radius:9999px; font-size:11px; font-weight:800; border:1px solid transparent; }
    .pill-remote { background:#e0e7ff; color:#3730a3; }
    .pill-status-active { background:#dcfce7; color:#166534; }
    .pill-status-completed { background:#dbeafe; color:#1e40af; }
    .pill-status-pending { background:#ffedd5; color:#9a3412; }
    .job-actions { display:flex; gap:10px; margin-top:6px; }
    .muted { color:#6b7280; font-size:12px; }
    /* Floating confirm modal */
    .modal-mask { position:fixed; inset:0; background:rgba(0,0,0,.45); display:none; align-items:center; justify-content:center; z-index:50; }
    .modal-card { background:#667eea; color:#ffffff; border-radius:16px; box-shadow:0 10px 40px rgba(102,126,234,.35); width:92vw; max-width:420px; overflow:hidden; }
    .modal-head { padding:14px 16px; font-weight:800; border-bottom:1px solid rgba(255,255,255,.18); }
    .modal-body { padding:16px; font-size:14px; }
    .modal-actions { padding:12px 16px; display:flex; gap:10px; justify-content:flex-end; background:rgba(255,255,255,.06); }
    .btn { padding:8px 14px; border-radius:12px; font-weight:700; font-size:12px; border:1px solid transparent; }
    .btn-cancel { background:#ffffff; color:#667eea; border-color:transparent; }
    .btn-cancel:hover { background:#f8fafc; }
    .btn-danger { background:#ef4444; color:#fff; box-shadow:0 8px 20px rgba(239,68,68,.25); }
    .btn-danger:hover { background:#dc2626; }
  </style>
</head>
<body>
  <div class="admin-container">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Manajemen Lowongan</h1>

    <div class="admin-card">
      <div class="admin-card-header">
        <form method="GET" class="filters">
          <select name="status" class="select">
            <option value="">Semua Status</option>
            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
            <option value="completed" {{ request('status')=='completed' ? 'selected' : '' }}>Selesai</option>
          </select>
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul/emp" class="input">
          <button class="btn-orange">Filter</button>
        </form>
      </div>

      <div class="job-cards">
        @forelse($jobs as $job)
          @php
            $st = $job->status;
            $isActive = $st=='active' || $st=='pending';
            $statusClass = $isActive ? 'pill-status-active' : 'pill-status-completed';
            $min = $job->budget_min ?? null; $max = $job->budget_max ?? null;
            $range = ($min && $max) ? 'Rp '.number_format($min).' - '.number_format($max) : null;
          @endphp
          <div class="job-card">
            <div class="job-head">
              <div class="job-company">{{ $job->employer->name ?? '-' }}</div>
              <span class="pill {{ $statusClass }}">{{ $isActive ? 'Active' : 'Completed' }}</span>
            </div>
            <div class="job-title">{{ $job->title }}</div>
            <div class="job-range">{{ $range ?? ($job->category->name ?? '-') }}</div>
            <div class="job-desc">{{ Str::limit($job->description ?? '-', 120) }}</div>
            <div class="job-foot">
              <div class="pill pill-remote">{{ $job->job_type ? ucfirst($job->job_type) : 'Remote' }}</div>
              <div class="muted">{{ $job->created_at->diffForHumans() }}</div>
            </div>
            <div class="job-actions">
              <a href="{{ route('jobs.show', $job->id) }}" class="link-orange">Detail</a>
              <form id="del-form-{{ $job->id }}" method="POST" action="{{ route('admin.jobs.delete', $job->id) }}">
                @csrf @method('DELETE')
                <button type="button" class="link-orange btn-delete" data-form="del-form-{{ $job->id }}" style="color:#b91c1c">Hapus</button>
              </form>
            </div>
          </div>
        @empty
          <p class="text-sm text-gray-500 px-4 pb-4">Belum ada data.</p>
        @endforelse
      </div>
      <div class="p-3">{{ $jobs->appends(request()->query())->links() }}</div>
    </div>
  </div>
  
  <!-- Floating Confirm Modal -->
  <div id="confirmModal" class="modal-mask">
    <div class="modal-card">
      <div class="modal-head">Konfirmasi</div>
      <div class="modal-body">Hapus lowongan ini?</div>
      <div class="modal-actions">
        <button type="button" class="btn btn-cancel" data-dismiss>Batalkan</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function(){
      const modal = document.getElementById('confirmModal');
      const btnConfirm = document.getElementById('confirmDelete');
      let targetForm = null;
      function openModal(){ modal.style.display = 'flex'; }
      function closeModal(){ modal.style.display = 'none'; targetForm = null; }
      document.querySelectorAll('.btn-delete').forEach(btn=>{
        btn.addEventListener('click', ()=>{ targetForm = document.getElementById(btn.dataset.form); openModal(); });
      });
      btnConfirm.addEventListener('click', ()=>{ if(targetForm){ targetForm.submit(); } });
      modal.addEventListener('click', (e)=>{ if(e.target === modal || e.target.hasAttribute('data-dismiss')) closeModal(); });
      window.addEventListener('keydown', (e)=>{ if(e.key==='Escape') closeModal(); });
    });
  </script>
</body>
</html>
