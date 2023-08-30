<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Web Artikel',
                'slug' => 'web-artikel'
            ],
            [
                'name' => 'Web Profile',
                'slug' => 'web-profile'
            ],
            [
                'name' => 'Web bio',
                'slug' => 'web-bio'
            ],
            [
                'name' => 'Web Forum',
                'slug' => 'web-forum'
            ],
            [
                'name' => 'Web Edu (Pendidikan)',
                'slug' => 'web-edu'
            ],
            [
                'name' => 'Web Gov (Pemerintahan)',
                'slug' => 'web-gov'
            ],
            [
                'name' => 'Web Komen (Komentar)',
                'slug' => 'web-komen'
            ],
            [
                'name' => 'Media sosial',
                'slug' => 'media-sosial'
            ],
            [
                'name' => 'Premium',
                'slug' => 'premium'
            ]
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
