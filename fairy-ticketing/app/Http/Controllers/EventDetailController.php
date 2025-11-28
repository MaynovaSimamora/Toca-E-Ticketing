<?php
namespace App\Http\Controllers;

use App\Models\Event;

class EventDetailController extends Controller
{
    public function show($id)
    {
        $event = Event::with(['user', 'tickets'])->findOrFail($id);
        
        $isFavorited = false;
        if (auth()->check()) {
            $isFavorited = $event->isFavoritedBy(auth()->id());
        }

        return view('event-detail', compact('event', 'isFavorited'));
    }
}
