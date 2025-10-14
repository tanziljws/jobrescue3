<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat - Worker</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Chat / Pesan</h1>
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm grid grid-cols-1 md:grid-cols-3 overflow-hidden">
            <aside class="border-r border-gray-100 p-4">
                <input type="text" placeholder="Cari percakapan" class="w-full border rounded-lg px-3 py-2 text-sm mb-3">
                <div class="space-y-2 max-h-80 overflow-y-auto">
                    <div class="p-3 rounded-lg hover:bg-gray-50 cursor-pointer border border-gray-100">
                        <p class="font-medium text-gray-800">Contoh Employer</p>
                        <p class="text-xs text-gray-500">Percakapan terakhir...</p>
                    </div>
                </div>
            </aside>
            <section class="md:col-span-2 flex flex-col">
                <div class="flex-1 p-4 space-y-3 max-h-96 overflow-y-auto">
                    <div class="flex gap-2">
                        <div class="bg-gray-100 rounded-lg px-3 py-2 text-sm text-gray-800">Halo, ini contoh pesan.</div>
                    </div>
                    <div class="flex gap-2 justify-end">
                        <div class="bg-orange-500 text-white rounded-lg px-3 py-2 text-sm">Siap, saya tertarik dengan proyeknya.</div>
                    </div>
                </div>
                <form class="border-t border-gray-100 p-3 flex gap-2">
                    <input type="text" class="flex-1 border rounded-lg px-3 py-2 text-sm" placeholder="Ketik pesan...">
                    <button type="button" class="px-4 py-2 rounded-lg bg-orange-500 text-white font-semibold">Kirim</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
