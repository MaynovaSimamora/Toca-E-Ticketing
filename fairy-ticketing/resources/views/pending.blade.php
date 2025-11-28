@extends('layouts.app')

@php
    $backgroundImage = 'default.jpg';
@endphp

@section('title', 'Account Pending')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto text-center">
        <div class="toca-card-elegant p-12 bg-gradient-to-br from-white to-yellow-50 relative">
            
            <div class="text-8xl mb-6">⏰</div>
            
            <h1 class="text-5xl font-bold text-gray-800 mb-4">
                Hold On! ✋
            </h1>

            @if(auth()->user()->status === 'pending')
                <p class="text-2xl text-gray-700 font-semibold mb-8">
                    Your organizer account is being reviewed! 🔍
                </p>
                
                <div class="bg-yellow-100 border-4 border-gray-800 rounded-3xl p-6 mb-8">
                    <p class="text-gray-800 font-bold text-lg">
                        📧 We'll send you an email when your account is approved!<br>
                        Usually takes 1-2 days. Stay tuned! 🎉
                    </p>
                </div>

                <div class="flex items-center justify-center gap-3 mb-8">
                    <span class="text-4xl">🎈</span>
                    <span class="text-4xl">🎨</span>
                    <span class="text-4xl">✨</span>
                </div>
            @else
                <p class="text-2xl text-red-600 font-bold mb-8">
                    Sorry! Your application was not approved. 😔
                </p>
                
                <div class="bg-red-100 border-4 border-gray-800 rounded-3xl p-6 mb-8">
                    <p class="text-gray-800 font-bold text-lg">
                        You can delete your account and try again,<br>
                        or contact our support team! 💬
                    </p>
                </div>

                <form method="POST" action="{{ route('delete.account') }}" 
                    onsubmit="return confirm('Are you sure? This cannot be undone! 😱')" class="mb-6">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="toca-btn-elegant bg-red-500 text-white px-8 py-4 text-lg">
                        🗑️ Delete Account
                    </button>
                </form>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="toca-btn-elegant bg-gray-200 text-gray-800 px-8 py-4 text-lg">
                    🚪 Logout
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
