<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — ViralPress</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
        .hero-gradient { background: linear-gradient(135deg, #000000 0%, #1a1a2e 50%, #16213e 100%); }
    </style>
</head>
<body class="bg-white">

<div class="min-h-screen grid grid-cols-1 md:grid-cols-2">

    <!-- Left side — branding -->
    <div class="hero-gradient text-white flex-col justify-between p-12 hidden md:flex">
        <a href="{{ route('home') }}" class="font-display text-3xl font-black">
            VIRAL<span class="text-red-500">PRESS</span>
        </a>
        <div>
            <p class="text-gray-400 text-xs uppercase tracking-widest mb-4">Join the team</p>
            <h2 class="font-display text-5xl font-black leading-tight mb-6">
                Start publishing today.
            </h2>
            <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                Create your account and start writing stories that reach millions of readers around the world.
            </p>
            <div class="mt-8 grid grid-cols-3 gap-4">
                <div class="bg-white/5 rounded-xl p-4 text-center">
                    <p class="font-display text-2xl font-black text-white">10M+</p>
                    <p class="text-gray-400 text-xs mt-1">Readers</p>
                </div>
                <div class="bg-white/5 rounded-xl p-4 text-center">
                    <p class="font-display text-2xl font-black text-red-500">5+</p>
                    <p class="text-gray-400 text-xs mt-1">Categories</p>
                </div>
                <div class="bg-white/5 rounded-xl p-4 text-center">
                    <p class="font-display text-2xl font-black text-white">∞</p>
                    <p class="text-gray-400 text-xs mt-1">Stories</p>
                </div>
            </div>
        </div>
        <div class="flex gap-6 text-xs text-gray-500">
            <span>10M+ Readers</span>
            <span>·</span>
            <span>Built with Laravel</span>
            <span>·</span>
            <span>REST API</span>
        </div>
    </div>

    <!-- Right side — form -->
    <div class="flex items-center justify-center p-8">
        <div class="w-full max-w-md">

            <!-- Mobile logo -->
            <a href="{{ route('home') }}" class="font-display text-2xl font-black md:hidden block mb-10">
                VIRAL<span class="text-red-600">PRESS</span>
            </a>

            <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Get started</p>
            <h1 class="font-display text-4xl font-black mb-8">Create Account</h1>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-xl mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Full Name</label>
                    <input name="name" type="text" value="{{ old('name') }}" required autofocus
                        class="w-full border-0 border-b-2 border-gray-200 px-0 py-3 text-lg focus:outline-none focus:border-black transition bg-transparent">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required
                        class="w-full border-0 border-b-2 border-gray-200 px-0 py-3 text-lg focus:outline-none focus:border-black transition bg-transparent">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Password</label>
                    <input name="password" type="password" required
                        class="w-full border-0 border-b-2 border-gray-200 px-0 py-3 text-lg focus:outline-none focus:border-black transition bg-transparent">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Confirm Password</label>
                    <input name="password_confirmation" type="password" required
                        class="w-full border-0 border-b-2 border-gray-200 px-0 py-3 text-lg focus:outline-none focus:border-black transition bg-transparent">
                </div>

                <button type="submit"
                    class="w-full bg-black text-white py-4 rounded-full font-semibold text-sm hover:bg-gray-800 transition">
                    Create Account →
                </button>

                <p class="text-center text-sm text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-black font-semibold hover:text-red-600 transition">
                        Sign In
                    </a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>