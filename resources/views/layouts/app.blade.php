<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<<<<<<< HEAD
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
=======
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'To-Do') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { background: #f5f5f5; color: #000; font-family: Arial, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        body.dark { background: #121212; color: #fff; }
        .card { max-width: 800px; background: #fff; border-radius: 12px; padding: 2rem; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        body.dark .card { background: #1e1e1e; box-shadow: 0 4px 8px rgba(255,255,255,0.1); }
        .btn { background: #007bff; color: #fff; padding: 0.5rem 1rem; border-radius: 24px; text-decoration: none; }
        body.dark .btn { background: #0d6efd; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 0.75rem; border: 1px solid #ddd; }
        body.dark .table th, body.dark .table td { border-color: #444; }
    </style>
</head>
<body class="{{ request()->cookie('theme', 'light') }}">

    <!-- থিম টগল বাটন -->
    @auth
        <form action="{{ route('theme.toggle') }}" method="POST" style="position:fixed;top:1rem;right:1rem;">
            @csrf
            <button type="submit" class="btn">
                {{ request()->cookie('theme', 'light') === 'dark' ? '☀️' : '🌙' }}
            </button>
        </form>
    @endauth

    <!-- লগআউট -->
    @auth
        <form method="POST" action="{{ route('logout') }}" style="position:fixed;top:1rem;right:6rem;">
            @csrf
            <button type="submit" class="btn">Logout</button>
        </form>
    @endauth

    <div class="card">
        @yield('content')
    </div>

    <!-- অটো থিম অ্যাপ্লাই JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const theme = document.cookie.split('; ').find(row => row.startsWith('theme='))
                ?.split('=')[1] || 'light';
            document.body.classList.toggle('dark', theme === 'dark');
        });
    </script>

</body>
>>>>>>> b003ea31e7bc326646efdec4665b8c8836014d36
</html>
