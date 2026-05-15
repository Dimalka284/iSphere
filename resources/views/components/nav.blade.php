<header x-data="{ mobileMenuOpen: false, searchOpen: false }" class="sticky top-0 z-50 transition-all duration-500">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Floating Wrapper -->
        <div class="flex items-center justify-between px-6 h-16 sm:h-18 nav-glass">
            <!-- Logo -->
            <div class="flex items-center flex-shrink-0 transition-all duration-300 transform cursor-pointer hover:scale-105 active:scale-95">
                <a href="/">
                    <img src="{{ asset('storage/images/logo.png') }}" class="object-contain w-auto h-8 sm:h-10 mix-blend-multiply" alt="iSphere Logo">
                </a>
            </div>

            <!-- Desktop Navigation - Larger Links -->
            <nav class="hidden space-x-2 md:flex lg:space-x-4">
                <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
                <a href="/phone" class="nav-link {{ request()->is('phone*') ? 'active' : '' }}">iPhone</a>
                <a href="/mac" class="nav-link {{ request()->is('mac*') ? 'active' : '' }}">Mac</a>
                <a href="#" class="nav-link">iPad</a>
                <a href="#" class="nav-link">Watch</a>
                <a href="#" class="nav-link text-nowrap">AirPods</a>
                <a href="#" class="nav-link">Accessories</a>
            </nav>

            <!-- Right Actions -->
            <div class="flex items-center space-x-2 sm:space-x-3">
                <!-- Search Bar (Desktop) - Minimalist -->
                <div class="relative hidden xl:block group">
                    <div class="flex items-center px-4 py-2 rounded-full search-pill">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               class="ml-2 bg-transparent border-none text-sm focus:ring-0 w-24 group-hover:w-40 focus:w-48 transition-all duration-500 placeholder-gray-400" 
                               placeholder="Search">
                    </div>
                </div>

                <!-- Icons Group -->
                <div class="flex items-center space-x-1">
                    <!-- Mobile/Small Desktop Search Trigger -->
                    <button @click="searchOpen = !searchOpen" class="p-2 text-gray-700 transition-all rounded-full xl:hidden hover:bg-black/5 active:scale-90">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>

                    <!-- Profile / Login -->
                    @if(Auth::check())
                        <div class="relative flex items-center">
                            <livewire:profile-dropdown />
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="p-2 text-gray-700 transition-all rounded-full hover:bg-black/5 active:scale-90">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </a>
                    @endif

                    <!-- Cart -->
                    <a href="{{ route('cart.index') }}" class="relative p-2 text-gray-700 transition-all rounded-full hover:bg-black/5 active:scale-90">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        @php
                            $cartCount = Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->sum('quantity') : 0;
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-1.5 right-1.5 flex h-4 w-4 items-center justify-center rounded-full cart-badge text-[9px] font-bold text-white ring-2 ring-white">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Mobile Menu Toggle -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-gray-700 transition-all rounded-full md:hidden hover:bg-black/5 active:scale-90">
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Overlay - Refined -->
    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
         class="absolute inset-x-4 top-20 bg-white/95 backdrop-blur-2xl border border-gray-100 md:hidden overflow-hidden shadow-2xl rounded-3xl z-[60]">
        <div class="px-6 py-8 space-y-4">
            <a href="/" class="flex items-center justify-between p-4 text-xl font-semibold text-gray-900 rounded-2xl hover:bg-gray-50">
                <span>Home</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a href="/phone" class="flex items-center justify-between p-4 text-xl font-semibold text-gray-900 rounded-2xl hover:bg-gray-50">
                <span>iPhone</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <a href="/mac" class="flex items-center justify-between p-4 text-xl font-semibold text-gray-900 rounded-2xl hover:bg-gray-50">
                <span>Mac</span>
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            </a>
            <div class="pt-4 mt-4 border-t border-gray-100">
                <a href="#" class="block p-4 text-lg font-medium text-gray-500">iPad</a>
                <a href="#" class="block p-4 text-lg font-medium text-gray-500">Watch</a>
                <a href="#" class="block p-4 text-lg font-medium text-gray-500">AirPods</a>
            </div>
        </div>
    </div>

    <!-- Search Overlay - Full Blur -->
    <div x-show="searchOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         class="fixed inset-0 bg-white/80 backdrop-blur-xl z-[70] flex flex-col items-center pt-24 px-6">
        <div class="w-full max-w-3xl">
            <div class="flex items-center mb-8 border-b-2 border-black/10 pb-4">
                <svg class="w-8 h-8 text-black/20 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" 
                       class="w-full bg-transparent border-none text-3xl font-medium focus:ring-0 placeholder-black/10" 
                       placeholder="Search iSphere"
                       autofocus>
                <button @click="searchOpen = false" class="p-2 text-black/40 hover:text-black">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Quick Links</h3>
                    <div class="space-y-3">
                        <a href="#" class="block text-lg hover:text-blue-600 transition-colors">Find a Store</a>
                        <a href="#" class="block text-lg hover:text-blue-600 transition-colors">Accessories</a>
                        <a href="#" class="block text-lg hover:text-blue-600 transition-colors">Support</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>