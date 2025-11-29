@extends('layouts.app')

@section('title', 'My Events')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold mb-6">My Events</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 font-semibold rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6">
        <a href="{{ route('organizer.events.create') }}" class="toca-btn-pink">
            + Create New Event
        </a>
    </div>

    @if($events->count())
        <ul class="space-y-4">
            @foreach($events as $event)
                <li class="toca-card p-4 bg-white flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold">{{ $event->name }}</h2>
                        <p class="text-gray-600 text-sm">
                            {{ $event->event_date->format('d M Y, H:i') }} • {{ $event->location }}
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('organizer.events.edit', $event->id) }}" class="toca-btn-blue text-sm">
                            Edit
                        </a>
                        <a href="{{ route('organizer.event.add-ticket', $event->id) }}" class="toca-btn-purple text-sm">
                            Add Ticket
                        </a>
                        <form action="{{ route('organizer.events.destroy', $event->id) }}" method="POST"
                              onsubmit="return confirm('Delete this event?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="toca-btn-outline-red text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>

        <div class="mt-6">
            {{ $events->links() }}
        </div>
    @else
        <p class="text-gray-600 font-semibold">
            You don't have any events yet. Create one!
        </p>
    @endif
</div>
@endsection
