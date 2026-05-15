<div class="max-w-6xl px-6 py-12 mx-auto">
     @if(session()->has('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 rounded-xl">
            {{ session('success') }}
        </div>
    @endif
    <div class="grid grid-cols-1 gap-12 lg:grid-cols-2">

        <!-- ================= LEFT: IMAGES ================= -->
        <div>

            <!-- Main Image -->
            <div class="bg-gray-50 rounded-3xl p-6 flex items-center justify-center h-[450px]">
                <img
                            src="{{ $product->images->first()->url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-110"
                            loading="lazy"
                        >
            </div>

            <!-- Thumbnails -->
            <div class="flex gap-3 mt-4 overflow-x-auto">
                @foreach($product->images as $image)
                    <button wire:click="selectImage('{{ $image->image_path }}')"
                            class="w-20 h-20 border rounded-xl overflow-hidden 
                            {{ $selectedImage == $image->image_path ? 'border-black' : 'border-gray-200' }}">
                        <img
                            src="{{ $product->images->first()->url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-transform duration-1000 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-110"
                            loading="lazy"
                        >
                    </button>
                @endforeach
            </div>

        </div>

        <!-- ================= RIGHT: DETAILS ================= -->
        <div>

            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>

            <!-- PRICE -->
            <div class="mt-6 text-2xl font-semibold">
                @if($selectedVariant)
                    ${{ number_format($selectedVariant->price, 2) }}
                @else
                    Select options
                @endif
            </div>

            <!-- ================= COLOR ================= -->
            <div class="mt-8">
                <h3 class="mb-3 font-semibold">
                    Color: {{ $activeColor }}
                </h3>

                <div class="flex gap-3">
                    @foreach($colors as $color)
                        @php
                            // Attempt to map color names to hex codes for UI
                            $bgClass = 'bg-gray-200';
                            $lowerColor = strtolower($color);
                            if (str_contains($lowerColor, 'black') || str_contains($lowerColor, 'graphite') || str_contains($lowerColor, 'midnight')) $bgClass = 'bg-gray-800';
                            elseif (str_contains($lowerColor, 'white') || str_contains($lowerColor, 'starlight') || str_contains($lowerColor, 'silver')) $bgClass = 'bg-gray-100';
                            elseif (str_contains($lowerColor, 'blue') || str_contains($lowerColor, 'pacific')) $bgClass = 'bg-blue-300';
                            elseif (str_contains($lowerColor, 'red')) $bgClass = 'bg-red-500';
                            elseif (str_contains($lowerColor, 'green')) $bgClass = 'bg-green-300';
                            elseif (str_contains($lowerColor, 'yellow')) $bgClass = 'bg-yellow-200';
                            elseif (str_contains($lowerColor, 'purple')) $bgClass = 'bg-purple-300';
                            elseif (str_contains($lowerColor, 'pink')) $bgClass = 'bg-pink-300';
                            elseif (str_contains($lowerColor, 'titanium')) $bgClass = 'bg-[#878681]'; // Natural Titanium color
                        @endphp
                        <button wire:click="selectColor('{{ $color }}')"
                                title="{{ $color }}"
                                class="relative flex items-center justify-center rounded-full focus:outline-none transition-all duration-200 hover:scale-110 
                                {{ $activeColor == $color ? 'ring-2 ring-offset-2 ring-blue-600' : 'ring-1 ring-gray-300' }}">
                            <span class="h-10 w-10 rounded-full border border-black/10 {{ $bgClass }} shadow-inner"></span>
                        </button>
                    @endforeach
                </div>
            </div>

            <!-- ================= STORAGE ================= -->
            <div class="mt-6">
                <h3 class="mb-3 font-semibold">
                    Storage: {{ $activeStorage }}
                </h3>

                <div class="grid grid-cols-3 gap-3">
                    @foreach($storages as $storage)

                        @php
                            $variant = $product->variants
                                ->where('color', $activeColor)
                                ->where('storage', $storage)
                                ->first();
                        @endphp

                        <button wire:click="selectStorage('{{ $storage }}')"
                                class="border rounded-xl py-3 
                                {{ $activeStorage == $storage ? 'bg-black text-white' : '' }}
                                {{ !$variant ? 'opacity-40 cursor-not-allowed' : '' }}"
                                @if(!$variant) disabled @endif>

                            {{ $storage }}

                            @if(!$variant)
                                <div class="text-xs text-red-500">Out</div>
                            @endif

                        </button>

                    @endforeach
                </div>
        </div>
            <!-- ================= ADD TO CART ================= -->
            <div class="mt-10 flex gap-4">

    {{-- ADD TO CART --}}
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
        @csrf

        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 py-3.5 rounded-2xl bg-black text-white font-semibold text-sm
                   hover:bg-gray-800 transition-all duration-300 shadow-lg shadow-black/10 hover:shadow-black/20 active:scale-[0.98]">

            <!-- Cart Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m6-9v9m5-9l2 9" />
            </svg>

            Add to Cart
        </button>

        <input type="hidden" name="variant_id" value="{{ $selectedVariant->id }}">
    </form>

    {{-- BUY NOW --}}
    <form action="{{ route('cart.buyNow', $product->id) }}" method="POST" class="flex-1">
        @csrf

        <button
            type="submit"
            class="w-full flex items-center justify-center gap-2 py-3.5 rounded-2xl
                   border border-blue-600 text-blue-600 font-semibold text-sm
                   hover:bg-blue-600 hover:text-white transition-all duration-300
                   active:scale-[0.98]">

            <!-- Lightning Icon -->
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13 10V3L4 14h7v7l9-11h-7z" />
            </svg>

            Buy It Now
        </button>

        <input type="hidden" name="variant_id" value="{{ $selectedVariant->id }}">
    </form>

</div>
            
            <div class='p-6 mt-8 bg-gray-50 rounded-xl'>
                <h2 class="text-xl font-semibold">Description</h2>
                <ul class="mt-4 space-y-2 text-gray-600 list-disc list-inside">

                    @foreach(explode("\n", $product->description) as $line)

                        @if(trim($line) != '')
                            <li>
                        {{ ltrim($line, '- ') }}
                    </li>
                @endif

            @endforeach

        </ul>
            </div>
        </div>

    </div>
</div>



