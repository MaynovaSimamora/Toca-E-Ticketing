<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        $organizer1 = User::where('email', 'organizer@fairy.com')->first();
        $organizer2 = User::where('email', 'starlight@fairy.com')->first();

        if (!$organizer1 || !$organizer2) {
            $this->command->error('Organizers not found!');
            return;
        }

        // Event 1 - Luna Events
        $event1 = Event::create([
            'user_id' => $organizer1->id,
            'name' => 'Enchanted Music Festival',
            'description' => 'A magical night filled with enchanting melodies and mystical performances! Join us for an unforgettable musical journey under the stars. ✨🎵',
            'location' => 'Fairy Garden Arena, Jakarta',
            'event_date' => Carbon::now()->addDays(30)->setTime(19, 0),
            'category' => 'Music',
        ]);
        Ticket::create(['event_id' => $event1->id, 'name' => 'Early Bird', 'price' => 150000, 'quantity' => 100]);
        Ticket::create(['event_id' => $event1->id, 'name' => 'Regular', 'price' => 250000, 'quantity' => 200]);
        Ticket::create(['event_id' => $event1->id, 'name' => 'VIP', 'price' => 500000, 'quantity' => 50]);

        // Event 2 - Luna Events
        $event2 = Event::create([
            'user_id' => $organizer1->id,
            'name' => 'Midnight Art Exhibition',
            'description' => 'Explore the world of contemporary art in this exclusive midnight exhibition. Featuring works from renowned artists across the globe. 🎨🌙',
            'location' => 'Crystal Gallery, Bandung',
            'event_date' => Carbon::now()->addDays(15)->setTime(20, 0),
            'category' => 'Art',
        ]);
        Ticket::create(['event_id' => $event2->id, 'name' => 'General Admission', 'price' => 75000, 'quantity' => 150]);
        Ticket::create(['event_id' => $event2->id, 'name' => 'Premium Access', 'price' => 150000, 'quantity' => 50]);

        // Event 3 - Starlight Productions
        $event3 = Event::create([
            'user_id' => $organizer2->id,
            'name' => 'Tech Wizardry Conference 2025',
            'description' => 'The biggest technology conference of the year! Learn from industry leaders, network with innovators, and discover the latest tech trends. 💻🚀',
            'location' => 'Innovation Hub, Surabaya',
            'event_date' => Carbon::now()->addDays(45)->setTime(9, 0),
            'category' => 'Technology',
        ]);
        Ticket::create(['event_id' => $event3->id, 'name' => 'Student Pass', 'price' => 100000, 'quantity' => 100]);
        Ticket::create(['event_id' => $event3->id, 'name' => 'Professional', 'price' => 300000, 'quantity' => 200]);
        Ticket::create(['event_id' => $event3->id, 'name' => 'All Access Pass', 'price' => 750000, 'quantity' => 30]);

        // Event 4 - Starlight Productions
        $event4 = Event::create([
            'user_id' => $organizer2->id,
            'name' => 'Starlight Food Festival',
            'description' => 'A culinary adventure featuring the best street food, gourmet dishes, and desserts from around the world! 🍔🍰✨',
            'location' => 'Moonlight Park, Jakarta',
            'event_date' => Carbon::now()->addDays(20)->setTime(11, 0),
            'category' => 'Food',
        ]);
        Ticket::create(['event_id' => $event4->id, 'name' => 'Basic Entry', 'price' => 50000, 'quantity' => 300]);
        Ticket::create(['event_id' => $event4->id, 'name' => 'Food Lover Pass', 'price' => 150000, 'quantity' => 100]);

        // Event 5 - Luna Events
        $event5 = Event::create([
            'user_id' => $organizer1->id,
            'name' => 'Fairy Tale Marathon',
            'description' => 'Run through magical landscapes in this fun marathon event! 5K, 10K, and 21K categories available. Perfect for all fitness levels! 🏃‍♀️🌈',
            'location' => 'Rainbow Fields, Bali',
            'event_date' => Carbon::now()->addDays(60)->setTime(6, 0),
            'category' => 'Sports',
        ]);
        Ticket::create(['event_id' => $event5->id, 'name' => '5K Fun Run', 'price' => 100000, 'quantity' => 500]);
        Ticket::create(['event_id' => $event5->id, 'name' => '10K Challenge', 'price' => 150000, 'quantity' => 300]);
        Ticket::create(['event_id' => $event5->id, 'name' => 'Half Marathon 21K', 'price' => 250000, 'quantity' => 200]);

        // Event 6 - Starlight Productions
        $event6 = Event::create([
            'user_id' => $organizer2->id,
            'name' => 'Laughing Stars Comedy Night',
            'description' => 'Get ready to laugh until your cheeks hurt! Featuring top comedians and hilarious sketches. A night of pure comedy gold! 😂🎭',
            'location' => 'Giggle Theater, Jakarta',
            'event_date' => Carbon::now()->addDays(10)->setTime(19, 30),
            'category' => 'Entertainment',
        ]);
        Ticket::create(['event_id' => $event6->id, 'name' => 'Standard Seating', 'price' => 200000, 'quantity' => 150]);
        Ticket::create(['event_id' => $event6->id, 'name' => 'Premium Seating', 'price' => 400000, 'quantity' => 50]);

        // Event 7 - Luna Events
        $event7 = Event::create([
            'user_id' => $organizer1->id,
            'name' => 'Creative Design Workshop',
            'description' => 'Learn the secrets of professional design! This hands-on workshop covers graphic design, UI/UX, and creative thinking. 🎨💡',
            'location' => 'Design Studio, Bandung',
            'event_date' => Carbon::now()->addDays(25)->setTime(10, 0),
            'category' => 'Education',
        ]);
        Ticket::create(['event_id' => $event7->id, 'name' => 'Workshop Pass', 'price' => 350000, 'quantity' => 50]);
        Ticket::create(['event_id' => $event7->id, 'name' => 'Workshop + Materials', 'price' => 500000, 'quantity' => 30]);

        // Event 8 - Starlight Productions
        $event8 = Event::create([
            'user_id' => $organizer2->id,
            'name' => 'Rhythm & Beats Dance Festival',
            'description' => 'Dance the night away at the biggest dance festival of the year! EDM, Hip-Hop, and Contemporary performances. 💃🎶',
            'location' => 'Starlight Arena, Bali',
            'event_date' => Carbon::now()->addDays(50)->setTime(18, 0),
            'category' => 'Music',
        ]);
        Ticket::create(['event_id' => $event8->id, 'name' => 'General Admission', 'price' => 300000, 'quantity' => 500]);
        Ticket::create(['event_id' => $event8->id, 'name' => 'VIP Lounge', 'price' => 750000, 'quantity' => 100]);
        Ticket::create(['event_id' => $event8->id, 'name' => 'Backstage Pass', 'price' => 1500000, 'quantity' => 20]);

        // Event 9 - Luna Events
        $event9 = Event::create([
            'user_id' => $organizer1->id,
            'name' => 'Magical Books Fair 2025',
            'description' => 'A paradise for book lovers! Browse thousands of books, meet authors, and enjoy literary activities. 📚✨',
            'location' => 'Grand Library, Yogyakarta',
            'event_date' => Carbon::now()->addDays(35)->setTime(9, 0),
            'category' => 'Education',
        ]);
        Ticket::create(['event_id' => $event9->id, 'name' => 'Day Pass', 'price' => 25000, 'quantity' => 1000]);
        Ticket::create(['event_id' => $event9->id, 'name' => 'Weekend Pass', 'price' => 50000, 'quantity' => 500]);

        // Event 10 - Starlight Productions
        $event10 = Event::create([
            'user_id' => $organizer2->id,
            'name' => 'Epic Gaming Championship',
            'description' => 'The ultimate esports tournament! Compete in various games, win prizes, and become a champion! 🎮🏆',
            'location' => 'Cyber Arena, Jakarta',
            'event_date' => Carbon::now()->addDays(40)->setTime(14, 0),
            'category' => 'Gaming',
        ]);
        Ticket::create(['event_id' => $event10->id, 'name' => 'Spectator Pass', 'price' => 100000, 'quantity' => 200]);
        Ticket::create(['event_id' => $event10->id, 'name' => 'Player Registration', 'price' => 250000, 'quantity' => 100]);
        Ticket::create(['event_id' => $event10->id, 'name' => 'VIP Spectator', 'price' => 300000, 'quantity' => 50]);

        $this->command->info('✅ 10 Events with 28 Tickets created!');
    }
}
