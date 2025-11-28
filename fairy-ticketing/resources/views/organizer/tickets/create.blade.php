@extends('layouts.app')

@section('title', 'Add Ticket')

@section('content')
<div class="container mx-auto px-4 py-12">
    
    <div class="max-w-3xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="text-7xl mb-4 bounce-animation">🎫</div>
            <h1 class="text-5xl font-bold text-gray-800 mb-2">
                Add Ticket Type
            </h1>
            <p class="text-xl text-gray-600 font-semibold">
                For: <span class="text-toca-pink">{{ $event->name }}</span>
            </p>
        </div>

        <!-- Form -->
        <div class="toca-card p-8 bg-gradient-to-br from-white to-toca-green/20">
            <form action="{{ route('organizer.event.store-ticket', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Ticket Name -->
                <div>
                    <label for="name" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        🎟️ Ticket Name *
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="toca-input @error('name') border-red-500 @enderror"
                        placeholder="e.g., VIP, Regular, Early Bird">
                    @error('name')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        📝 Description
                    </label>
                    <textarea id="description" name="description" rows="4"
                        class="toca-input @error('description') border-red-500 @enderror"
                        placeholder="What's included in this ticket...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        💰 Price (Rp) *
                    </label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" step="1000" required
                        class="toca-input @error('price') border-red-500 @enderror"
                        placeholder="50000">
                    @error('price')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Quota -->
                <div>
                    <label for="quota" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        🔢 Total Quota *
                    </label>
                    <input type="number" id="quota" name="quota" value="{{ old('quota') }}" min="1" required
                        class="toca-input @error('quota') border-red-500 @enderror"
                        placeholder="100">
                    @error('quota')
                        <p class="mt-2 text-red-600 font-bold text-sm flex items-center gap-1">
                            ❌ {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Image -->
                <div>
                    <label for="image" class="block text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                        🖼️ Ticket Image
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
                        <img id="preview" src="" alt="Preview" class="w-full h-48 object-cover rounded-toca-xl border-4 border-gray-800">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4">
                    <button type="submit" class="toca-btn-purple flex-1">
                        Create Ticket! 🎉
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
