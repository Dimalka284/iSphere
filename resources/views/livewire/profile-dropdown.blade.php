<div>
    <div class="relative" wire:click.away="closeDropdown">
    @auth

        <!-- Profile Button -->
        <button wire:click="toggleDropdown"
            class="text-gray-700 transition-colors hover:text-black focus:outline-none">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z" />
            </svg>
        </button>

        <!-- Dropdown Menu -->
        @if($open)
            <div class="absolute right-0 z-[110] w-64 mt-3 bg-white border border-gray-100 rounded-xl shadow-[0_10px_40px_-10px_rgba(0,0,0,0.1)] overflow-hidden transform origin-top-right transition-all">

                <div class="px-4 py-3 text-sm text-gray-600">
                    <p class="font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-xs">{{ auth()->user()->email }}</p>
                </div>

                <div class="border-t border-gray-200"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            </div>
        @endif

    @else
        <!-- If not logged in -->
        <a href="{{ route('login') }}"
            class="text-gray-700 transition-colors hover:text-black">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.118a7.5 7.5 0 0 1 15 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.5-1.632Z" />
            </svg>
        </a>
    @endauth
</div>

</div>

