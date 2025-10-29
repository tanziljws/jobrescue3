<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pekerjaan - Worker</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-6xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Riwayat Pekerjaan</h1>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
            @if(isset($applications) && $applications->count())
                <div class="divide-y">
                    @foreach($applications as $app)
                        <div class="py-4 flex items-start justify-between">
                            <div>
                                <p class="font-semibold text-gray-900">{{ $app->job->title ?? 'Pekerjaan' }}</p>
                                <p class="text-sm text-gray-600">Kategori: {{ $app->job->category->name ?? '-' }} • Employer: {{ $app->job->employer->name ?? '-' }}</p>
                                <p class="text-sm mt-1"><span class="px-2 py-1 rounded-full text-xs {{ $app->status === 'accepted' ? 'bg-green-100 text-green-700' : ($app->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-700') }}">{{ ucfirst($app->status ?? 'pending') }}</span></p>
                            </div>
                            <a href="{{ route('jobs.show', $app->job_id) }}" class="text-orange-600 hover:text-orange-700 text-sm font-medium">Lihat</a>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">{{ $applications->links() }}</div>
            @else
                <p class="text-gray-600">Belum ada riwayat pekerjaan.</p>
            @endif
        </div>
    </div>
</body>
</html>
