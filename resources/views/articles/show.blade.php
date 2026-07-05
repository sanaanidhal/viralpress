@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-3xl mx-auto">

    <!-- Category & title -->
    <span class="text-red-600 font-semibold text-sm uppercase">
        {{ $article->category->name }}
    </span>
    <h1 class="text-3xl font-bold mt-2 mb-4">{{ $article->title }}</h1>

    <div class="flex gap-4 text-sm text-gray-400 mb-6">
        <span>By {{ $article->user->name }}</span>
        <span>{{ $article->created_at->format('M d, Y') }}</span>
        <span>👁 {{ $article->views }} views</span>
    </div>

    @if($article->image)
        <img src="{{ $article->image }}" class="w-full rounded-xl mb-6 max-h-96 object-cover">
    @endif

    <!-- Body -->
    <div class="prose max-w-none text-gray-700 leading-relaxed">
        {!! nl2br(e($article->body)) !!}
    </div>

    <!-- Related articles -->
    @if($related->count())
        <div class="mt-12">
            <h3 class="text-xl font-bold mb-4">Related Articles</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($related as $rel)
                    <a href="{{ route('article.show', $rel->slug) }}"
                        class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                        <span class="text-xs text-red-600">{{ $rel->category->name }}</span>
                        <p class="font-semibold text-sm mt-1">{{ $rel->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection