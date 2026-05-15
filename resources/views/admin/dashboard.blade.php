@extends('layouts.admin')
@section('content')

        <!-- Main Content -->
        <main class="flex flex-col flex-1 overflow-hidden bg-slate-50">
            <!-- Header -->
            <header class="sticky top-0 z-10 flex items-center justify-between h-16 px-8 border-b bg-white/80 glass border-slate-200">
                <div class="flex items-center gap-4">
                    <button class="lg:hidden text-slate-600">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h1 class="text-xl font-bold text-slate-800">Overview</h1>
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="relative hidden md:block">
                        <i data-lucide="search" class="absolute w-4 h-4 -translate-y-1/2 left-3 top-1/2 text-slate-400"></i>
                        <input type="text" placeholder="Search..." class="w-64 py-2 pl-10 pr-4 text-sm transition-all border-none rounded-full bg-slate-100 focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-center gap-3 pl-6 border-l border-slate-200">
                        <div class="flex items-center justify-center w-8 h-8 text-xs font-bold text-indigo-700 bg-indigo-100 border border-indigo-200 rounded-full">
                            AD
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-sm font-semibold text-slate-800">Admin User</p>
                            <p class="text-[10px] text-slate-500 leading-none">Super Admin</p>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 p-8 overflow-y-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 border border-emerald-100 bg-emerald-50 rounded-2xl flex items-center gap-3 text-emerald-700 animate-in fade-in slide-in-from-top-4 duration-500">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <p class="text-sm font-bold">{{ session('success') }}</p>
                    </div>
                @endif
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
                    <!-- Monthly Revenue Card -->
                    <div class="p-6 transition-shadow bg-white border shadow-sm rounded-2xl border-slate-100 hover:shadow-md">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-emerald-50 rounded-xl text-emerald-600">
                                <i data-lucide="trending-up" class="w-6 h-6"></i>
                            </div>
                            <div class="relative">
                                <select id="revenueMonth" class="py-1 pl-3 pr-8 text-xs font-semibold transition-all border-none rounded-full appearance-none cursor-pointer bg-emerald-50 text-emerald-600 focus:ring-2 focus:ring-emerald-200">
                                    @foreach($sales as $sale)
                                        <option value="{{ $sale->month }}" {{ $sale->month == date('n') ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($sale->month)->format('F') }}
                                        </option>
                                    @endforeach
                                    <option value="total">Overall Total</option>
                                </select>
                                <i data-lucide="chevron-down" class="absolute w-3 h-3 -translate-y-1/2 pointer-events-none right-3 top-1/2 text-emerald-600"></i>
                            </div>
                        </div>
                        <p class="mb-1 text-sm font-medium text-slate-500">Revenue Analysis</p>
                        <h3 id="revenueDisplay" class="text-2xl font-bold text-slate-800">
                            $. 0.00
                        </h3>
                    </div>
                    <!-- Stat Card 3 -->
                    <div class="p-6 transition-shadow bg-white border shadow-sm rounded-2xl border-slate-100 hover:shadow-md">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 text-purple-600 bg-purple-50 rounded-xl">
                                <i data-lucide="package" class="w-6 h-6"></i>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full text-slate-400 bg-slate-50">Total</span>
                        </div>
                        <p class="mb-1 text-sm font-medium text-slate-500">Products</p>
                        <h3 class="text-2xl font-bold text-slate-800">{{ count($products) }}</h3>
                    </div>
                    <!-- Stat Card 4 -->
                    <div class="p-6 transition-shadow bg-white border shadow-sm rounded-2xl border-slate-100 hover:shadow-md">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center justify-center w-12 h-12 bg-amber-50 rounded-xl text-amber-600">
                                <i data-lucide="users" class="w-6 h-6"></i>
                            </div>
                            <span class="px-2 py-1 text-xs font-medium rounded-full text-amber-600 bg-amber-50">+8.1%</span>
                        </div>
                        <p class="mb-1 text-sm font-medium text-slate-500">Total Customers</p>
                        <h3 class="text-2xl font-bold text-slate-800">{{$customs->count()}}</h3>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                    <!-- Products Table Section (Takes 2/3 space) -->
                    <div class="self-start overflow-hidden bg-white border shadow-sm lg:col-span-2 rounded-2xl border-slate-100">
                        <div class="flex items-center justify-between p-6 border-b border-slate-100">
                            <div>
                                <h2 class="text-lg font-bold text-slate-800">Product Management</h2>
                                <p class="text-sm text-slate-500">Manage and track your inventory here.</p>
                            </div>
                            <a href="/admin/products/create" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl font-semibold text-sm transition-all shadow-lg shadow-indigo-100">
                                <i data-lucide="plus" class="w-4 h-4"></i>
                                New Product
                            </a>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead>
                                    <tr class="bg-slate-50/50 text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                                        <th class="px-6 py-4">ID</th>
                                        <th class="px-6 py-4">Product Info</th>
                                        <th class="px-6 py-4 text-right">Price</th>
                                        <th class="px-6 py-4 text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100">
                                    @foreach ($products as $product)
                                        <tr class="transition-colors hover:bg-slate-50/50">
                                            <td class="px-6 py-4 text-sm font-medium text-slate-400">#{{ $product->id }}</td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="flex items-center justify-center w-10 h-10 overflow-hidden rounded-lg bg-slate-100 text-slate-400">
                                                        <img
                                                            src="{{ $product->images->first()->image_path }}"
                                                            alt="{{ $product->name }}"
                                                            class="w-full h-full object-cover transition-transform duration-1000 ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:scale-110"
                                                        >
                                                    </div>
                                                    <span class="text-sm font-semibold text-slate-800 line-clamp-1">{{ $product->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-sm font-bold text-right text-slate-700">
                                                ${{ number_format($product->price, 2) }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <div class="flex items-center justify-end gap-1">
                                                    <a href="/admin/products/{{ $product->id }}/edit" class="p-2 transition-all rounded-lg text-slate-400 hover:text-indigo-600 hover:bg-indigo-50" title="Edit">
                                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                                    </a>
                                                    <form action="/admin/products/{{ $product->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2 transition-all rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50" title="Delete">
                                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($products) == 0)
                                        <tr>
                                            <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                                <div class="flex flex-col items-center gap-2">
                                                    <i data-lucide="inbox" class="w-12 h-12 text-slate-200"></i>
                                                    <p>No products found.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @if($products->hasPages())
                                <div class="px-6 py-4 border-t border-gray-200">
                                    {{ $products->links() }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity Section (Takes 1/3 space) -->
                    <div class="self-start p-6 bg-white border shadow-sm rounded-2xl border-slate-100">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-lg font-bold text-slate-800">Recent Activity</h2>
                            <button class="text-xs font-semibold text-indigo-600 hover:text-indigo-700">View All</button>
                        </div>
                        
                        <div class="space-y-6">
                            <!-- Activity Item 1 -->
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="relative z-10 flex items-center justify-center w-10 h-10 text-indigo-600 rounded-full bg-indigo-50">
                                        <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                                    </div>
                                    <div class="absolute top-10 bottom-[-24px] left-1/2 -translate-x-1/2 w-px bg-slate-100"></div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-800">New Order #8492</p>
                                    <p class="text-xs text-slate-500">2 minutes ago</p>
                                    <div class="p-2 mt-2 text-xs border rounded bg-slate-50 border-slate-100 text-slate-600">
                                        Customer: John Doe <br> Total: $1,299.00
                                    </div>
                                </div>
                            </div>

                            <!-- Activity Item 2 -->
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full bg-emerald-50 text-emerald-600">
                                        <i data-lucide="user-plus" class="w-5 h-5"></i>
                                    </div>
                                    <div class="absolute top-10 bottom-[-24px] left-1/2 -translate-x-1/2 w-px bg-slate-100"></div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-800">New Customer Joined</p>
                                    <p class="text-xs text-slate-500">45 minutes ago</p>
                                </div>
                            </div>

                            <!-- Activity Item 3 -->
                            <div class="flex gap-4">
                                <div class="relative">
                                    <div class="relative z-10 flex items-center justify-center w-10 h-10 rounded-full bg-amber-50 text-amber-600">
                                        <i data-lucide="alert-circle" class="w-5 h-5"></i>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-slate-800">Low Stock Warning</p>
                                    <p class="text-xs text-slate-500">2 hours ago</p>
                                    <p class="mt-1 text-xs font-medium text-amber-600">iPhone 15 Pro is below 5 units.</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 mt-8 border-t border-slate-100">
                            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-xl">
                                <div class="flex items-center justify-center w-12 h-12 bg-white border rounded-lg shadow-sm border-slate-100">
                                    <i data-lucide="help-circle" class="w-6 h-6 text-slate-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-slate-800">Need help?</p>
                                    <p class="text-[10px] text-slate-500 leading-tight">Check our documentation or contact support.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salesData = @json($sales);
            const totalRevenue = {{ $totalRevenue }};
            const revenueDisplay = document.getElementById('revenueDisplay');
            const revenueMonth = document.getElementById('revenueMonth');

            function formatCurrency(amount) {
                return '$. ' + parseFloat(amount).toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function updateRevenue() {
                const selected = revenueMonth.value;
                if (selected === 'total') {
                    revenueDisplay.innerText = formatCurrency(totalRevenue);
                } else {
                    const sale = salesData.find(s => s.month == selected);
                    revenueDisplay.innerText = formatCurrency(sale ? sale.total_sales : 0);
                }
            }

            if (revenueMonth) {
                revenueMonth.addEventListener('change', updateRevenue);
                updateRevenue(); // Initial update
            }

            // Re-initialize Lucide icons in case they weren't
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection



