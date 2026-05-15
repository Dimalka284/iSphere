@extends('layouts.frontend')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center px-4 py-12">
    <div class="max-w-lg w-full bg-white rounded-3xl p-10 text-center shadow-sm border border-gray-100">
        <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-8 border border-green-100">
            <svg class="w-12 h-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Successful!</h1>
        <p class="text-gray-600 mb-8 text-lg leading-relaxed">
            Thank you for your purchase. Your order has been placed and is currently being processed. You will receive a confirmation email shortly.
        </p>
        
        <div class="bg-gray-50 rounded-2xl p-6 mb-8 text-left border border-gray-100">
            <h3 class="font-semibold text-gray-900 mb-2">What's Next?</h3>
            <ul class="text-sm text-gray-600 space-y-2">
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    We'll pack your items with care.
                </li>
                <li class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    You'll be notified once it ships.
                </li>
            </ul>
        </div>

        <a href="{{ url('/') }}" class="w-full flex items-center justify-center py-4 rounded-2xl bg-black text-white font-semibold text-lg transition-all hover:bg-gray-800 hover:shadow-xl hover:-translate-y-0.5 active:scale-[0.98]">
            Continue Shopping
        </a>
    </div>
</div>
@endsection
