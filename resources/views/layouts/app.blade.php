<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ViralPress — @yield('title', 'Latest Articles')</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .hero-gradient { background: linear-gradient(135deg, #000000 0%, #1a1a2e 50%, #16213e 100%); }
        .card-hover { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .card-hover:hover { transform: translateY(-8px); box-shadow: 0 30px 60px -12px rgba(0,0,0,0.15); border-radius: 0.75rem; }
        .category-pill { transition: all 0.2s ease; }
        .category-pill:hover { letter-spacing: 0.05em; }
        .reading-progress { position: fixed; top: 0; left: 0; height: 3px; background: #000; z-index: 9999; transition: width 0.1s; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        .fade-in { animation: fadeInUp 0.6s ease forwards; }
        .fade-in-delay { animation: fadeInUp 0.6s ease 0.2s forwards; opacity: 0; }
        .fade-in-delay-2 { animation: fadeInUp 0.6s ease 0.4s forwards; opacity: 0; }
        .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

    <div class="reading-progress" id="readingProgress"></div>

    <!-- Top bar -->
    <div class="border-b border-gray-100 py-2 px-4 text-xs text-gray-400 flex justify-between items-center max-w-7xl mx-auto">
        <span>{{ now()->format('l, F j, Y') }}</span>
        <span class="font-semibold tracking-widest text-black uppercase text-xs">ViralPress</span>
        <span>10M+ Monthly Readers</span>
    </div>

    <!-- Main navbar -->
    <nav class="sticky top-0 z-50 bg-white border-b border-gray-200" id="navbar">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}" class="font-display text-3xl font-black tracking-tight text-black hover:text-gray-700 transition">
                    VIRAL<span class="text-red-600">PRESS</span>
                </a>

                <!-- Categories nav -->
                <div class="hidden md:flex items-center gap-6">
                    @php $navCategories = \App\Models\Category::take(5)->get(); @endphp
                    @foreach($navCategories as $cat)
                        <a href="{{ route('article.category', $cat->slug) }}"
                            class="text-sm font-medium text-gray-600 hover:text-black transition uppercase tracking-wide">
                            {{ $cat->name }}
                        </a>
                    @endforeach
                </div>

                <!-- Right side -->
                <div class="flex items-center gap-4">
                    <button onclick="toggleSearch()" class="text-gray-600 hover:text-black transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                    @auth
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-sm font-medium bg-black text-white px-4 py-2 rounded-full hover:bg-gray-800 transition">
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="text-sm text-gray-500 hover:text-black transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium border border-black px-4 py-2 rounded-full hover:bg-black hover:text-white transition">
                            Sign In
                        </a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Search bar (hidden by default) -->
        <div id="searchBar" class="hidden border-t border-gray-100 py-4 px-4 bg-gray-50">
            <form action="{{ route('article.search') }}" method="GET"
                class="max-w-2xl mx-auto flex gap-3">
                <input name="q" type="text" placeholder="Search articles, topics, categories..."
                    value="{{ request('q') }}"
                    class="flex-1 border-0 border-b-2 border-black bg-transparent px-0 py-2 text-lg focus:outline-none focus:border-red-600 transition"
                    autofocus>
                <button class="bg-black text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                    Search
                </button>
            </form>
        </div>
    </nav>

    @if(session('success'))
        <div class="bg-green-50 border-b border-green-200 text-green-800 text-center py-3 text-sm font-medium">
            ✓ {{ session('success') }}
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-2">
                    <div class="font-display text-4xl font-black mb-4">
                        VIRAL<span class="text-red-500">PRESS</span>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                        Delivering viral content, breaking news, and in-depth stories to over 10 million readers every month.
                    </p>
                </div>
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-widest mb-4">Categories</h4>
                    <ul class="space-y-2">
                        @foreach(\App\Models\Category::all() as $cat)
                            <li>
                                <a href="{{ route('article.category', $cat->slug) }}"
                                    class="text-gray-400 hover:text-white text-sm transition">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-widest mb-4">ViralPress</h4>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <li>Built with Laravel 11</li>
                        <li>MySQL Database</li>
                        <li>REST API Available</li>
                        <li><a href="/api/articles" class="hover:text-white transition">→ View API</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500 text-xs">
                © {{ date('Y') }} ViralPress. Built with Laravel & Tailwind CSS.
            </div>
        </div>
    </footer>

    <script>
        // Search toggle
        function toggleSearch() {
            const bar = document.getElementById('searchBar');
            bar.classList.toggle('hidden');
            if (!bar.classList.contains('hidden')) {
                bar.querySelector('input').focus();
            }
        }

        // Reading progress bar
        window.addEventListener('scroll', () => {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('readingProgress').style.width = scrolled + '%';
        });

        // Navbar shadow on scroll
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-sm');
            } else {
                navbar.classList.remove('shadow-sm');
            }
        });
    </script>
</body>
</html>