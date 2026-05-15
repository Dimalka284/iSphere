@extends('layouts.admin')

@section('content')
<main class="flex-1 overflow-y-auto bg-slate-50/50">
    <div class="px-8 py-8 mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex flex-col mb-8 gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Orders Management</h1>
                <p class="mt-1 text-slate-500">Track and manage customer orders and payment statuses.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    </span>
                    <input type="text" class="block w-full py-2 pl-10 pr-3 text-sm bg-white border border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-slate-900 shadow-sm" placeholder="Filter orders...">
                </div>
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition-all bg-white border rounded-xl text-slate-700 border-slate-200 hover:bg-slate-50 shadow-sm">
                    <i data-lucide="filter" class="w-4 h-4"></i>
                    Filters
                </button>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="flex items-center gap-3 p-4 mb-6 text-emerald-700 bg-emerald-50 border border-emerald-100 rounded-2xl animate-in fade-in slide-in-from-top-4 duration-300">
                <i data-lucide="check-circle" class="w-5 h-5"></i>
                <p class="text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <!-- Table Card -->
        <div class="overflow-hidden bg-white border border-slate-200 shadow-sm rounded-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50/50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Order</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Customer</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Payment</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Total</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Address</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Date</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($orders as $order)
                        <tr class="transition-colors hover:bg-slate-50/30">
                            <!-- Order ID -->
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-xs font-bold bg-slate-100 text-slate-700">
                                    #{{ $order->id }}
                                </span>
                            </td>

                            <!-- Customer Info -->
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $order->first_name }} {{ $order->last_name }}</p>
                                    <p class="text-sm text-slate-500 flex items-center gap-1">
                                        <i data-lucide="phone" class="w-3 h-3"></i>
                                        {{ $order->phone_number }}
                                    </p>
                                </div>
                            </td>

                            <!-- Payment Status -->
                            <td class="px-6 py-4">
                                @if($order->payment_status == 'paid')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Paid
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <!-- Total -->
                            <td class="px-6 py-4">
                                <p class="font-bold text-slate-900">Rs. {{ number_format($order->total_amount, 2) }}</p>
                            </td>

                            <!-- Address -->
                            <td class="px-6 py-4">
                                <div class="max-w-[200px]">
                                    <p class="text-sm text-slate-600 truncate">{{ $order->address }}</p>
                                    <p class="text-xs text-slate-400">{{ $order->district }}</p>
                                </div>
                            </td>

                            <!-- Date -->
                            <td class="px-6 py-4">
                                <p class="text-sm text-slate-600">{{ $order->created_at->format('d M, Y') }}</p>
                                <p class="text-xs text-slate-400">{{ $order->created_at->format('h:i A') }}</p>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <button class="p-2 text-slate-400 hover:text-indigo-600 transition-colors bg-slate-50 rounded-lg">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                    <button class="p-2 text-slate-400 hover:text-rose-600 transition-colors bg-slate-50 rounded-lg">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mb-4">
                                        <i data-lucide="shopping-bag" class="w-8 h-8"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-slate-900">No orders found</h3>
                                    <p class="text-slate-500 max-w-xs mx-auto">When customers place orders, they will appear here in the order management system.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</main>
@endsection