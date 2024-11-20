<?php
// Database\Seeders\CategorySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Concert/Music',
            'Trip/Camp',
            'Sport/Fitness',
            'Theater',
            'Cinema',
            'Workshop/Training'
        ];

        foreach ($categories as $categoryName) {
            // Mengubah nama kategori menjadi format slug, misalnya "Concert/Music" -> "concert-music"
            $slugName = Str::slug($categoryName, '-');

            // Tentukan path gambar di dalam folder public/category/
            $imagePathJpg = public_path("category/{$slugName}.jpg");
            $imagePathPng = public_path("category/{$slugName}.png");

            // Cek apakah file dengan ekstensi .jpg atau .png ada
            if (File::exists($imagePathJpg)) {
                $imagePath = "category/{$slugName}.jpg";
            } elseif (File::exists($imagePathPng)) {
                $imagePath = "category/{$slugName}.png";
            } else {
                // Jika tidak ada file gambar, gunakan gambar default
                $imagePath = "category/default.jpg";
            }

            // Buat kategori dengan path gambar yang ditemukan
            Category::create([
                'category_name' => $categoryName,
                'gambar' => $imagePath
            ]);
        }
    }
}
