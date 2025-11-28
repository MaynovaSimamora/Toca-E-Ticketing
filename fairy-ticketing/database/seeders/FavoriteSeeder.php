<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;
use App\Models\Favorite;

class FavoriteSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'user')->get();
        $events = Event::all();

        if ($users->isEmpty() || $events->isEmpty()) {
            $this->command->error('Users or Events not found!');
            return;
        }

        // User 1 favorites
        Favorite::create(['user_id' => $users[0]->id, 'event_id' => $events[0]->id]);
        Favorite::create(['user_id' => $users[0]->id, 'event_id' => $events[2]->id]);
        Favorite::create(['user_id' => $users[0]->id, 'event_id' => $events[4]->id]);

        // User 2 favorites
        Favorite::create(['user_id' => $users[1]->id, 'event_id' => $events[1]->id]);
        Favorite::create(['user_id' => $users[1]->id, 'event_id' => $events[3]->id]);

        // User 3 favorites
        Favorite::create(['user_id' => $users[2]->id, 'event_id' => $events[5]->id]);
        Favorite::create(['user_id' => $users[2]->id, 'event_id' => $events[7]->id]);

        $this->command->info('✅ 7 Favorites created!');
    }
}
