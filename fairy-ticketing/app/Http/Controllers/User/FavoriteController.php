<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Favorite;

class FavoriteController extends Controller
{
    public function toggle($eventId)
    {
        $event = Event::findOrFail($eventId);
        
        $favorite = Favorite::where('user_id', auth()->id())
            ->where('event_id', $eventId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return back()->with('success', 'Removed from favorites!');
        } else {
            Favorite::create([
                'user_id' => auth()->id(),
                'event_id' => $eventId,
            ]);
            return back()->with('success', 'Added to favorites!');
        }
    }
}
