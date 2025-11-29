<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')->orderBy('event_date', 'desc')->paginate(15);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $categories = ['Music', 'Art', 'Technology', 'Food', 'Sports', 'Entertainment', 'Education', 'Gaming'];
        return view('admin.events.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'event_date'  => 'required|date',
            'category'    => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        $validated['user_id'] = auth()->id(); // admin sebagai pembuat event

        // SIMPAN GAMBAR KE public/events DAN HANYA NAMA FILE DI DB
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);

            $validated['image'] = $filename; // tanpa "events/"
        }

        Event::create($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event created successfully! 🎉');
    }

    public function edit(Event $event)
    {
        $categories = ['Music', 'Art', 'Technology', 'Food', 'Sports', 'Entertainment', 'Education', 'Gaming'];
        return view('admin.events.edit', compact('event', 'categories'));
    }

    public function addTicket(Event $event)
    {
        $tickets = $event->tickets()->orderBy('price')->get();

        return view('admin.events.add-ticket', compact('event', 'tickets'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'location'    => 'required|string|max:255',
            'event_date'  => 'required|date',
            'category'    => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        // UPDATE GAMBAR (hapus lama di public/events, simpan baru, simpan nama file)
        if ($request->hasFile('image')) {
            if ($event->image && file_exists(public_path('events/' . $event->image))) {
                @unlink(public_path('events/' . $event->image));
            }

            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('events'), $filename);

            $validated['image'] = $filename; // tanpa "events/"
        }

        $event->update($validated);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully! ✨');
    }

    public function destroy(Event $event)
    {
        // HAPUS FILE DI public/events JUGA
        if ($event->image && file_exists(public_path('events/' . $event->image))) {
            @unlink(public_path('events/' . $event->image));
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully!');
    }

    public function storeTicket(Request $request, Event $event)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|integer|min:0',
            'quota'       => 'required|integer|min:1',
        ]);

        // saat create tiket baru, quantity awal = quota
        $validated['event_id']  = $event->id;
        $validated['quantity']  = $validated['quota'];

        Ticket::create($validated);

        return redirect()
            ->route('admin.events.add-ticket', $event->id)
            ->with('success', 'Ticket created successfully!');
    }
}
