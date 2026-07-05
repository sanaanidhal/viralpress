@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Stats -->
    <div class="grid grid-cols-3 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-3xl font-bold text-red-600">{{ $totalArticles }}</p>
            <p class="text-gray-500 text-sm mt-1">Total Articles</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-3xl font-bold text-red-600">{{ $totalViews }}</p>
            <p class="text-gray-500 text-sm mt-1">Total Views</p>
        </div>
        <div class="bg-white rounded-xl shadow p-6 text-center">
            <p class="text-3xl font-bold text-red-600">{{ $totalCategories }}</p>
            <p class="text-gray-500 text-sm mt-1">Categories</p>
        </div>
    </div>

    <div class="grid grid-cols-3 gap-6">

        <!-- Articles table -->
        <div class="col-span-2 bg-white rounded-xl shadow p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold text-lg">Articles</h2>
                <a href="{{ route('admin.articles.create') }}"
                    class="bg-red-600 text-white px-4 py-2 rounded text-sm hover:bg-red-700">
                    + New Article
                </a>
            </div>
            <table class="w-full text-sm">
                <thead class="text-left text-gray-400 border-b">
                    <tr>
                        <th class="pb-2">Title</th>
                        <th class="pb-2">Category</th>
                        <th class="pb-2">Views</th>
                        <th class="pb-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2">{{ Str::limit($article->title, 40) }}</td>
                        <td class="py-2">{{ $article->category->name }}</td>
                        <td class="py-2">{{ $article->views }}</td>
                        <td class="py-2 flex gap-2">
                            <a href="{{ route('admin.articles.edit', $article) }}"
                                class="text-blue-500 hover:underline">Edit</a>
                            <form method="POST"
                                action="{{ route('admin.articles.destroy', $article) }}"
                                onsubmit="return confirm('Delete this article?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">{{ $articles->links() }}</div>
        </div>

        <!-- Categories -->
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="font-bold text-lg mb-4">Categories</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="flex gap-2 mb-4">
                @csrf
                <input name="name" type="text" placeholder="New category"
                    class="border rounded px-3 py-1 text-sm flex-1 focus:outline-none">
                <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Add</button>
            </form>
            <ul class="space-y-2">
                @foreach($categories as $cat)
                <li class="flex justify-between items-center text-sm">
                    <span>{{ $cat->name }}</span>
                    <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 text-xs">✕</button>
                    </form>
                </li>
                @endforeach
            </ul>
        </div>

    </div>

@endsection