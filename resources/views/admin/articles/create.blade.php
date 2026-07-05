@extends('layouts.app')
@section('title', 'New Article')
@section('content')

<div class="max-w-3xl mx-auto bg-white rounded-xl shadow p-8">
    <h1 class="text-2xl font-bold mb-6">New Article</h1>

    <form method="POST" action="{{ route('admin.articles.store') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input name="title" type="text" value="{{ old('title') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                required>
            @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
            <select name="category_id"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Excerpt</label>
            <textarea name="excerpt" rows="2"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                required>{{ old('excerpt') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Body</label>
            <textarea name="body" rows="10"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400"
                required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Image URL (optional)</label>
            <input name="image" type="text" value="{{ old('image') }}"
                class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-red-400">
        </div>

        <div class="flex gap-3">
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">
                Publish Article
            </button>
            <a href="{{ route('admin.dashboard') }}"
                class="px-6 py-2 rounded border hover:bg-gray-50">Cancel</a>
        </div>
    </form>
</div>

@endsection