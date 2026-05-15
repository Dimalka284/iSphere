<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSphere Admin Dashboard</title>
    <!-- Tailwind CSS v4 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, .font-display {
            font-family: 'Outfit', sans-serif;
        }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-item-active {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0) 100%);
            border-left: 4px solid #4f46e5;
            color: #4f46e5;
        }
    </style>
</head>
<body class="h-full overflow-hidden">
    <div class="flex h-full">
        <!-- Sidebar -->
        <aside class="flex flex-col flex-shrink-0 hidden w-64 bg-white border-r border-slate-200 lg:flex">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 text-white bg-indigo-600 shadow-lg rounded-xl shadow-indigo-200">
                        <i data-lucide="layers" class="w-6 h-6"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-800">iSphere</span>
                </div>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1">
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-200 rounded-lg {{ request()->is('dashboard') ? 'sidebar-item-active' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    Dashboard
                </a>
                <a href="/admin/products/create" class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-200 rounded-lg {{ request()->is('admin/products*') ? 'sidebar-item-active' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                    <i data-lucide="package" class="w-5 h-5"></i>
                    Products
                </a>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-200 rounded-lg {{ request()->routeIs('admin.orders.index') ? 'sidebar-item-active' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                    <i data-lucide="shopping-cart" class="w-5 h-5"></i>
                    Orders
                </a>
                <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-200 rounded-lg {{ request()->routeIs('admin.customers.index') ? 'sidebar-item-active' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600' }}">
                    <i data-lucide="users" class="w-5 h-5"></i>
                    Customers
                </a>
                <div class="px-4 pt-4 pb-2 text-xs font-semibold tracking-wider uppercase text-slate-400">System</div>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium transition-all duration-200 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-indigo-600">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                    Settings
                </a>
            </nav>
        </aside>
        @yield('content')
    </div>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>