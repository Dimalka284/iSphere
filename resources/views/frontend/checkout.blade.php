@extends('layouts.frontend')

@section('content')
<div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex flex-col gap-12 lg:flex-row lg:items-start">
        <!-- Billing Details Form -->
        <div class="lg:w-2/3">
            <h1 class="mb-8 text-3xl font-bold text-gray-900">Checkout</h1>
            
            @if (session()->has('message'))
                <div class="flex items-center gap-3 px-4 py-3 mb-6 text-green-700 border border-green-200 shadow-sm bg-green-50 rounded-xl">
                    <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('message') }}
                </div>
            @endif

            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-8">
                @csrf
                <!-- Contact Info -->
                <div class="p-6 transition-all bg-white border border-gray-100 shadow-sm rounded-3xl sm:p-8 hover:shadow-md">
                    <h2 class="flex items-center gap-2 mb-6 text-xl font-semibold text-gray-900">
                        <span class="flex items-center justify-center w-6 h-6 text-sm font-bold text-white bg-blue-600 rounded-full shadow-sm">1</span>
                        Billing Information
                    </h2>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="firstName" value="{{ old('firstName') }}" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none bg-gray-50 focus:bg-white" placeholder="John">
                            @error('firstName') <span class="block mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="lastName" value="{{ old('lastName') }}" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Doe">
                            @error('lastName') <span class="block mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Phone Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="phoneNumber" value="{{ old('phoneNumber') }}" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none bg-gray-50 focus:bg-white" placeholder="+94 77 123 4567">
                            @error('phoneNumber') <span class="block mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block mb-2 text-sm font-medium text-gray-700">Delivery Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" value="{{ old('address') }}" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none bg-gray-50 focus:bg-white" placeholder="123 Main Street, Apt 4B">
                            @error('address') <span class="block mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Province <span class="text-red-500">*</span></label>
                            <select name="province" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none bg-gray-50 focus:bg-white text-gray-700 appearance-none">
                                <option value="">Select Province</option>
                                <option value="Western" {{ old('province') == 'Western' ? 'selected' : '' }}>Western Province</option>
                                <option value="Central" {{ old('province') == 'Central' ? 'selected' : '' }}>Central Province</option>
                                <option value="Southern" {{ old('province') == 'Southern' ? 'selected' : '' }}>Southern Province</option>
                                <option value="Northern" {{ old('province') == 'Northern' ? 'selected' : '' }}>Northern Province</option>
                                <option value="Eastern" {{ old('province') == 'Eastern' ? 'selected' : '' }}>Eastern Province</option>
                                <option value="North Western" {{ old('province') == 'North Western' ? 'selected' : '' }}>North Western Province</option>
                                <option value="North Central" {{ old('province') == 'North Central' ? 'selected' : '' }}>North Central Province</option>
                                <option value="Uva" {{ old('province') == 'Uva' ? 'selected' : '' }}>Uva Province</option>
                                <option value="Sabaragamuwa" {{ old('province') == 'Sabaragamuwa' ? 'selected' : '' }}>Sabaragamuwa Province</option>
                            </select>
                            @error('province') <span class="block mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">District <span class="text-red-500">*</span></label>
                            <input type="text" name="district" value="{{ old('district') }}" required class="w-full px-4 py-3.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-blue-600 focus:border-transparent transition-all outline-none bg-gray-50 focus:bg-white" placeholder="Colombo">
                            @error('district') <span class="block mt-1 text-xs text-red-500">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="p-6 transition-all bg-white border border-gray-100 shadow-sm rounded-3xl sm:p-8 hover:shadow-md">
                    <h2 class="flex items-center gap-2 mb-6 text-xl font-semibold text-gray-900">
                        <span class="flex items-center justify-center w-6 h-6 text-sm font-bold text-white bg-blue-600 rounded-full shadow-sm">2</span>
                        Payment Method
                    </h2>

                    <!-- Stripe Payment Method Selection -->
                    <label class="flex items-center justify-between p-4 border-2 border-blue-600 shadow-sm cursor-pointer rounded-2xl bg-blue-50/20">
                        <div class="flex items-center gap-3">
                            <input type="radio" checked name="payment_method" value="stripe" class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-600">
                            <div>
                                <p class="font-medium text-gray-900">Pay with Credit/Debit Card</p>
                                <p class="text-xs text-gray-500 mt-0.5">Secure payment powered by Stripe</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <!-- Visa icon -->
                            <div class="flex items-center justify-center w-10 h-6 bg-white border border-gray-200 rounded shadow-sm">
                                <span class="text-[10px] font-bold text-blue-800 italic">VISA</span>
                            </div>
                            <!-- Mastercard icon -->
                            <div class="relative flex items-center justify-center w-10 h-6 overflow-hidden bg-white border border-gray-200 rounded shadow-sm">
                                <div class="absolute w-4 h-4 bg-red-500 rounded-full -left-1 opacity-80 mix-blend-multiply"></div>
                                <div class="absolute w-4 h-4 bg-yellow-500 rounded-full -right-1 opacity-80 mix-blend-multiply"></div>
                            </div>
                            <!-- Stripe icon -->
                            <div class="w-10 h-6 bg-[#635BFF] border border-[#635BFF] rounded shadow-sm flex items-center justify-center">
                                <span class="text-[10px] font-bold text-white tracking-widest">stripe</span>
                            </div>
                        </div>
                    </label>
                </div>

                <div class="hidden lg:block">
                    <button type="submit" class="w-full py-4 rounded-2xl bg-black text-white font-semibold text-lg transition-all hover:bg-gray-800 hover:shadow-xl hover:-translate-y-0.5 active:scale-[0.98] flex justify-center items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Pay Now &bull; ${{ number_format($subtotal, 2) }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="lg:w-1/3">
            <div class="p-6 border border-gray-100 shadow-sm bg-gray-50 rounded-3xl sm:p-8 lg:sticky lg:top-8">
                <h2 class="mb-6 text-xl font-bold text-gray-900">Order Summary</h2>

                <div class="mb-6 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="flex items-center justify-center w-16 h-16 p-1 bg-white border border-gray-200 shadow-sm rounded-xl">
                                    @php
                                        $imageUrl = $item->product->images->first()->url ?? $item->product->images->first()->image_path ?? null;
                                    @endphp
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" alt="{{ $item->product->name }}" class="object-cover w-full h-full rounded-lg">
                                    @else
                                        <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @endif
                                </div>
                                <span class="absolute flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-gray-600 rounded-full shadow-md -top-2 -right-2">{{ $item->quantity }}</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-semibold leading-tight text-gray-900 truncate">{{ $item->product->name }}</h4>
                                <p class="mt-1 text-xs text-gray-500">{{ $item->variant->color ?? 'Standard' }} • {{ $item->variant->storage ?? 'N/A' }}</p>
                            </div>
                            <div class="text-sm font-semibold text-gray-900">
                                ${{ number_format($item->variant->price * $item->quantity, 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="py-4 space-y-3 border-t border-gray-200">
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm text-gray-600">
                        <span>Shipping</span>
                        <span class="font-medium text-green-600">Free</span>
                    </div>
                </div>

                <div class="flex items-center justify-between pt-4 mb-6 border-t border-gray-200">
                    <span class="text-base font-bold text-gray-900">Total</span>
                    <span class="text-2xl font-bold text-gray-900">${{ number_format($subtotal, 2) }}</span>
                </div>

                <button type="submit" onclick="document.querySelector('form').submit();" class="w-full lg:hidden py-4 rounded-2xl bg-black text-white font-semibold text-lg transition-all hover:bg-gray-800 hover:shadow-xl hover:-translate-y-0.5 active:scale-[0.98] flex justify-center items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Pay Now &bull; ${{ number_format($subtotal, 2) }}
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
