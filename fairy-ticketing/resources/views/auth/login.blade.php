<x-guest-layout>
    @php
        $backgroundImage = 'login.jpg';
    @endphp
    
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-5xl mx-auto">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <div class="hidden lg:block relative">
                    <div class="relative">
                        <div class="toca-card-elegant p-12 bg-gradient-to-br from-pink-100 via-purple-100 to-blue-100 text-center relative">
                            <div class="space-y-6">
                                <div class="text-8xl">🎪</div>
                                <div class="text-7xl">🎉</div>
                                <div class="text-6xl">✨</div>
                            </div>
                            
                            <h3 class="text-4xl font-bold text-gray-800 mt-8 mb-4">
                                Welcome Back!
                            </h3>
                            <p class="text-xl font-bold text-gray-700">
                                Let's find amazing events together! 🌟
                            </p>
                        </div>
                        
                        <div class="absolute -top-10 -right-10 text-7xl">🎈</div>
                        <div class="absolute -bottom-10 -left-10 text-6xl">💖</div>
                    </div>
                </div>

                <div class="relative">
                    
                    <div class="absolute -top-8 right-10 text-6xl lg:hidden">🎪</div>
                    
                    <div class="text-center mb-8">
                        <div class="text-7xl mb-4">🔑</div>
                        <h1 class="text-5xl font-bold text-gray-800 mb-2">Login Time!</h1>
                        <p class="text-xl text-gray-600 font-bold">Enter your magical credentials ✨</p>
                    </div>

                    <div class="toca-card-elegant p-8 bg-gradient-to-br from-white to-orange-50 relative">
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <div class="relative">
                                <label for="email" class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <span class="text-3xl">📧</span>
                                    <span>Email Address</span>
                                </label>
                                
                                <div class="relative">
                                    <input id="email" 
                                        type="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        autofocus
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
                            </div>

                            <div class="relative">
                                <label for="password" class="block text-lg font-bold text-gray-800 mb-3 flex items-center gap-2">
                                    <span class="text-3xl">🔒</span>
                                    <span>Password</span>
                                </label>
                                
                                <div class="relative">
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
                            </div>

                            <div class="flex items-center gap-3 p-4 bg-yellow-50 rounded-2xl border-2 border-gray-300">
                                <input id="remember" 
                                    type="checkbox" 
                                    name="remember" 
                                    class="w-6 h-6 rounded-lg border-4 border-gray-800 text-toca-pink focus:ring-toca-pink">
                                <label for="remember" class="text-gray-800 font-bold text-lg flex items-center gap-2">
                                    <span>Remember me</span>
                                    <span class="text-2xl">💭</span>
                                </label>
                            </div>

                            <button type="submit" class="w-full toca-btn-pink text-2xl">
                                Let's Go! 🚀
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
                                <span>Don't have an account?</span>
                                <span class="text-3xl">🤔</span>
                            </p>
                            <a href="{{ route('register') }}" class="block toca-btn-blue w-full text-xl">
                                Create Account ✨
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
