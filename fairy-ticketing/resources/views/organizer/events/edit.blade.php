@extends('layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    <div class="max-w-3xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="text-7xl mb-4 wiggle-animation">✏️</div>
            <h1 class="text-5xl font-bold text-gray-800 mb-2">
                Edit Event
            </h1>
            <p class="text-xl text-gray-600 font-semibold">Make it even better! ✨</p>
        </div>

        <!-- Form -->
        <div class="toca-card p-8 bg-gradient-to-br from-white to-toca-blue/20">
            <form action="{{ route('organizer.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Event Name -->
                <div>
                    <label for="name" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        🎪 Event Name *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $event->name) }}" required
                        class="toca-input @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        📝 Description *
                    </label>
                    <textarea id="description" name="description" rows="6" required
                        class="toca-input @error('description') border-red-500 @enderror">{{ old('description', $event->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Event Date -->
                <div>
                    <label for="event_date" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        📅 Event Date & Time *
                    </label>
                    <input type="datetime-local" id="event_date" name="event_date" 
                        value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required
                        class="toca-input @error('event_date') border-red-500 @enderror">
                    @error('event_date')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        📍 Location *
                    </label>
                    <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" required
                        class="toca-input @error('location') border-red-500 @enderror">
                    @error('location')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Category -->
                <div>
                    <label for="category" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        🎭 Category
                    </label>
                    <select id="category" name="category" class="toca-input @error('category') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        <option value="Music" {{ old('category', $event->category) == 'Music' ? 'selected' : '' }}>🎵 Music</option>
                        <option value="Sports" {{ old('category', $event->category) == 'Sports' ? 'selected' : '' }}>⚽ Sports</option>
                        <option value="Arts" {{ old('category', $event->category) == 'Arts' ? 'selected' : '' }}>🎨 Arts</option>
                        <option value="Technology" {{ old('category', $event->category) == 'Technology' ? 'selected' : '' }}>💻 Technology</option>
                        <option value="Food" {{ old('category', $event->category) == 'Food' ? 'selected' : '' }}>🍔 Food</option>
                        <option value="Education" {{ old('category', $event->category) == 'Education' ? 'selected' : '' }}>📚 Education</option>
                        <option value="Business" {{ old('category', $event->category) == 'Business' ? 'selected' : '' }}>💼 Business</option>
                        <option value="Other" {{ old('category', $event->category) == 'Other' ? 'selected' : '' }}>✨ Other</option>
                    </select>
                    @error('category')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Current Image -->
                @if($event->image)
                <div>
                    <label class="block text-lg font-bold text-gray-800 mb-2">Current Image:</label>
                    <img src="{{ asset('storage/'.$event->image) }}" alt="{{ $event->name }}" 
                        class="w-full h-64 object-cover rounded-toca-xl border-4 border-gray-800">
                </div>
                @endif

                <!-- New Image -->
                <div>
                    <label for="image" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        🖼️ Change Image
                    </label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="toca-input @error('image') border-red-500 @enderror"
                        onchange="previewImage(event)">
                    <p class="mt-1 text-sm text-gray-600 font-semibold">Max 2MB (JPG, PNG)</p>
                    @error('image')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                    
                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <img id="preview" src="" alt="Preview" class="w-full h-64 object-cover rounded-toca-xl border-4 border-gray-800">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="toca-btn-blue flex-1">
                        Update Event! ✨
                    </button>
                    <a href="{{ route('organizer.dashboard') }}" class="toca-btn-outline flex-1 text-center">
                        Cancel ❌
                    </a>
                </div>
            </form>
        </div>

    </div>

</div>

<script>
    function previewImage(event) {
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        const file = event.target.files[0];
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewDiv.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
