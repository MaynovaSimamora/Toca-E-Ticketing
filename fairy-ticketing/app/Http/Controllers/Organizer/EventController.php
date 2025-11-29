<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())
            ->orderBy('event_date', 'desc')
            ->paginate(10);

        return view('organizer.events.index', compact('events'));
    }

    public function create()
    {
        return view('organizer.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date|after:now',
            'location'    => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();

        // SIMPAN GAMBAR KE public/events DAN HANYA NAMA FILE
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);

            $data['image'] = $filename; // tanpa "events/"
        }

        Event::create($data);

        return redirect()->route('organizer.events.index')
            ->with('success', 'Event created successfully!');
    }

    public function edit(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('organizer.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'event_date'  => 'required|date',
            'location'    => 'required|string|max:255',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // UPDATE GAMBAR DI public/events
        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path('events/'.$event->image))) {
                @unlink(public_path('events/'.$event->image));
            }

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);

            $data['image'] = $filename; // penting: pakai $data, bukan $validated
        }

        $event->update($data);

        return redirect()->route('organizer.events.index')
            ->with('success', 'Event updated successfully!');
    }

    public function destroy(Event $event)
    {
        // Pastikan event ini milik organizer yang login
        if ($event->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($event->image && file_exists(public_path('events/'.$event->image))) {
            @unlink(public_path('events/'.$event->image));
        }

        $event->delete();

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    public function addTicket($eventId)
    {
        $event = Event::where('user_id', auth()->id())
            ->findOrFail($eventId);

        return view('organizer.tickets.create', compact('event'));
    }

    public function storeTicket(Request $request, $eventId)
    {
        $event = Event::where('user_id', auth()->id())
            ->findOrFail($eventId);

        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'quota'       => 'required|integer|min:1',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        $data['event_id']  = $eventId;
        $data['quantity'] = $request->quota;

        if ($request->hasFile('image')) {
            // untuk tiket masih boleh pakai storage publik
            $data['image'] = $request->file('image')->store('tickets', 'public');
        }

        Ticket::create($data);

        return redirect()->route('organizer.events.index')
            ->with('success', 'Ticket created successfully!');
    }
}
