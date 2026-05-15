<!DOCTYPE html>
<html lang="en">
<head>
    @livewireStyles
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSphere | Premium Apple Products</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --nav-bg: rgba(255, 255, 255, 0.8);
            --nav-border: rgba(0, 0, 0, 0.08);
            --apple-blue: #0066cc;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #ffffff;
            color: #1d1d1f;
        }

        .nav-glass {
            background-color: var(--nav-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid var(--nav-border);
            border-radius: 2rem;
            margin-top: 1rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        .nav-link {
            position: relative;
            color: #1d1d1f;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: -0.01em;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover {
            background: rgba(0, 0, 0, 0.05);
            color: #000000;
        }

        .nav-link.active {
            background: rgba(0, 0, 0, 0.08);
            font-weight: 600;
        }

        .search-pill {
            background: rgba(0, 0, 0, 0.04);
            border: 1px solid transparent;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .search-pill:focus-within {
            background: #ffffff;
            border-color: var(--apple-blue);
            box-shadow: 0 0 0 4px rgba(0, 102, 204, 0.1);
        }

        .cart-badge {
            background: var(--apple-blue);
            box-shadow: 0 2px 4px rgba(0, 102, 204, 0.3);
        }

        /* Mobile Menu Animation */
        [x-cloak] { display: none !important; }
        
        .mobile-menu-enter { transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s; }
        .mobile-menu-enter-start { transform: translateY(-20px); opacity: 0; }
        .mobile-menu-enter-end { transform: translateY(0); opacity: 1; }
    </style>
</head>
<body class="flex flex-col min-h-screen antialiased">
    @include('components.nav')

    <!-- Main Content wrapper -->
    <main class="">
        <div class="">
            @yield('content')
        </div>
    </main>

   @include('components.footer')
@livewireStyles
</body>
</html>