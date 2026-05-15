<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

    @if ($cartItems->isEmpty())
        <div class="bg-white rounded-3xl p-12 text-center border border-gray-100 shadow-sm">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
            </div>
            <h2 class="text-xl font-semibold text-gray-900 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-8">Looks like you haven't added anything to your cart yet.</p>
            <a href="/" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-sm font-semibold rounded-2xl text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                Start Shopping
            </a>
        </div>
    @else
        @if (session()->has('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3">
                <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                {{ session('error') }}
            </div>
        @endif
        <div class="lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <div class="lg:col-span-8">
                <div class="space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="bg-white border {{ !empty($selected[$item->id]) ? 'border-blue-200 shadow-sm' : 'border-gray-100 opacity-75' }} rounded-3xl p-4 sm:p-6 flex flex-col sm:flex-row gap-4 sm:gap-6 items-start sm:items-center transition-all hover:shadow-md">
                            <!-- Checkbox -->
                            <div class="flex items-center h-full pt-1 sm:pt-0">
                                <input type="checkbox" wire:model.live="selected.{{ $item->id }}" class="w-5 h-5 text-blue-600 rounded-lg border-gray-300 focus:ring-blue-500 cursor-pointer">
                            </div>

                            <!-- Image -->
                            <div class="w-24 h-24 sm:w-32 sm:h-32 flex-shrink-0 bg-gray-50 rounded-2xl overflow-hidden flex items-center justify-center border border-gray-100">
                                @php
                                    $imageUrl = $item->product->images->first()->url ?? $item->product->images->first()->image_path ?? null;
                                @endphp
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>

                            <!-- Details -->
                            <div class="flex-1 min-w-0 flex flex-col sm:flex-row justify-between w-full">
                                <div class="mb-4 sm:mb-0 space-y-1">
                                    <h3 class="text-lg font-bold text-gray-900 truncate">
                                        <a href="/product/{{ $item->product_id }}" class="hover:text-blue-600 transition-colors">{{ $item->product->name }}</a>
                                    </h3>
                                    <div class="flex flex-wrap gap-2 text-sm text-gray-500">
                                        <span class="inline-flex items-center bg-gray-100 px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-800">
                                            {{ $item->variant->color ?? 'Standard' }}
                                        </span>
                                        <span class="inline-flex items-center bg-gray-100 px-2.5 py-0.5 rounded-full text-xs font-medium text-gray-800">
                                            {{ $item->variant->storage ?? 'N/A' }}
                                        </span>
                                    </div>
                                    <p class="text-lg font-semibold text-gray-900 mt-2">${{ number_format($item->variant->price ?? 0, 2) }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center sm:flex-col sm:items-end justify-between gap-4">
                                    <button wire:click="removeItem({{ $item->id }})" class="text-gray-400 hover:text-red-500 transition-colors p-2 rounded-full hover:bg-red-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>

                                    <div class="flex items-center border border-gray-200 rounded-full bg-white p-1 shadow-sm">
                                        <button wire:click="decrement({{ $item->id }})" class="w-8 h-8 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" /></svg>
                                        </button>
                                        <span class="w-8 text-center font-semibold text-gray-900 text-sm">{{ $quantities[$item->id] ?? $item->quantity }}</span>
                                        <button wire:click="increment({{ $item->id }})" class="w-8 h-8 rounded-full flex items-center justify-center text-gray-500 hover:bg-gray-100 hover:text-gray-900 transition-colors focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Summary -->
            <div class="lg:col-span-4 mt-8 lg:mt-0">
                <div class="bg-gray-50 rounded-3xl p-6 sm:p-8 border border-gray-100 sticky top-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-4 text-sm text-gray-600 border-b border-gray-200 pb-6 mb-6">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Shipping</span>
                            <span class="text-green-600 font-medium">Free</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Tax</span>
                            <span class="font-medium text-gray-900">Calculated at checkout</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center mb-8">
                        <span class="text-base font-bold text-gray-900">Total</span>
                        <span class="text-2xl font-bold text-gray-900">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    
                    
                    <button wire:click="checkout" class="w-full flex items-center justify-center gap-2 py-4 rounded-2xl bg-blue-600 text-white font-semibold text-base transition-all hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-600/20 active:scale-[0.98] {{ $subtotal == 0 ? 'opacity-50 cursor-not-allowed hover:bg-blue-600 hover:shadow-none hover:scale-100' : '' }}" {{ $subtotal == 0 ? 'disabled' : '' }}>
                        Proceed to Checkout
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                    
                    <div class="mt-6 flex items-center justify-center gap-4 text-gray-400">
                        <svg class="h-6" viewBox="0 0 38 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="38" height="24" rx="4" fill="#222222"/>
                            <path d="M26.974 16.488H29.564L27.876 7.513H25.861C25.467 7.513 25.109 7.747 24.965 8.106L21.268 16.488H23.948L24.484 14.963H27.761L26.974 16.488ZM25.218 12.871L26.541 9.076L27.311 12.871H25.218Z" fill="white"/>
                            <path d="M15.446 7.513H12.39L9.362 16.488H12.11L12.659 14.928H16.035L16.275 16.488H18.663L15.446 7.513ZM13.315 13.064L14.619 9.387L15.013 13.064H13.315Z" fill="white"/>
                            <path d="M11.666 7.513H8.384L5.688 16.488H8.358L11.089 7.513H11.666Z" fill="white"/>
                        </svg>
                        <span class="text-xs text-gray-500 font-medium">Secure Encrypted Checkout</span>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
