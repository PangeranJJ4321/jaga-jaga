<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'admin'
        ]);

        // Organizer
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Organizer ' . $i,
                'email' => 'organizer' . $i . '@gmail.com',
                'password' => Hash::make('1234567890'),
                'role' => 'organizer'
            ]);
        }

        // Attendee
        User::create([
            'name' => 'Attendee',
            'email' => 'attendee@gmail.com',
            'password' => Hash::make('1234567890'),
            'role' => 'user'
        ]);
    }
}
