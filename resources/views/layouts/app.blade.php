<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViralPress - @yield('title', 'Latest Articles')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-red-600">⚡ ViralPress</a>
            <form action="{{ route('article.search') }}" method="GET" class="flex">
                <input name="q" type="text" placeholder="Search articles..."
                    class="border rounded-l px-3 py-1 text-sm focus:outline-none"
                    value="{{ request('q') }}">
                <button class="bg-red-600 text-white px-3 py-1 rounded-r text-sm">Search</button>
            </form>
            <div class="flex gap-4 text-sm">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-red-600">Admin</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-gray-600 hover:text-red-600">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-red-600">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash message -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 text-center py-2 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main content -->
    <main class="max-w-6xl mx-auto px-4 py-8">
        @yield('content')
    </main>

    <footer class="bg-white border-t mt-12 py-6 text-center text-sm text-gray-500">
        © {{ date('Y') }} ViralPress. Built with Laravel.
    </footer>

</body>
</html>