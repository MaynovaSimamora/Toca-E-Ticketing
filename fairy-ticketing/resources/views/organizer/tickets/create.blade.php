@extends('layouts.app')

@section('title', 'Add Ticket')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <div class="text-7xl mb-4">🎫</div>
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                Add Ticket for: {{ $event->name }}
            </h1>
        </div>

        <div class="toca-card p-8 bg-gradient-to-br from-white to-toca-purple/20">
            <form action="{{ route('organizer.event.store-ticket', $event->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">
                @csrf

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-2">
                        🎫 Ticket Name *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="toca-input @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-2 text-red-600 text-sm font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-2">
                        📝 Description
                    </label>
                    <textarea name="description" rows="4"
                              class="toca-input @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-red-600 text-sm font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-2">
                        💰 Price (Rp) *
                    </label>
                    <input type="number" name="price" min="0" value="{{ old('price') }}" required
                           class="toca-input @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="mt-2 text-red-600 text-sm font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-2">
                        🔢 Quota (Total Tickets) *
                    </label>
                    <input type="number" name="quota" min="1" value="{{ old('quota') }}" required
                           class="toca-input @error('quota') border-red-500 @enderror">
                    @error('quota')
                        <p class="mt-2 text-red-600 text-sm font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-2">
                        🖼️ Ticket Image (optional)
                    </label>
                    <input type="file" name="image" accept="image/*"
                           class="toca-input @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="mt-2 text-red-600 text-sm font-bold">❌ {{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="toca-btn-pink flex-1">
                        Create Ticket 🚀
                    </button>
                    <a href="{{ route('organizer.events.index') }}" class="toca-btn-outline flex-1 text-center">
                        Cancel ❌
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
