<x-guest-layout>
    @php
        $backgroundImage = 'register.jpg';
    @endphp
    
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-6xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                
                <div class="order-2 lg:order-1">
                    
                    <div class="text-center mb-8">
                        <div class="text-7xl mb-4">🎉</div>
                        <h1 class="text-5xl font-bold text-gray-800 mb-2">Join the Fun!</h1>
                        <p class="text-xl text-gray-600 font-bold">Create your account in seconds ⚡</p>
                    </div>

                    <div class="toca-card-elegant p-8 bg-gradient-to-br from-white to-purple-50 relative">
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            <div>
                                <label for="name" class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <span class="text-3xl">👤</span>
                                    <span>Your Name</span>
                                </label>
                                <input id="name" 
                                    type="text" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autofocus
                                    class="toca-input-elegant @error('name') border-red-500 @enderror"
                                    placeholder="Enter your awesome name">
                                @error('name')
                                    <div class="mt-3 p-3 bg-red-100 border-4 border-red-500 rounded-2xl">
                                        <p class="text-red-700 font-bold text-sm flex items-center gap-2">
                                            <span class="text-xl">❌</span>
                                            {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <span class="text-3xl">📧</span>
                                    <span>Email Address</span>
                                </label>
                                <input id="email" 
                                    type="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                    class="toca-input-elegant @error('email') border-red-500 @enderror"
                                    placeholder="your@email.com">
                                @error('email')
                                    <div class="mt-3 p-3 bg-red-100 border-4 border-red-500 rounded-2xl">
                                        <p class="text-red-700 font-bold text-sm flex items-center gap-2">
                                            <span class="text-xl">❌</span>
                                            {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <span class="text-3xl">🎭</span>
                                    <span>Choose Your Role</span>
                                </label>
                                
                                <div class="space-y-4">
                                    <label class="block cursor-pointer group">
                                        <input type="radio" name="role" value="user" checked class="hidden peer">
                                        <div class="toca-card-elegant p-6 bg-gradient-to-br from-pink-50 to-purple-50 peer-checked:from-pink-100 peer-checked:to-purple-100 peer-checked:shadow-[8px_8px_0px_0px_rgba(0,0,0,0.3)] transition-all relative">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-4">
                                                    <div class="text-5xl">🎫</div>
                                                    <div>
                                                        <div class="text-xl font-bold text-gray-800">Event Fan</div>
                                                        <div class="text-sm text-gray-600 font-semibold">Book tickets & have fun!</div>
                                                    </div>
                                                </div>
                                                <div class="text-4xl">
                                                    <span class="peer-checked:inline hidden">✅</span>
                                                    <span class="peer-checked:hidden inline">⚪</span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="block cursor-pointer group">
                                        <input type="radio" name="role" value="organizer" class="hidden peer">
                                        <div class="toca-card-elegant p-6 bg-gradient-to-br from-yellow-50 to-orange-50 peer-checked:from-yellow-100 peer-checked:to-orange-100 peer-checked:shadow-[8px_8px_0px_0px_rgba(0,0,0,0.3)] transition-all relative">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-4">
                                                    <div class="text-5xl">🎨</div>
                                                    <div>
                                                        <div class="text-xl font-bold text-gray-800">Event Creator</div>
                                                        <div class="text-sm text-gray-600 font-semibold">Create amazing events!</div>
                                                    </div>
                                                </div>
                                                <div class="text-4xl">
                                                    <span class="peer-checked:inline hidden">✅</span>
                                                    <span class="peer-checked:hidden inline">⚪</span>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                                
                                @error('role')
                                    <div class="mt-3 p-3 bg-red-100 border-4 border-red-500 rounded-2xl">
                                        <p class="text-red-700 font-bold text-sm flex items-center gap-2">
                                            <span class="text-xl">❌</span>
                                            {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <span class="text-3xl">🔒</span>
                                    <span>Password</span>
                                </label>
                                <input id="password" 
                                    type="password" 
                                    name="password" 
                                    required
                                    class="toca-input-elegant @error('password') border-red-500 @enderror"
                                    placeholder="••••••••">
                                @error('password')
                                    <div class="mt-3 p-3 bg-red-100 border-4 border-red-500 rounded-2xl">
                                        <p class="text-red-700 font-bold text-sm flex items-center gap-2">
                                            <span class="text-xl">❌</span>
                                            {{ $message }}
                                        </p>
                                    </div>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <span class="text-3xl">🔐</span>
                                    <span>Confirm Password</span>
                                </label>
                                <input id="password_confirmation" 
                                    type="password" 
                                    name="password_confirmation" 
                                    required
                                    class="toca-input-elegant"
                                    placeholder="••••••••">
                            </div>

                            <button type="submit" class="w-full toca-btn-purple text-2xl">
                                Create Account! 🎊
                            </button>
                        </form>

                        <div class="relative my-8">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t-4 border-gray-800" style="border-style: dashed;"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="px-6 py-2 bg-white text-gray-600 font-bold text-lg border-4 border-gray-800 rounded-full">
                                    OR
                                </span>
                            </div>
                        </div>

                        <div class="text-center space-y-4">
                            <p class="text-gray-700 font-bold text-lg flex items-center justify-center gap-2">
                                <span>Already have an account?</span>
                                <span class="text-3xl">😊</span>
                            </p>
                            <a href="{{ route('login') }}" class="block toca-btn-blue w-full text-xl">
                                Login Here 🔑
                            </a>
                        </div>
                    </div>
                </div>

                <div class="order-1 lg:order-2 hidden lg:block sticky top-8">
                    <div class="relative">
                        <div class="toca-card-elegant p-12 bg-gradient-to-br from-yellow-100 via-orange-100 to-pink-100 text-center relative">
                            <div class="space-y-8">
                                <div class="text-8xl">🌟</div>
                                <div class="text-7xl">🎈</div>
                                <div class="text-6xl">🎪</div>
                                <div class="text-5xl">✨</div>
                            </div>
                            
                            <h3 class="text-4xl font-bold text-gray-800 mt-8 mb-4">
                                Start Your Journey!
                            </h3>
                            <p class="text-xl font-bold text-gray-700">
                                Join thousands of happy event-goers! 🎉
                            </p>
                        </div>
                        
                        <div class="absolute -top-10 -left-10 text-7xl">💖</div>
                        <div class="absolute -bottom-10 -right-10 text-6xl">🎊</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
