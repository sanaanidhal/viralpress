<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — ViralPress</title>
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
    <div class="hero-gradient text-white flex flex-col justify-between p-12 hidden md:flex">
        <a href="{{ route('home') }}" class="font-display text-3xl font-black">
            VIRAL<span class="text-red-500">PRESS</span>
        </a>
        <div>
            <p class="text-gray-400 text-xs uppercase tracking-widest mb-4">Publishing Platform</p>
            <h2 class="font-display text-5xl font-black leading-tight mb-6">
                Stories that move the world.
            </h2>
            <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
                Join our team of writers and editors delivering viral content to over 10 million readers every month.
            </p>
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

            <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Welcome back</p>
            <h1 class="font-display text-4xl font-black mb-8">Sign In</h1>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-600 text-sm px-4 py-3 rounded-xl mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full border-0 border-b-2 border-gray-200 px-0 py-3 text-lg focus:outline-none focus:border-black transition bg-transparent">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Password</label>
                    <input name="password" type="password" required
                        class="w-full border-0 border-b-2 border-gray-200 px-0 py-3 text-lg focus:outline-none focus:border-black transition bg-transparent">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-500 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-gray-400 hover:text-black transition">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-black text-white py-4 rounded-full font-semibold text-sm hover:bg-gray-800 transition">
                    Sign In →
                </button>

                <p class="text-center text-sm text-gray-400">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-black font-semibold hover:text-red-600 transition">
                        Register
                    </a>
                </p>
            </form>
        </div>
    </div>

</div>

</body>
</html>