@extends('layouts.app')

@php
    $backgroundImage = 'home.jpg';
@endphp

@section('title', 'Home')

@section('content')
<div class="relative overflow-hidden">
    
    <div class="container mx-auto px-4 py-16">
        
        <div class="text-center max-w-4xl mx-auto mb-16">
            
            <div class="mb-8">
                <div class="flex justify-center gap-4 mb-6">
                    <span class="text-7xl">🎈</span>
                    <span class="text-7xl">🎪</span>
                    <span class="text-7xl">🎉</span>
                </div>
                
                <h1 class="text-6xl md:text-7xl font-bold text-gray-800 mb-4 leading-tight">
                    Find Your Next
                    <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-500 via-purple-500 to-blue-500">
                        Adventure!
                    </span>
                </h1>
                
                <p class="text-2xl md:text-3xl font-bold text-gray-700 mt-6">
                    Book tickets & have amazing fun! 🌟
                </p>
            </div>
            
            <div class="relative max-w-3xl mx-auto">
                <form action="{{ route('home') }}" method="GET">
                    <div class="toca-card-elegant p-6 bg-gradient-to-br from-white to-orange-50 relative">
                        
                        <div class="relative mb-4">
                            <span class="absolute left-6 top-1/2 -translate-y-1/2 text-3xl">🔍</span>
                            <input type="text" 
                                name="search" 
                                value="{{ request('search') }}" 
                                placeholder="Search for awesome events..." 
                                class="w-full pl-20 pr-6 py-5 text-xl font-bold text-gray-800 bg-white border-4 border-gray-800 rounded-full shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)] focus:outline-none focus:shadow-[6px_6px_0px_0px_rgba(0,0,0,0.3)] transition-all">
                        </div>
                        
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1 relative">
                                <span class="absolute left-6 top-1/2 -translate-y-1/2 text-2xl">🎭</span>
                                <select name="category" 
                                    class="w-full pl-16 pr-6 py-4 text-lg font-bold text-gray-800 bg-white border-4 border-gray-800 rounded-full shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)] focus:outline-none transition-all">
                                    <option value="">All Categories</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <button type="submit" class="toca-btn-pink text-xl px-10">
                                Let's Go! 🚀
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="bg-white py-16">
        <div class="container mx-auto px-4">
            
            @if($events->count() > 0)
                <div class="text-center mb-12">
                    <h2 class="text-5xl font-bold text-gray-800 mb-4 inline-block relative">
                        Amazing Events
                        <span class="absolute -top-6 -right-10 text-4xl">✨</span>
                    </h2>
                    <p class="text-xl text-gray-600 font-semibold mt-2">
                        Discover the best events around you! 🎪
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($events as $event)
                        <div class="fade-in">
                            <div class="toca-card-elegant overflow-hidden bg-white relative subtle-hover">
                                
                                <div class="relative overflow-hidden h-64">
                                    @if($event->image)
                                        <img src="{{ asset('events/'.$event->image) }}" 
                                            alt="{{ $event->name }}" 
                                            class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="absolute inset-0 bg-gradient-to-br from-toca-pink via-toca-purple to-toca-blue flex items-center justify-center">
                                            <span class="text-8xl">🎪</span>
                                        </div>
                                    @endif
                                    
                                    @if($event->category)
                                    <div class="absolute top-4 right-4">
                                        <span class="toca-badge-elegant bg-gradient-to-r from-purple-500 to-pink-500 text-white">
                                            {{ $event->category }}
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                
                                <div class="p-6 bg-gradient-to-br from-white to-orange-50">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-3">
                                        {{ $event->name }}
                                    </h3>
                                    
                                    <p class="text-gray-600 font-semibold text-sm mb-4 line-clamp-2">
                                        {{ $event->description }}
                                    </p>
                                    
                                    <div class="space-y-2 mb-6">
                                        <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                            <span class="text-2xl">📅</span>
                                            <span>{{ $event->event_date->format('d M Y, H:i') }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                            <span class="text-2xl">📍</span>
                                            <span>{{ $event->location }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-gray-700 font-bold text-sm">
                                            <span class="text-2xl">🎫</span>
                                            <span>{{ $event->tickets->count() }} ticket types</span>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('event.show', $event->id) }}" 
                                        class="block text-center toca-btn-pink w-full">
                                        View Details 👀
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    <div class="toca-card-elegant p-4 bg-white relative">
                        {{ $events->links() }}
                    </div>
                </div>

            @else
                <div class="text-center py-20">
                    <div class="toca-card-elegant max-w-2xl mx-auto p-12 bg-gradient-to-br from-white to-orange-50 relative">
                        <div class="text-9xl mb-8">😢</div>
                        <h3 class="text-5xl font-bold text-gray-800 mb-4">Oops!</h3>
                        <p class="text-2xl text-gray-600 font-bold mb-8">
                            No events found! Try different keywords 🔍
                        </p>
                        <a href="{{ route('home') }}" class="toca-btn-blue inline-block">
                            Clear Filters 🔄
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <div class="h-20 bg-gradient-to-b from-white to-orange-50"></div>

</div>
@endsection
