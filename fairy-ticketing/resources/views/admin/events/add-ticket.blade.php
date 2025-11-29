@extends('layouts.app')

@section('title', 'Manage Tickets - '.$event->name)

@section('content')
<div class="container mx-auto px-4 py-12">

    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">
        Manage Tickets for "{{ $event->name }}"
    </h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 font-semibold rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form tambah tiket --}}
    <div class="toca-card-elegant p-6 mb-10 bg-white">
        <h2 class="text-2xl font-bold mb-4">Create New Ticket Type</h2>

        <form action="{{ route('admin.events.store-ticket', $event->id) }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1">Ticket Name</label>
                <input type="text" name="name" class="form-input w-full" required>
            </div>

            <div>
                <label class="block font-semibold mb-1">Description</label>
                <textarea name="description" class="form-textarea w-full" rows="3"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold mb-1">Price (Rp)</label>
                    <input type="number" name="price" class="form-input w-full" min="0" required>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Quota</label>
                    <input type="number" name="quota" class="form-input w-full" min="1" required>
                </div>
            </div>

            <button type="submit" class="toca-btn-pink px-8">
                Save Ticket 🎫
            </button>
        </form>
    </div>

    {{-- List tiket yang sudah ada --}}
    <div class="toca-card-elegant p-6 bg-white">
        <h2 class="text-2xl font-bold mb-4">Existing Tickets</h2>

        @if($tickets->count())
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b-2 border-gray-800">
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-left">Quota</th>
                        <th class="px-4 py-2 text-left">Remaining</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $ticket->name }}</td>
                            <td class="px-4 py-2">Rp {{ number_format($ticket->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-2">{{ $ticket->quota }}</td>
                            <td class="px-4 py-2">{{ $ticket->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No tickets yet for this event.</p>
        @endif
    </div>

</div>
@endsection
