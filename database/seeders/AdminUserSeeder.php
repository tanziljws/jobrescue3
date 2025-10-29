<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        \App\Models\User::create([
            'name' => 'Admin Job Rescue',
            'email' => 'admin@jobrescue.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Pajajaran No. 1, Bogor Tengah',
            'city' => 'Bogor',
            'district' => 'Bogor Tengah',
            'subdistrict' => 'Tegallega',
            'bio' => 'Administrator sistem Job Rescue',
            'is_verified' => true,
            'is_active' => true,
            'verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Create sample employer
        \App\Models\User::create([
            'name' => 'PT. Bogor Sejahtera',
            'email' => 'employer@example.com',
            'password' => bcrypt('password'),
            'role' => 'employer',
            'phone' => '081234567891',
            'address' => 'Jl. Raya Bogor No. 123',
            'city' => 'Bogor',
            'district' => 'Bogor Utara',
            'subdistrict' => 'Tanah Sareal',
            'bio' => 'Perusahaan yang bergerak di bidang UMKM dan membutuhkan berbagai jasa profesional',
            'is_verified' => true,
            'is_active' => true,
            'verified_at' => now(),
            'email_verified_at' => now(),
        ]);

        // Create sample workers
        $workers = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad@example.com',
                'skills' => ['Desain Grafis', 'Adobe Photoshop', 'Illustrator'],
                'bio' => 'Desainer grafis berpengalaman 5 tahun, spesialis logo dan branding',
            ],
            [
                'name' => 'Sari Dewi',
                'email' => 'sari@example.com',
                'skills' => ['Catering', 'Masak', 'Event Planning'],
                'bio' => 'Chef profesional dengan pengalaman catering untuk berbagai acara',
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'skills' => ['Teknisi AC', 'Elektronik', 'Perbaikan'],
                'bio' => 'Teknisi AC dan elektronik bersertifikat dengan pengalaman 8 tahun',
            ],
        ];

        foreach ($workers as $index => $worker) {
            \App\Models\User::create([
                'name' => $worker['name'],
                'email' => $worker['email'],
                'password' => bcrypt('password'),
                'role' => 'worker',
                'phone' => '08123456789' . ($index + 2),
                'address' => 'Jl. Contoh No. ' . ($index + 1) . ', Bogor',
                'city' => 'Bogor',
                'district' => 'Bogor Selatan',
                'subdistrict' => 'Bogor Selatan',
                'bio' => $worker['bio'],
                'skills' => $worker['skills'],
                'is_verified' => true,
                'is_active' => true,
                'verified_at' => now(),
                'email_verified_at' => now(),
                'rating' => rand(40, 50) / 10, // Random rating between 4.0-5.0
                'total_reviews' => rand(5, 25),
            ]);
        }
    }
}
