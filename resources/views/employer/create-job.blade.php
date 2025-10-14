<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Pekerjaan Baru - Job Rescue</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <a href="{{ route('employer.dashboard') }}" class="text-gray-600 hover:text-gray-800">
                        ← Kembali ke Dashboard
                    </a>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Post Pekerjaan Baru</h1>
                <p class="text-gray-600 mt-2">Buat lowongan pekerjaan untuk menarik pekerja terbaik di Bogor</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <form method="POST" action="{{ route('employer.jobs.store') }}" class="p-8 space-y-6">
                    @csrf

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <span class="text-red-400 mr-2">⚠️</span>
                                <div>
                                    <h3 class="text-sm font-medium text-red-800">Terjadi kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Basic Information -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">Informasi Dasar</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Judul Pekerjaan *
                                </label>
                                <input 
                                    type="text" 
                                    id="title" 
                                    name="title" 
                                    required
                                    value="{{ old('title') }}"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Contoh: Desain Logo untuk Toko Online"
                                >
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Kategori *
                                </label>
                                <select 
                                    id="category_id" 
                                    name="category_id" 
                                    required
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->icon }} {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="job_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipe Pekerjaan *
                                </label>
                                <select 
                                    id="job_type" 
                                    name="job_type" 
                                    required
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                                    <option value="">Pilih Tipe</option>
                                    <option value="freelance" {{ old('job_type') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                    <option value="part_time" {{ old('job_type') == 'part_time' ? 'selected' : '' }}>Part Time</option>
                                    <option value="full_time" {{ old('job_type') == 'full_time' ? 'selected' : '' }}>Full Time</option>
                                    <option value="contract" {{ old('job_type') == 'contract' ? 'selected' : '' }}>Kontrak</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi Pekerjaan *
                            </label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="6" 
                                required
                                class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                placeholder="Jelaskan detail pekerjaan, apa yang dibutuhkan, dan ekspektasi hasil..."
                            >{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Budget & Location -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">Budget & Lokasi</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="budget_type" class="block text-sm font-medium text-gray-700 mb-2">
                                    Tipe Budget *
                                </label>
                                <select 
                                    id="budget_type" 
                                    name="budget_type" 
                                    required
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                                    <option value="negotiable" {{ old('budget_type') == 'negotiable' ? 'selected' : '' }}>Dapat Dinegosiasi</option>
                                    <option value="fixed" {{ old('budget_type') == 'fixed' ? 'selected' : '' }}>Harga Tetap</option>
                                    <option value="hourly" {{ old('budget_type') == 'hourly' ? 'selected' : '' }}>Per Jam</option>
                                </select>
                            </div>

                            <div>
                                <label for="budget_min" class="block text-sm font-medium text-gray-700 mb-2">
                                    Budget Minimum (Rp)
                                </label>
                                <input 
                                    type="number" 
                                    id="budget_min" 
                                    name="budget_min" 
                                    min="0"
                                    value="{{ old('budget_min') }}"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="100000"
                                >
                            </div>

                            <div>
                                <label for="budget_max" class="block text-sm font-medium text-gray-700 mb-2">
                                    Budget Maksimum (Rp)
                                </label>
                                <input 
                                    type="number" 
                                    id="budget_max" 
                                    name="budget_max" 
                                    min="0"
                                    value="{{ old('budget_max') }}"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="500000"
                                >
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                    Lokasi *
                                </label>
                                <input 
                                    type="text" 
                                    id="location" 
                                    name="location" 
                                    required
                                    value="{{ old('location', 'Bogor') }}"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Bogor Tengah, Bogor"
                                >
                            </div>

                            <div>
                                <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                                    Deadline
                                </label>
                                <input 
                                    type="date" 
                                    id="deadline" 
                                    name="deadline" 
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                    value="{{ old('deadline') }}"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Requirements & Skills -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">Persyaratan & Keahlian</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">
                                    Persyaratan
                                </label>
                                <textarea 
                                    id="requirements" 
                                    name="requirements[]" 
                                    rows="4"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Contoh:&#10;- Pengalaman minimal 2 tahun&#10;- Portofolio yang relevan&#10;- Komunikasi yang baik"
                                >{{ old('requirements.0') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">Pisahkan setiap persyaratan dengan baris baru</p>
                            </div>

                            <div>
                                <label for="skills_required" class="block text-sm font-medium text-gray-700 mb-2">
                                    Keahlian yang Dibutuhkan
                                </label>
                                <textarea 
                                    id="skills_required" 
                                    name="skills_required[]" 
                                    rows="4"
                                    class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent"
                                    placeholder="Contoh:&#10;- Adobe Photoshop&#10;- Adobe Illustrator&#10;- Desain Logo"
                                >{{ old('skills_required.0') }}</textarea>
                                <p class="text-sm text-gray-500 mt-1">Pisahkan setiap keahlian dengan baris baru</p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Options -->
                    <div class="space-y-6">
                        <h2 class="text-xl font-semibold text-gray-800 border-b border-gray-200 pb-2">Opsi Tambahan</h2>
                        
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                id="is_urgent" 
                                name="is_urgent" 
                                value="1"
                                {{ old('is_urgent') ? 'checked' : '' }}
                                class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300 rounded"
                            >
                            <label for="is_urgent" class="ml-2 block text-sm text-gray-700">
                                <span class="font-medium">Pekerjaan Mendesak</span>
                                <span class="text-gray-500 block">Tandai jika pekerjaan ini perlu segera diselesaikan</span>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <a href="{{ route('employer.dashboard') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                            Batal
                        </a>
                        <div class="flex space-x-4">
                            <button 
                                type="submit" 
                                name="status" 
                                value="draft"
                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
                            >
                                Simpan sebagai Draft
                            </button>
                            <button 
                                type="submit" 
                                name="status" 
                                value="pending"
                                class="bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
                            >
                                Post Pekerjaan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Auto-format budget inputs
        document.getElementById('budget_min').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        document.getElementById('budget_max').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            e.target.value = value;
        });

        // Convert textarea content to arrays for requirements and skills
        document.querySelector('form').addEventListener('submit', function(e) {
            const requirementsTextarea = document.getElementById('requirements');
            const skillsTextarea = document.getElementById('skills_required');
            
            // Convert requirements
            if (requirementsTextarea.value.trim()) {
                const requirements = requirementsTextarea.value.split('\n').filter(item => item.trim());
                requirementsTextarea.name = 'requirements_text';
                
                requirements.forEach((req, index) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `requirements[${index}]`;
                    input.value = req.trim();
                    this.appendChild(input);
                });
            }
            
            // Convert skills
            if (skillsTextarea.value.trim()) {
                const skills = skillsTextarea.value.split('\n').filter(item => item.trim());
                skillsTextarea.name = 'skills_text';
                
                skills.forEach((skill, index) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `skills_required[${index}]`;
                    input.value = skill.trim();
                    this.appendChild(input);
                });
            }
        });
    </script>
</body>
</html>
