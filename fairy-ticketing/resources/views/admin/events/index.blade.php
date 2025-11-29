@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    <!-- Header -->
    <div class="text-center mb-12">
        <div class="text-7xl mb-4 wiggle-animation">🎪</div>
        <h1 class="text-5xl font-bold text-gray-800 mb-2">
            Manage Events
        </h1>
        <p class="text-2xl text-gray-600 font-semibold">View & manage all events</p>
    </div>

    <!-- Events Table -->
    <div class="toca-card p-8 bg-gradient-to-br from-white to-toca-mint/20">
        @if($events->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-4 border-gray-800">
                            <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Event Name</th>
                            <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Organizer</th>
                            <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Date</th>
                            <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Location</th>
                            <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Category</th>
                            <th class="text-left py-4 px-4 text-gray-800 font-bold text-lg">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                        <tr class="border-b-2 border-gray-200 hover:bg-toca-peach/20 transition-all">
                            <td class="py-4 px-4 text-gray-800 font-bold">{{ $event->name }}</td>
                            <td class="py-4 px-4 text-gray-700 font-semibold">{{ $event->user->name }}</td>
                            <td class="py-4 px-4 text-gray-700 font-semibold text-sm">
                                {{ $event->event_date->format('d M Y, H:i') }}
                            </td>
                            <td class="py-4 px-4 text-gray-700 font-semibold text-sm">{{ $event->location }}</td>
                            <td class="py-4 px-4">
                                @if($event->category)
                                    <span class="toca-badge-purple text-xs">{{ $event->category }}</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex flex-wrap items-center gap-3">
                                    <!-- View -->
                                    <a href="{{ route('event.show', $event->id) }}" 
                                       class="text-toca-blue hover:text-blue-700 font-bold text-sm">
                                        👁️ View
                                    </a>

                                    <!-- Edit (ADMIN) -->
                                    <a href="{{ route('admin.events.edit', $event->id) }}" 
                                       class="text-yellow-600 hover:text-yellow-700 font-bold text-sm">
                                        ✏️ Edit
                                    </a>

                                    <!-- Manage Tickets (ADMIN) -->
                                    <a href="{{ route('admin.events.add-ticket', $event->id) }}"
                                       class="toca-btn-green text-center py-1 px-3 text-xs font-bold">
                                        🎫 Manage Tickets
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
                                          onsubmit="return confirm('Delete this event? 🗑️')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700 font-bold text-sm">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $events->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-8xl mb-4 bounce-animation">🎪</div>
                <p class="text-2xl text-gray-600 font-bold">No events yet!</p>
            </div>
        @endif
    </div>

</div>
@endsection
