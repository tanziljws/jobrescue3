<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Desain Grafis',
                'slug' => 'desain-grafis',
                'description' => 'Jasa desain logo, banner, brosur, dan materi visual lainnya',
                'icon' => '🎨',
                'is_active' => true,
            ],
            [
                'name' => 'Catering & Kuliner',
                'slug' => 'catering-kuliner',
                'description' => 'Layanan catering untuk event, makanan rumahan, dan jasa kuliner',
                'icon' => '🍽️',
                'is_active' => true,
            ],
            [
                'name' => 'Teknisi & Perbaikan',
                'slug' => 'teknisi-perbaikan',
                'description' => 'Jasa perbaikan elektronik, AC, komputer, dan peralatan rumah tangga',
                'icon' => '🔧',
                'is_active' => true,
            ],
            [
                'name' => 'Kebersihan & Cleaning',
                'slug' => 'kebersihan-cleaning',
                'description' => 'Jasa pembersihan rumah, kantor, dan area komersial',
                'icon' => '🧹',
                'is_active' => true,
            ],
            [
                'name' => 'Fotografi & Videografi',
                'slug' => 'fotografi-videografi',
                'description' => 'Jasa foto dan video untuk event, produk, dan dokumentasi',
                'icon' => '📸',
                'is_active' => true,
            ],
            [
                'name' => 'Transportasi & Logistik',
                'slug' => 'transportasi-logistik',
                'description' => 'Jasa pengiriman, pindahan, dan transportasi barang',
                'icon' => '🚚',
                'is_active' => true,
            ],
            [
                'name' => 'Event Organizer',
                'slug' => 'event-organizer',
                'description' => 'Jasa penyelenggaraan acara, dekorasi, dan manajemen event',
                'icon' => '🎉',
                'is_active' => true,
            ],
            [
                'name' => 'Tukang & Konstruksi',
                'slug' => 'tukang-konstruksi',
                'description' => 'Jasa tukang bangunan, renovasi, dan perbaikan rumah',
                'icon' => '🏗️',
                'is_active' => true,
            ],
            [
                'name' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'description' => 'Jasa pemasaran digital, social media, dan promosi online',
                'icon' => '📱',
                'is_active' => true,
            ],
            [
                'name' => 'Pendidikan & Les',
                'slug' => 'pendidikan-les',
                'description' => 'Jasa les privat, kursus, dan bimbingan belajar',
                'icon' => '📚',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            \App\Models\JobCategory::create($category);
        }
    }
}
