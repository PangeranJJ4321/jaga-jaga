<?php
// Database\Seeders\BookingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua pengguna dengan peran 'user'
        $users = User::where('role', 'user')->get(); // Mengambil pengguna dengan role 'user'
        $events = Event::all(); // Ambil semua event yang ada

        // Looping melalui semua pengguna dan acara untuk membuat pemesanan
        foreach ($users as $user) {
            foreach ($events as $event) {
                // Tentukan jumlah tiket yang dipesan secara acak (1-5 tiket)
                $totalTickets = rand(1, 5);
                $totalPrice = $totalTickets * $event->harga_tiket; // Hitung total harga tiket

                // Buat pemesanan untuk pengguna dan acara yang sesuai
                Booking::create([
                    'user_id' => $user->id, // ID pengguna yang memesan
                    'event_id' => $event->id, // ID acara yang dipesan
                    'booking_date' => Carbon::now(), // Tanggal dan waktu pemesanan
                    'total_tickets' => $totalTickets, // Total tiket yang dipesan
                    'status' => 'confirmed', // Status pemesanan, misalnya 'confirmed'
                    'total_price' => $totalPrice, // Harga total tiket yang dipesan
                ]);
            }
        }
    }
}
