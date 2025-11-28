<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin Fairy',
            'email' => 'admin@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        // Organizer 1 (Approved)
        User::create([
            'name' => 'Luna Events',
            'email' => 'organizer@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'status' => 'approved',
        ]);

        // Organizer 2 (Approved)
        User::create([
            'name' => 'Starlight Productions',
            'email' => 'starlight@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'status' => 'approved',
        ]);

        // Organizer Pending
        User::create([
            'name' => 'Pending Organizer',
            'email' => 'pending@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'organizer',
            'status' => 'pending',
        ]);

        // User 1
        User::create([
            'name' => 'Happy User',
            'email' => 'user@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'approved',
        ]);

        // User 2
        User::create([
            'name' => 'Alice Wonder',
            'email' => 'alice@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'approved',
        ]);

        // User 3
        User::create([
            'name' => 'Bob Builder',
            'email' => 'bob@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'approved',
        ]);

        // User 4
        User::create([
            'name' => 'Charlie Brown',
            'email' => 'charlie@fairy.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'approved',
        ]);

        $this->command->info('✅ 8 Users created!');
    }
}
