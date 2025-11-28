<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;

class TicketSeeder extends Seeder
{
    public function run()
    {
        // Tickets for Enchanted Music Festival (event_id: 1)
        Ticket::create([
            'event_id' => 1,
            'name' => 'VIP Pass',
            'description' => 'Access to VIP lounge, premium seating, meet & greet with artists, free drinks',
            'price' => 500000,
            'quota' => 100,
            'available' => 100,
        ]);

        Ticket::create([
            'event_id' => 1,
            'name' => 'Regular Pass',
            'description' => 'General admission to all performances and activities',
            'price' => 150000,
            'quota' => 500,
            'available' => 500,
        ]);

        Ticket::create([
            'event_id' => 1,
            'name' => 'Early Bird',
            'description' => 'Limited early bird tickets at special price',
            'price' => 100000,
            'quota' => 200,
            'available' => 50, // Almost sold out
        ]);

        // Tickets for Midnight Art Exhibition (event_id: 2)
        Ticket::create([
            'event_id' => 2,
            'name' => 'Premium Gallery Access',
            'description' => 'Private tour with curator, exclusive preview before opening',
            'price' => 250000,
            'quota' => 50,
            'available' => 50,
        ]);

        Ticket::create([
            'event_id' => 2,
            'name' => 'Standard Entry',
            'description' => 'General admission to all galleries',
            'price' => 75000,
            'quota' => 300,
            'available' => 300,
        ]);

        // Tickets for Tech Wizardry Conference (event_id: 3)
        Ticket::create([
            'event_id' => 3,
            'name' => 'Full Access Pass',
            'description' => 'All sessions, workshops, networking lunch, conference kit',
            'price' => 1000000,
            'quota' => 200,
            'available' => 200,
        ]);

        Ticket::create([
            'event_id' => 3,
            'name' => 'Student Ticket',
            'description' => 'Special price for students (ID required at entrance)',
            'price' => 300000,
            'quota' => 100,
            'available' => 100,
        ]);

        // Tickets for Starlight Food Festival (event_id: 4)
        Ticket::create([
            'event_id' => 4,
            'name' => 'Food Lover Pass',
            'description' => 'Entry + 10 food vouchers worth Rp 200,000',
            'price' => 200000,
            'quota' => 400,
            'available' => 400,
        ]);

        Ticket::create([
            'event_id' => 4,
            'name' => 'General Entry',
            'description' => 'Entry only (food purchased separately)',
            'price' => 50000,
            'quota' => 600,
            'available' => 600,
        ]);

        // Tickets for Fairy Tale Marathon (event_id: 5)
        Ticket::create([
            'event_id' => 5,
            'name' => 'Full Marathon',
            'description' => '42.2 KM - For experienced runners',
            'price' => 350000,
            'quota' => 500,
            'available' => 500,
        ]);

        Ticket::create([
            'event_id' => 5,
            'name' => '10K Run',
            'description' => '10 KM - Great for casual runners',
            'price' => 200000,
            'quota' => 800,
            'available' => 800,
        ]);

        Ticket::create([
            'event_id' => 5,
            'name' => '5K Fun Run',
            'description' => '5 KM - Perfect for families and beginners',
            'price' => 100000,
            'quota' => 1000,
            'available' => 1000,
        ]);

        // Tickets for Business Magic Summit (event_id: 6)
        Ticket::create([
            'event_id' => 6,
            'name' => 'Executive Package',
            'description' => 'VIP seating, networking dinner, exclusive workshops',
            'price' => 2500000,
            'quota' => 50,
            'available' => 50,
        ]);

        Ticket::create([
            'event_id' => 6,
            'name' => 'Standard Access',
            'description' => 'All main sessions and panel discussions',
            'price' => 750000,
            'quota' => 200,
            'available' => 200,
        ]);

        // Tickets for Educational Wonderland Expo (event_id: 7)
        Ticket::create([
            'event_id' => 7,
            'name' => 'Educator Pass',
            'description' => 'For teachers and educational professionals',
            'price' => 150000,
            'quota' => 300,
            'available' => 300,
        ]);

        Ticket::create([
            'event_id' => 7,
            'name' => 'Family Package',
            'description' => 'Entry for 2 adults + 2 children',
            'price' => 250000,
            'quota' => 200,
            'available' => 200,
        ]);

        Ticket::create([
            'event_id' => 7,
            'name' => 'Student Entry',
            'description' => 'Special price for students',
            'price' => 50000,
            'quota' => 500,
            'available' => 500,
        ]);

        // Sold Out Ticket Example
        Ticket::create([
            'event_id' => 1,
            'name' => 'Super Early Bird (SOLD OUT)',
            'description' => 'Limited super early bird - All sold out!',
            'price' => 75000,
            'quota' => 50,
            'available' => 0, // Sold out
        ]);
    }
}
