<?php

// Database\Seeders\TicketSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Booking;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Ambil semua booking yang ada
        $bookings = Booking::all();

        foreach ($bookings as $booking) {
            // Untuk setiap booking, buat tiket
            for ($i = 1; $i <= $booking->total_tickets; $i++) {
                // Membuat kode tiket yang unik
                $ticketCode = Str::random(10); // Menghasilkan kode tiket acak sepanjang 10 karakter

                Ticket::create([
                    'booking_id' => $booking->id,
                    'event_id' => $booking->event_id,
                    'ticket_code' => $ticketCode,
                    'status' => 'active', // Status tiket awal adalah 'active'
                ]);
            }
        }
    }
}

