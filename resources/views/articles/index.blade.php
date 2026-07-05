@extends('layouts.app')
@section('title', isset($category) ? $category->name : 'Latest Articles')

@section('content')

@if(!isset($q) && !isset($category))
    <!-- HERO SECTION — featured article -->
    @php $featured = $articles->first(); @endphp
    @if($featured)
    <div class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto px-4 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <span class="inline-block bg-red-600 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full mb-6">
                        {{ $featured->category->name }}
                    </span>
                    <h1 class="font-display text-4xl md:text-6xl font-black leading-tight mb-6">
                        {{ $featured->title }}
                    </h1>
                    <p class="text-gray-300 text-lg leading-relaxed mb-8 line-clamp-3">
                        {{ $featured->excerpt }}
                    </p>
                    <div class="flex items-center gap-6">
                        <a href="{{ route('article.show', $featured->slug) }}"
                            class="bg-white text-black px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition text-sm">
                            Read Article →
                        </a>
                        <span class="text-gray-400 text-sm">👁 {{ number_format($featured->views) }} views</span>
                    </div>
                </div>
                <div class="fade-in-delay">
                    @if($featured->image)
                        <img src="{{ $featured->image }}" class="rounded-2xl w-full h-80 object-cover shadow-2xl">
                    @else
                        <div class="rounded-2xl w-full h-80 bg-gradient-to-br from-red-600 to-red-900 flex items-center justify-center shadow-2xl">
                            <span class="font-display text-white text-8xl font-black opacity-20">VP</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
@endif

<div class="max-w-7xl mx-auto px-4 py-12">

    <!-- Page header for category/search -->
    @if(isset($category))
        <div class="mb-10 pb-6 border-b-2 border-black">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Category</p>
            <h1 class="font-display text-5xl font-black">{{ $category->name }}</h1>
        </div>
    @elseif(isset($q))
        <div class="mb-10 pb-6 border-b-2 border-black">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Search Results</p>
            <h1 class="font-display text-5xl font-black">"{{ $q }}"</h1>
            <p class="text-gray-500 mt-2">{{ $articles->total() }} articles found</p>
        </div>
    @else
        <!-- Category filter pills -->
        <div class="flex gap-3 flex-wrap mb-10">
            <a href="{{ route('home') }}"
                class="category-pill px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest bg-black text-white">
                All
            </a>
            @foreach($categories as $cat)
                <a href="{{ route('article.category', $cat->slug) }}"
                    class="category-pill px-4 py-2 rounded-full text-xs font-bold uppercase tracking-widest border border-gray-200 text-gray-600 hover:bg-black hover:text-white hover:border-black transition">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    @endif

    @if($articles->count())

        @php $articles_list = isset($q) || isset($category) ? $articles : $articles->skip(1); @endphp

        @if(!isset($q) && !isset($category) && $articles->count() >= 2)
            <!-- Featured row — 2nd and 3rd articles large -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                @foreach($articles->slice(1, 2) as $article)
                <a href="{{ route('article.show', $article->slug) }}" class="card-hover group block overflow-hidden rounded-xl bg-white">
                    <div class="relative overflow-hidden rounded-2xl mb-4">
                        @if($article->image)
                            <img src="{{ $article->image }}" class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center rounded-2xl">
                                <span class="font-display text-white text-6xl font-black opacity-10">VP</span>
                            </div>
                        @endif
                        <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold uppercase tracking-widest px-3 py-1 rounded-full">
                            {{ $article->category->name }}
                        </span>
                    </div>
                    <h2 class="font-display text-2xl font-bold leading-tight mb-2 group-hover:text-red-600 transition line-clamp-2">
                        {{ $article->title }}
                    </h2>
                    <p class="text-gray-500 text-sm line-clamp-2">{{ $article->excerpt }}</p>
                    <div class="flex gap-4 mt-3 text-xs text-gray-400">
                        <span>{{ $article->created_at->diffForHumans() }}</span>
                        <span>👁 {{ number_format($article->views) }}</span>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="border-t border-gray-100 pt-10 mb-8">
                <h2 class="font-display text-2xl font-bold mb-8">More Stories</h2>
            </div>
        @endif

        <!-- Article grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @php
                $start = (!isset($q) && !isset($category)) ? 3 : 0;
                $gridArticles = $articles->slice($start);
            @endphp
            @foreach($gridArticles as $article)
            <a href="{{ route('article.show', $article->slug) }}" class="card-hover group block overflow-hidden rounded-xl bg-white">
                <div class="relative overflow-hidden rounded-xl mb-4">
                    @if($article->image)
                        <img src="{{ $article->image }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center rounded-xl">
                            <span class="font-display text-gray-300 text-5xl font-black">VP</span>
                        </div>
                    @endif
                    <span class="absolute top-3 left-3 bg-white text-black text-xs font-bold uppercase tracking-widest px-2 py-1 rounded-full shadow-sm">
                        {{ $article->category->name }}
                    </span>
                </div>
                <h3 class="font-display text-lg font-bold leading-tight mb-2 group-hover:text-red-600 transition line-clamp-2">
                    {{ $article->title }}
                </h3>
                <p class="text-gray-500 text-sm line-clamp-2 mb-3">{{ $article->excerpt }}</p>
                <div class="flex justify-between text-xs text-gray-400">
                    <span>{{ $article->created_at->diffForHumans() }}</span>
                    <span>👁 {{ number_format($article->views) }}</span>
                </div>
            </a>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-16 flex justify-center">
            {{ $articles->links() }}
        </div>

    @else
        <div class="text-center py-24">
            <p class="font-display text-6xl font-black text-gray-100 mb-4">404</p>
            <p class="text-gray-400 text-lg">No articles found.</p>
            <a href="{{ route('home') }}" class="inline-block mt-6 bg-black text-white px-8 py-3 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                Back to Home
            </a>
        </div>
    @endif

</div>

@endsection