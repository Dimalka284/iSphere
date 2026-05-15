@extends('layouts.admin')

@section('content')
<main class="flex-1 overflow-y-auto bg-slate-50/50">
    <div class="px-8 py-8 mx-auto max-w-7xl">
        <!-- Header -->
        <div class="flex flex-col mb-8 gap-4 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Customers</h1>
                <p class="mt-1 text-slate-500">Manage and view your customer base and their activities.</p>
            </div>
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold transition-all bg-white border rounded-xl text-slate-700 border-slate-200 hover:bg-slate-50 shadow-sm">
                    <i data-lucide="download" class="w-4 h-4"></i>
                    Export
                </button>
                <button class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white transition-all bg-indigo-600 rounded-xl hover:bg-indigo-700 shadow-md shadow-indigo-100">
                    <i data-lucide="user-plus" class="w-4 h-4"></i>
                    Add Customer
                </button>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-3">
            <div class="p-6 bg-white border border-slate-100 shadow-sm rounded-2xl">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-indigo-50 rounded-xl text-indigo-600">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Total Customers</p>
                        <p class="text-2xl font-bold text-slate-900">{{ $customers->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white border border-slate-100 shadow-sm rounded-2xl">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-xl text-emerald-600">
                        <i data-lucide="user-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">Active Today</p>
                        <p class="text-2xl font-bold text-slate-900">{{ rand(5, 15) }}</p>
                    </div>
                </div>
            </div>
            <div class="p-6 bg-white border border-slate-100 shadow-sm rounded-2xl">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-xl text-amber-600">
                        <i data-lucide="user-plus" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-500">New This Week</p>
                        <p class="text-2xl font-bold text-slate-900">{{ rand(2, 8) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="overflow-hidden bg-white border border-slate-200 shadow-sm rounded-2xl">
            <div class="p-6 border-b border-slate-100">
                <div class="relative max-w-sm">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i data-lucide="search" class="w-4 h-4 text-slate-400"></i>
                    </span>
                    <input type="text" class="block w-full py-2 pl-10 pr-3 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:ring-indigo-500 focus:border-indigo-500 text-slate-900" placeholder="Search customers...">
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Customer</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Email</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Join Date</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($customers as $customer)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center justify-center w-10 h-10 font-bold text-indigo-600 bg-indigo-50 rounded-full">
                                            {{ strtoupper(substr($customer->name, 0, 1)) }}
                                        </div>
                                        <div class="font-medium text-slate-900">{{ $customer->name }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-600">{{ $customer->email }}</td>
                                <td class="px-6 py-4 text-slate-600">{{ $customer->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Active
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="p-2 text-slate-400 transition-colors hover:text-indigo-600">
                                        <i data-lucide="more-horizontal" class="w-5 h-5"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 bg-slate-50/30 border-t border-slate-100">
                <div class="flex items-center justify-between text-sm text-slate-500">
                    <p>Showing {{ $customers->count() }} customers</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection