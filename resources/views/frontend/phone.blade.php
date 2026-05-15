@extends('layouts.frontend')

@section('content')

<!-- Load Fonts in Head -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<div class="min-h-screen bg-[#f5f5f0] text-[#111111] font-['DM_Sans'] antialiased">

    {{-- ── HERO HEADER ── --}}
    <header class="relative overflow-hidden bg-[#111111] px-6 py-20 lg:px-12 lg:py-28 text-white">
        <div class="relative z-10 max-w-[680px]">
            <div class="inline-flex items-center gap-2 text-[12px] font-semibold uppercase tracking-[0.18em] text-white/55 mb-7">
                <span class="w-1.5 h-1.5 rounded-full bg-[#0071e3]"></span>
                New Arrivals 2025
            </div>

            <h1 class="font-['Playfair_Display'] text-[clamp(3.5rem,8vw,6.5rem)] font-medium leading-[1.05] tracking-tight mb-6">
                Beautifully<br>
                <span class="italic font-normal text-white/45">Powerful.</span>
            </h1>

            <p class="mb-12 text-lg font-light leading-relaxed text-white/55">
                The perfect balance of power and beauty.<br>
                Find the model that fits your life.
            </p>

            <div class="flex items-center gap-7">
                <div class="flex flex-col gap-0.5">
                    <strong class="text-2xl font-semibold tracking-tighter">{{ $products->total() }}</strong>
                    <span class="text-[11px] uppercase tracking-widest text-white/40">Models</span>
                </div>
                <div class="w-px h-9 bg-white/10"></div>
                <div class="flex flex-col gap-0.5">
                    <strong class="text-2xl font-semibold tracking-tighter">A18</strong>
                    <span class="text-[11px] uppercase tracking-widest text-white/40">Chip</span>
                </div>
                <div class="w-px h-9 bg-white/10"></div>
                <div class="flex flex-col gap-0.5">
                    <strong class="text-2xl font-semibold tracking-tighter">4K</strong>
                    <span class="text-[11px] uppercase tracking-widest text-white/40">ProRes</span>
                </div>
            </div>
        </div>

        {{-- Decorative ring --}}
        <div class="absolute -right-[180px] -top-[180px] w-[600px] h-[600px] rounded-full border border-white/5 pointer-events-none">
            <div class="absolute inset-[60px] rounded-full border border-white/5"></div>
        </div>
    </header>

    {{-- ── PRODUCT GRID ── --}}
    <main class="max-w-[1440px] mx-auto px-6 py-16 lg:px-8 lg:py-20">
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach($products as $index => $product)
            <article 
                class="group relative flex flex-col bg-white rounded-[28px] overflow-hidden shadow-[0_2px_20px_rgba(0,0,0,0.06)] transition-all duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] hover:-translate-y-2.5 hover:shadow-[0_30px_70px_rgba(0,0,0,0.13)]"
                style="animation: fadeUp 0.6s cubic-bezier(0.22,1,0.36,1) both {{ $index * 80 }}ms">

                {{-- Image area --}}
                <a href="{{ route('product.show',$product->id) }}" class="relative block aspect-[3/4] bg-[#f0f0f0] overflow-hidden shrink-0">

                    @if($product->images->isNotEmpty())
                        <img
                            src="{{ $product->images->first()->url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-110"
                            loading="lazy"
                        >
                    @else
                        <div class="flex items-center justify-center w-full h-full text-gray-300">
                            <svg class="w-14 h-14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <rect x="5" y="2" width="14" height="20" rx="2"/>
                                <circle cx="12" cy="17" r="1"/>
                            </svg>
                        </div>
                    @endif

                    {{-- Overlay gradient on hover --}}
                    <div class="absolute inset-0 transition-opacity duration-500 opacity-0 pointer-events-none bg-gradient-to-t from-black/30 to-transparent group-hover:opacity-100"></div>

                    {{-- Badge --}}
                    <span class="absolute top-4 left-4 bg-white/85 backdrop-blur-xl border border-white/50 rounded-full px-3.5 py-1 text-[11px] font-bold uppercase tracking-wider text-[#111111] shadow-sm">
                        New
                    </span>

                    {{-- Hover quick-view --}}
                    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 translate-y-3 opacity-0 flex items-center gap-2 bg-white text-[#111111] rounded-full px-5 py-2.5 text-sm font-semibold whitespace-nowrap shadow-xl transition-all duration-300 group-hover:opacity-100 group-hover:translate-y-0">
                        <span>Quick View</span>
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>

                {{-- Text content --}}
                <div class="p-5 pb-6 flex flex-col gap-2.5 flex-1">
                    <div class="flex items-center justify-between">
                        <span class="text-[11px] font-bold uppercase tracking-widest text-gray-500">iPhone</span>
                        <span class="text-sm font-bold text-[#0071e3]">From ${{ number_format($product->price, 0) }}</span>
                    </div>

                    <h3 class="font-['Playfair_Display'] text-2xl font-medium tracking-tight text-[#111111]">
                        {{ $product->name }}
                    </h3>

                    <div class="flex items-center gap-3 mt-1.5">
                        <form action="{{ route('cart.buyNow', $product->id) }}" method="POST">
                            @csrf
                            @if($product->variants->isNotEmpty())
                                <input type="hidden" name="variant_id" value="{{ $product->variants->first()->id }}">
                            @endif
                            <button type="submit" class="inline-flex items-center justify-center bg-[#111111] text-white rounded-full px-5 py-2.5 text-sm font-semibold transition-all hover:bg-gray-800 hover:scale-[1.03] active:scale-95">
                                Buy Now
                            </button>
                        </form>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        {{-- ── PAGINATION ── --}}
        <div class="flex justify-center pt-8 mt-16 border-t border-gray-200/50">
            {{ $products->links() }}
        </div>
    </main>
</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(32px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

@endsection