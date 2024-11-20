<?php

// Database\Seeders\EventSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua pengguna dengan peran 'organizer'
        $organizers = User::where('role', 'organizer')->get();
        // Ambil semua kategori
        $categories = Category::all();

        foreach ($categories as $category) {
            foreach ($organizers as $organizer) {
                for ($i = 1; $i <= 3; $i++) {
                    Event::create([
                        'user_id' => $organizer->id,
                        'nama_acara' => 'Event ' . $i . ' - ' . $category->category_name,
                        'deskripsi' => 'Deskripsi untuk Event ' . $i . ' pada kategori ' . $category->category_name,
                        'tanggal_waktu' => Carbon::now()->addDays(rand(1, 30)),
                        'lokasi' => 'Lokasi Event ' . $i,
                        'harga_tiket' => rand(100, 500),
                        'kouta_tiket' => rand(50, 200),
                        'gambar_acara' => $category->gambar 
                    ]);
                }
            }
        }
    }
}
