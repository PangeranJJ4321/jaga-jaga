<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReviewSeeders2 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            [
                'event_id' => 36, // Ganti dengan ID event yang sesuai
                'user_id' => 7, // Ganti dengan ID user yang sesuai
                'review_text' => 'Ekyykuu munyuunnn❤❤❤',
                'rating' => 5,
                'review_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_id' => 36, // Ganti dengan ID event yang sesuai
                'user_id' => 7, // Ganti dengan ID user yang sesuai
                'review_text' => 'Good event, but the seating arrangement could be better.',
                'rating' => 5,
                'review_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'event_id' => 36, // Ganti dengan ID event yang sesuai
                'user_id' => 7, // Ganti dengan ID user yang sesuai
                'review_text' => 'The event was okay, but it started late.',
                'rating' => 5,
                'review_date' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
