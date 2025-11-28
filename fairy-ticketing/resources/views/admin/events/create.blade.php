@extends('layouts.app')

@php
    $backgroundImage = 'admin.jpg';
@endphp

@section('title', 'Create Event - Admin')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    <div class="max-w-4xl mx-auto">
        
        <div class="text-center mb-8">
            <div class="text-7xl mb-4">🎪</div>
            <h1 class="text-5xl font-bold text-gray-800 mb-2">Create New Event</h1>
            <p class="text-xl text-gray-600 font-bold">Admin Event Creation ✨</p>
        </div>

        <div class="toca-card-elegant p-8 bg-gradient-to-br from-white to-purple-50 relative">
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-3xl">🎪</span>
                        <span>Event Name</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="toca-input-elegant @error('name') border-red-500 @enderror"
                        placeholder="e.g., Amazing Music Festival">
                    @error('name')
                        <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-3xl">📝</span>
                        <span>Description</span>
                    </label>
                    <textarea name="description" rows="4" required
                        class="toca-input-elegant @error('description') border-red-500 @enderror"
                        placeholder="Tell us about your event...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <span class="text-3xl">📍</span>
                            <span>Location</span>
                        </label>
                        <input type="text" name="location" value="{{ old('location') }}" required
                            class="toca-input-elegant @error('location') border-red-500 @enderror"
                            placeholder="e.g., Jakarta Convention Center">
                        @error('location')
                            <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <span class="text-3xl">📅</span>
                            <span>Event Date</span>
                        </label>
                        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}" required
                            class="toca-input-elegant @error('event_date') border-red-500 @enderror">
                        @error('event_date')
                            <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-3xl">🎭</span>
                        <span>Category</span>
                    </label>
                    <select name="category" required
                        class="toca-input-elegant @error('category') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                        <span class="text-3xl">🖼️</span>
                        <span>Event Image (Optional)</span>
                    </label>
                    <input type="file" name="image" accept="image/*"
                        class="toca-input-elegant @error('image') border-red-500 @enderror">
                    @error('image')
                        <p class="mt-2 text-red-600 font-bold text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 toca-btn-pink text-xl">
                        Create Event 🚀
                    </button>
                    <a href="{{ route('admin.events.index') }}" class="flex-1 toca-btn-elegant bg-gray-200 text-gray-800 text-xl text-center py-4">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
