@extends('layouts.app')

@php
    $backgroundImage = 'admin.jpg';
@endphp

@section('title', 'Edit Event - Admin')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-6 text-center">Edit Event (Admin)</h1>

        <div class="toca-card-elegant p-8 bg-gradient-to-br from-white to-purple-50">
            <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label class="block font-bold mb-2">Event Name</label>
                    <input type="text" name="name" value="{{ old('name', $event->name) }}" class="toca-input-elegant" required>
                </div>

                <!-- Description -->
                <div>
                    <label class="block font-bold mb-2">Description</label>
                    <textarea name="description" rows="4" class="toca-input-elegant" required>{{ old('description', $event->description) }}</textarea>
                </div>

                <!-- Location & Date -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-bold mb-2">Location</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="toca-input-elegant" required>
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Event Date</label>
                        <input type="datetime-local" name="event_date"
                               value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}"
                               class="toca-input-elegant" required>
                    </div>
                </div>

                <!-- Category -->
                <div>
                    <label class="block font-bold mb-2">Category</label>
                    <select name="category" class="toca-input-elegant" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category', $event->category) == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Image -->
                <div>
                    <label class="block font-bold mb-2">Event Image (optional)</label>
                    @if($event->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->name }}" class="w-40 h-24 object-cover rounded-xl border-2 border-gray-800">
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" class="toca-input-elegant">
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="flex-1 toca-btn-pink text-xl">
                        Save Changes 💾
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
