<?php
// Database\Seeders\ReviewSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan semua pengguna dan acara
        $users = User::where('role', 'user')->orWhere('role', 'attendee')->get();
        $events = Event::all();

        foreach ($events as $event) {
            foreach ($users as $user) {
                // Membuat review untuk event oleh setiap user
                Review::create([
                    'event_id' => $event->id,
                    'user_id' => $user->id,
                    'review_text' => 'Ini adalah ulasan untuk event ' . $event->nama_acara,
                    'rating' => rand(1, 5), // Rating acak antara 1 hingga 5
                    'review_date' => Carbon::now()->subDays(rand(1, 30)) // Tanggal acak dalam 30 hari terakhir
                ]);
            }
        }
    }
}
