@extends('layouts.app')
@section('title', $article->title)

@section('content')

<!-- Article Header -->
<div class="hero-gradient text-white py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <div class="fade-in">
            <a href="{{ route('article.category', $article->category->slug) }}"
                class="inline-block bg-red-600 text-white text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full mb-6 hover:bg-red-700 transition">
                {{ $article->category->name }}
            </a>
            <h1 class="font-display text-4xl md:text-6xl font-black leading-tight mb-6">
                {{ $article->title }}
            </h1>
            <p class="text-gray-300 text-xl leading-relaxed mb-8 max-w-2xl mx-auto">
                {{ $article->excerpt }}
            </p>
            <div class="flex items-center justify-center gap-6 text-sm text-gray-400">
                <span class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-red-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr($article->user->name, 0, 1)) }}
                    </div>
                    {{ $article->user->name }}
                </span>
                <span>·</span>
                <span>{{ $article->created_at->format('F j, Y') }}</span>
                <span>·</span>
                <span>👁 {{ number_format($article->views) }} views</span>
                <span>·</span>
                <span>{{ ceil(str_word_count($article->body) / 200) }} min read</span>
            </div>
        </div>
    </div>
</div>

<!-- Featured image -->
@if($article->image)
<div class="max-w-5xl mx-auto px-4 -mt-8">
    <img src="{{ $article->image }}"
        class="w-full h-96 object-cover rounded-2xl shadow-2xl fade-in-delay">
</div>
@endif

<!-- Article body -->
<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed text-lg fade-in-delay-2"
        style="font-family: 'Inter', sans-serif; line-height: 1.9;">
        {!! nl2br(e($article->body)) !!}
    </div>

    <!-- Share bar -->
    <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <span class="text-sm text-gray-500 font-medium">Share:</span>
            <button onclick="navigator.clipboard.writeText(window.location.href).then(() => alert('Link copied!'))"
                class="bg-black text-white px-4 py-2 rounded-full text-xs font-bold hover:bg-gray-800 transition">
                Copy Link
            </button>
        </div>
        <div class="flex items-center gap-2 text-sm text-gray-400">
            <span>👁 {{ number_format($article->views) }} views</span>
        </div>
    </div>

    <!-- Author box -->
    <div class="mt-10 bg-gray-50 rounded-2xl p-8 flex items-center gap-6">
        <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center text-white text-2xl font-display font-black flex-shrink-0">
            {{ strtoupper(substr($article->user->name, 0, 1)) }}
        </div>
        <div>
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-1">Written by</p>
            <p class="font-display text-xl font-bold">{{ $article->user->name }}</p>
            <p class="text-gray-500 text-sm mt-1">Staff Writer at ViralPress</p>
        </div>
    </div>
</div>

<!-- Related articles -->
@if($related->count())
<div class="bg-gray-50 py-16 mt-8">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="font-display text-3xl font-black mb-10 text-center">More from
            <span class="text-red-600">{{ $article->category->name }}</span>
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($related as $rel)
            <a href="{{ route('article.show', $rel->slug) }}" class="card-hover group block bg-white rounded-2xl overflow-hidden shadow-sm">
                @if($rel->image)
                    <img src="{{ $rel->image }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-500">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                        <span class="font-display text-white text-4xl font-black opacity-10">VP</span>
                    </div>
                @endif
                <div class="p-6">
                    <span class="text-xs text-red-600 font-bold uppercase tracking-widest">
                        {{ $rel->category->name }}
                    </span>
                    <h3 class="font-display text-lg font-bold mt-2 leading-tight group-hover:text-red-600 transition line-clamp-2">
                        {{ $rel->title }}
                    </h3>
                    <p class="text-gray-400 text-xs mt-3">{{ $rel->created_at->diffForHumans() }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection