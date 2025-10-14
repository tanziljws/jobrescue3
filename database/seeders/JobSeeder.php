<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employer = \App\Models\User::where('email', 'employer@example.com')->first();
        $categories = \App\Models\JobCategory::all();

        if (!$employer || $categories->isEmpty()) {
            return;
        }

        $jobs = [
            [
                'title' => 'Desain Logo untuk Toko Online Makanan',
                'description' => 'Saya membutuhkan desainer untuk membuat logo yang menarik untuk toko online makanan saya. Logo harus mencerminkan kesegaran dan kualitas makanan. Saya ingin logo yang modern, mudah diingat, dan bisa digunakan di berbagai media.',
                'category_id' => $categories->where('slug', 'desain-grafis')->first()->id,
                'budget_min' => 300000,
                'budget_max' => 500000,
                'budget_type' => 'fixed',
                'location' => 'Bogor Tengah, Bogor',
                'job_type' => 'freelance',
                'status' => 'active',
                'deadline' => now()->addDays(14),
                'requirements' => ['Pengalaman minimal 2 tahun', 'Portfolio logo yang relevan', 'Mampu memberikan 3-5 konsep desain'],
                'skills_required' => ['Adobe Illustrator', 'Adobe Photoshop', 'Desain Logo', 'Branding'],
                'is_urgent' => false,
            ],
            [
                'title' => 'Catering untuk Acara Pernikahan 100 Orang',
                'description' => 'Dibutuhkan jasa catering untuk acara pernikahan dengan 100 tamu. Menu yang diinginkan adalah masakan Sunda tradisional dengan presentasi yang menarik. Acara akan dilaksanakan di rumah di daerah Bogor Utara.',
                'category_id' => $categories->where('slug', 'catering-kuliner')->first()->id,
                'budget_min' => 8000000,
                'budget_max' => 12000000,
                'budget_type' => 'negotiable',
                'location' => 'Bogor Utara, Bogor',
                'job_type' => 'contract',
                'status' => 'active',
                'deadline' => now()->addDays(30),
                'requirements' => ['Pengalaman catering minimal 3 tahun', 'Sertifikat halal', 'Bisa menyediakan peralatan makan'],
                'skills_required' => ['Masakan Sunda', 'Event Catering', 'Food Presentation', 'Manajemen Acara'],
                'is_urgent' => true,
            ],
            [
                'title' => 'Perbaikan AC Split 2 Unit di Rumah',
                'description' => 'AC di rumah saya bermasalah, tidak dingin dan mengeluarkan suara aneh. Saya membutuhkan teknisi yang berpengalaman untuk memperbaiki 2 unit AC split. Lokasi di Bogor Selatan, mudah diakses.',
                'category_id' => $categories->where('slug', 'teknisi-perbaikan')->first()->id,
                'budget_min' => 200000,
                'budget_max' => 400000,
                'budget_type' => 'negotiable',
                'location' => 'Bogor Selatan, Bogor',
                'job_type' => 'freelance',
                'status' => 'active',
                'deadline' => now()->addDays(7),
                'requirements' => ['Teknisi bersertifikat', 'Membawa peralatan sendiri', 'Garansi perbaikan minimal 1 bulan'],
                'skills_required' => ['Perbaikan AC', 'Teknisi Elektronik', 'Troubleshooting'],
                'is_urgent' => true,
            ],
            [
                'title' => 'Jasa Pembersihan Rumah Mingguan',
                'description' => 'Mencari jasa pembersihan rumah yang bisa datang setiap minggu. Rumah 2 lantai dengan 4 kamar tidur. Pekerjaan meliputi menyapu, mengepel, membersihkan kamar mandi, dan merapikan ruangan.',
                'category_id' => $categories->where('slug', 'kebersihan-cleaning')->first()->id,
                'budget_min' => 150000,
                'budget_max' => 200000,
                'budget_type' => 'fixed',
                'location' => 'Bogor Barat, Bogor',
                'job_type' => 'part_time',
                'status' => 'active',
                'deadline' => null,
                'requirements' => ['Pengalaman cleaning service', 'Bisa datang setiap minggu', 'Membawa peralatan cleaning'],
                'skills_required' => ['House Cleaning', 'Manajemen Waktu', 'Ketelitian'],
                'is_urgent' => false,
            ],
            [
                'title' => 'Fotografi Produk untuk E-commerce',
                'description' => 'Saya memiliki bisnis online yang menjual aksesoris fashion. Membutuhkan fotografer untuk mengambil foto produk dengan kualitas tinggi untuk keperluan e-commerce. Sekitar 50 produk yang perlu difoto.',
                'category_id' => $categories->where('slug', 'fotografi-videografi')->first()->id,
                'budget_min' => 500000,
                'budget_max' => 800000,
                'budget_type' => 'fixed',
                'location' => 'Bogor Tengah, Bogor',
                'job_type' => 'freelance',
                'status' => 'active',
                'deadline' => now()->addDays(10),
                'requirements' => ['Portfolio fotografi produk', 'Kamera DSLR/Mirrorless', 'Lighting equipment'],
                'skills_required' => ['Product Photography', 'Photo Editing', 'Adobe Lightroom', 'Studio Setup'],
                'is_urgent' => false,
            ],
        ];

        foreach ($jobs as $jobData) {
            \App\Models\Job::create(array_merge($jobData, [
                'employer_id' => $employer->id,
                'approved_at' => now(),
                'approved_by' => 1, // Admin user ID
            ]));
        }
    }
}
