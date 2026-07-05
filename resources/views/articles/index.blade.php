@extends('layouts.app')

@section('title', isset($category) ? $category->name : 'Latest Articles')

@section('content')

    <!-- Categories bar -->
    <div class="flex gap-2 flex-wrap mb-6">
        <a href="{{ route('home') }}"
            class="px-3 py-1 rounded-full text-sm bg-red-600 text-white">All</a>
        @foreach($categories as $cat)
            <a href="{{ route('article.category', $cat->slug) }}"
                class="px-3 py-1 rounded-full text-sm bg-white border hover:bg-red-600 hover:text-white transition">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>

    <!-- Page title -->
    @isset($q)
        <h2 class="text-xl font-bold mb-4">Search results for: "{{ $q }}"</h2>
    @endisset

    <!-- Articles grid -->
    @if($articles->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
                    @if($article->image)
                        <img src="{{ $article->image }}" class="w-full h-48 object-cover">
                    @else
                        <div class="w-full h-48 bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                            <span class="text-white text-4xl">⚡</span>
                        </div>
                    @endif
                    <div class="p-4">
                        <span class="text-xs text-red-600 font-semibold uppercase">
                            {{ $article->category->name }}
                        </span>
                        <h2 class="font-bold text-lg mt-1 mb-2 leading-tight">
                            <a href="{{ route('article.show', $article->slug) }}"
                                class="hover:text-red-600">{{ $article->title }}</a>
                        </h2>
                        <p class="text-gray-500 text-sm">{{ Str::limit($article->excerpt, 100) }}</p>
                        <div class="flex justify-between items-center mt-3 text-xs text-gray-400">
                            <span>{{ $article->created_at->diffForHumans() }}</span>
                            <span>👁 {{ $article->views }} views</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    @else
        <p class="text-gray-500 text-center py-12">No articles found.</p>
    @endif

@endsection