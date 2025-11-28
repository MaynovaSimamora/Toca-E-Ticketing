<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Booking;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        $tickets = Ticket::all();

        if ($users->isEmpty() || $tickets->isEmpty()) {
            $this->command->error('Users or Tickets not found!');
            return;
        }

        // Booking 1 - Approved
        Booking::create([
            'user_id' => $users[0]->id,
            'ticket_id' => $tickets[0]->id,
            'quantity' => 2,
            'total_price' => $tickets[0]->price * 2,
            'status' => 'approved',
            'created_at' => Carbon::now()->subDays(5),
        ]);

        // Booking 2 - Approved
        Booking::create([
            'user_id' => $users[1]->id,
            'ticket_id' => $tickets[3]->id,
            'quantity' => 1,
            'total_price' => $tickets[3]->price,
            'status' => 'approved',
            'created_at' => Carbon::now()->subDays(3),
        ]);

        // Booking 3 - Pending
        Booking::create([
            'user_id' => $users[0]->id,
            'ticket_id' => $tickets[5]->id,
            'quantity' => 3,
            'total_price' => $tickets[5]->price * 3,
            'status' => 'pending',
            'created_at' => Carbon::now()->subDays(1),
        ]);

        // Booking 4 - Approved
        Booking::create([
            'user_id' => $users[2]->id,
            'ticket_id' => $tickets[8]->id,
            'quantity' => 5,
            'total_price' => $tickets[8]->price * 5,
            'status' => 'approved',
            'created_at' => Carbon::now()->subDays(7),
        ]);

        // Booking 5 - Cancelled
        Booking::create([
            'user_id' => $users[1]->id,
            'ticket_id' => $tickets[10]->id,
            'quantity' => 1,
            'total_price' => $tickets[10]->price,
            'status' => 'cancelled',
            'created_at' => Carbon::now()->subDays(10),
        ]);

        $this->command->info('✅ 5 Bookings created!');
    }
}
