<style>

.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

</style>

@extends('layouts.frontend')

@section('content')

<div class="relative w-full h-[80vh] min-h-[500px] overflow-hidden flex items-center justify-center">
    <!-- Real High-Quality Unsplash Photography -->
    <img src="https://i.pinimg.com/1200x/9e/8b/3f/9e8b3fbbbfb13bb27b8f69b1fd394d6c.jpg" class="absolute inset-0 z-0 object-cover object-center w-full h-full" alt="iSphere Premium Apple Devices">
    
    <!-- Subtle Gradient Overlay to ensure text readability -->
    <div class="absolute inset-x-0 bottom-0 z-10 pointer-events-none h-1/2 bg-gradient-to-t from-black/50 to-transparent"></div>
    <div class="absolute inset-0 z-10 pointer-events-none bg-black/20"></div>
    
    <!-- Hero Copy Apple-Style -->
    <div class="relative z-20 px-4 mt-12 text-center sm:px-6 lg:px-8 sm:mt-24">
        <h1 class="mb-2 text-5xl font-bold tracking-tight text-white md:text-7xl drop-shadow-lg">
            The next generation.
        </h1>
        <h2 class="text-4xl font-semibold tracking-tight md:text-6xl text-white/90 drop-shadow-md">
            Is officially here.
        </h2>
        <p class="max-w-2xl mx-auto mt-6 text-lg font-light text-gray-200 md:text-2xl drop-shadow">
            Experience unparalleled performance with the latest lineup of groundbreaking devices designed perfectly for you.
        </p>
        <div class="flex flex-col justify-center gap-4 mt-10 sm:flex-row">
            <a href="#" class="rounded-full bg-white px-8 py-3.5 text-sm font-semibold text-black shadow-xl hover:scale-105 transition-transform duration-300">
                Shop the Collection
            </a>
            <a href="#" class="rounded-full bg-transparent border border-white/70 backdrop-blur-sm px-8 py-3.5 text-sm font-semibold text-white hover:bg-white/20 transition-colors duration-300">
                Learn more >
            </a>
        </div>
    </div>
</div>

<div class="relative py-20 bg-white">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-8">
        
        <!-- Section Title -->
        <div class="flex items-end justify-between mb-10">
            <div class="max-w-2xl">
                <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                    Shop by Category
                </h2>
                <p class="mt-4 text-xl text-gray-500">
                    Explore premium Apple devices and accessories.
                </p>
            </div>
        </div>

        <!-- Slider Container -->
        <div class="relative w-full">
            
            <!-- Scrollable Area -->
            <!-- We use gap-8. To show 4 items exactly, card width = calc((100% - (3 * 2rem)) / 4) -->
            <div id="categorySlider" class="flex gap-8 pt-4 pb-8 overflow-x-auto scroll-smooth no-scrollbar snap-x snap-mandatory">
                
                @foreach($categories as $category)
                <!-- Product Card -->
                <div class="relative flex-none w-full sm:w-[calc((100%-2rem)/2)] lg:w-[calc((100%-6rem)/4)] snap-start overflow-hidden transition-all duration-300 bg-white border border-gray-100 shadow-md group rounded-3xl hover:shadow-2xl hover:-translate-y-2 flex flex-col h-[550px]">

                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-gray-100 h-80 shrink-0">

                        @if($category->image)
                            <img 
                                src="{{ asset('storage/' . $category->image) }}"
                                class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-110"
                            >
                        @endif

                        <!-- Floating Badge -->
                        <div class="absolute px-4 py-1 text-sm font-medium text-white bg-black rounded-full top-4 left-4">
                            New
                        </div>

                    </div>

                    <!-- Product Details -->
                    <div class="flex flex-col flex-1 p-6">

                        <h2 class="text-2xl font-semibold text-gray-900">
                            {{ $category->name }}
                        </h2>

                        <p class="flex-1 mt-2 text-sm leading-relaxed text-gray-500 line-clamp-2">
                            {{ $category->description }}
                        </p>

                        <div class="flex items-center justify-between mt-6 shrink-0">

                            <a href="#"
                                class="px-5 py-2 text-sm font-medium text-white transition bg-black rounded-full hover:bg-gray-800">
                                View
                            </a>

                        </div>

                    </div>

                </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>

<div class="py-24 bg-[#fbfbfd]">
    <div class="max-w-[1440px] mx-auto px-6 lg:px-8">
        <div class="grid items-start grid-cols-1 gap-16 lg:grid-cols-12">
            
            <!-- Left Side: Info & Map -->
            <div class="space-y-12 lg:col-span-7">
                <div>
                    <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl text-balance">
                        Get in Touch
                    </h2>
                    <p class="max-w-xl mt-4 text-xl text-gray-500">
                        Have questions about our premium Apple products? We're here to help you find the perfect device for your needs.
                    </p>
                </div>

                <!-- Contact Info Cards -->
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
                    <div class="flex items-start p-6 space-x-4 transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 text-blue-600 rounded-full bg-blue-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Email Us</h3>
                            <p class="mt-1 text-gray-500">support@isphere.com</p>
                        </div>
                    </div>

                    <div class="flex items-start p-6 space-x-4 transition-all duration-300 bg-white border border-gray-100 shadow-sm rounded-2xl hover:shadow-md">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 text-green-600 rounded-full bg-green-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Call Us</h3>
                            <p class="mt-1 text-gray-500">+94 77 123 4567</p>
                        </div>
                    </div>
                </div>

                <!-- Map Section -->
                <div class="overflow-hidden border border-gray-100 shadow-lg rounded-3xl ring-8 ring-white/50">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3220.111285391152!2d79.85350951018376!3d7.291001850413447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2e90040034831%3A0xde6c482282e92c94!2sJacome%20Gonsalves%20statue!5e0!3m2!1sen!2slk!4v1778124793289!5m2!1sen!2slk"
                        class="w-full h-[400px] grayscale transition-all duration-700 hover:grayscale-0"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="lg:col-span-5">
                <div class="bg-white p-8 md:p-10 rounded-[2.5rem] shadow-2xl shadow-black/5 border border-gray-100 sticky top-12">
                    <h3 class="mb-2 text-2xl font-bold text-gray-900">Send us a Message</h3>
                    <p class="mb-8 text-gray-500">We'll get back to you within a few business hours.</p>

                    <form action="#" method="POST" class="space-y-6">
                        <div class="space-y-2">
                            <label class="ml-1 text-sm font-semibold text-gray-700">Full Name</label>
                            <input type="text" placeholder="Your Name"
                                class="w-full px-5 py-4 transition-all duration-300 border border-transparent outline-none bg-gray-50 rounded-2xl focus:bg-white focus:ring-4 focus:ring-black/5 focus:border-black">
                        </div>

                        <div class="space-y-2">
                            <label class="ml-1 text-sm font-semibold text-gray-700">Email Address</label>
                            <input type="email" placeholder="email@example.com"
                                class="w-full px-5 py-4 transition-all duration-300 border border-transparent outline-none bg-gray-50 rounded-2xl focus:bg-white focus:ring-4 focus:ring-black/5 focus:border-black">
                        </div>

                        <div class="space-y-2">
                            <label class="ml-1 text-sm font-semibold text-gray-700">Your Message</label>
                            <textarea rows="4" placeholder="How can we help you?"
                                class="w-full px-5 py-4 transition-all duration-300 border border-transparent outline-none resize-none bg-gray-50 rounded-2xl focus:bg-white focus:ring-4 focus:ring-black/5 focus:border-black"></textarea>
                        </div>

                        <button type="submit"
                            class="flex items-center justify-center w-full py-5 space-x-3 font-bold text-white transition-all duration-300 bg-black shadow-xl rounded-2xl shadow-black/10 hover:bg-gray-800 hover:-translate-y-1 active:scale-95">
                            <span>Send Message</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path d="M3.105 2.289a.75.75 0 00-.826.95l1.414 4.925L10.29 10l-6.597 1.836-1.414 4.925a.75.75 0 00.826.95 44.82 44.82 0 0012.86-5.358.75.75 0 000-1.213 44.82 44.82 0 00-12.86-5.358z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('categorySlider');
        let autoScrollInterval;
        const scrollDelay = 1000; // 1 sec
        let scrollDirection = 1; // 1 for right, -1 for left
        
        function startAutoScroll() {
            autoScrollInterval = setInterval(() => {
                if (!slider) return;
                
                // Check if we reached the end of the scrollable area
                // We add a small buffer (10px) to account for fractional pixel rounding
                if (slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 10) {
                    scrollDirection = -1; // Reverse direction to left
                } 
                // Check if we reached the beginning
                else if (slider.scrollLeft <= 10) {
                    scrollDirection = 1; // Reverse direction to right
                }

                // Scroll by exactly one card width + gap in the current direction
                const firstCard = slider.querySelector('.group');
                if (firstCard) {
                    const scrollAmount = (firstCard.offsetWidth + 32) * scrollDirection; // 32px is the 2rem gap
                    slider.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                }
            }, scrollDelay);
        }

        function stopAutoScroll() {
            clearInterval(autoScrollInterval);
        }

        // Start auto-scrolling initially
        startAutoScroll();

        // Pause auto-scrolling when the user interacts with the slider
        if (slider) {
            slider.addEventListener('mouseenter', stopAutoScroll);
            slider.addEventListener('mouseleave', startAutoScroll);
            slider.addEventListener('touchstart', stopAutoScroll);
            slider.addEventListener('touchend', startAutoScroll);
        }
    });
</script>