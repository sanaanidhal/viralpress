@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')

<div class="bg-gray-50 min-h-screen">

    <!-- Admin header -->
    <div class="hero-gradient text-white py-10">
        <div class="max-w-7xl mx-auto px-4">
            <p class="text-xs uppercase tracking-widest text-gray-400 mb-2">Welcome back</p>
            <h1 class="font-display text-4xl font-black">Command Center</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-10">

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 -mt-8">
            <div class="bg-white rounded-2xl shadow-sm p-8 card-hover">
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-3">Total Articles</p>
                <p class="font-display text-5xl font-black text-black">{{ $totalArticles }}</p>
                <div class="mt-4 h-1 bg-black rounded-full w-12"></div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-8 card-hover">
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-3">Total Views</p>
                <p class="font-display text-5xl font-black text-red-600">{{ number_format($totalViews) }}</p>
                <div class="mt-4 h-1 bg-red-600 rounded-full w-12"></div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm p-8 card-hover">
                <p class="text-xs uppercase tracking-widest text-gray-400 mb-3">Categories</p>
                <p class="font-display text-5xl font-black text-black">{{ $totalCategories }}</p>
                <div class="mt-4 h-1 bg-black rounded-full w-12"></div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-8">

            <!-- Articles table -->
            <div class="col-span-2 bg-white rounded-2xl shadow-sm p-8">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-display text-2xl font-bold">Articles</h2>
                    <a href="{{ route('admin.articles.create') }}"
                        class="bg-black text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-gray-800 transition">
                        + New Article
                    </a>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-xs uppercase tracking-widest text-gray-400 border-b border-gray-100">
                            <th class="pb-4 font-medium">Title</th>
                            <th class="pb-4 font-medium">Category</th>
                            <th class="pb-4 font-medium">Views</th>
                            <th class="pb-4 font-medium">Date</th>
                            <th class="pb-4 font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($articles as $article)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 pr-4">
                                <p class="font-medium text-sm line-clamp-1">{{ $article->title }}</p>
                            </td>
                            <td class="py-4 pr-4">
                                <span class="bg-gray-100 text-gray-600 text-xs font-medium px-3 py-1 rounded-full">
                                    {{ $article->category->name }}
                                </span>
                            </td>
                            <td class="py-4 pr-4 text-sm text-gray-500">
                                {{ number_format($article->views) }}
                            </td>
                            <td class="py-4 pr-4 text-xs text-gray-400">
                                {{ $article->created_at->format('M d') }}
                            </td>
                            <td class="py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('article.show', $article->slug) }}"
                                        target="_blank"
                                        class="text-xs text-gray-400 hover:text-black transition font-medium">
                                        View
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                        class="text-xs text-blue-500 hover:text-blue-700 transition font-medium">
                                        Edit
                                    </a>
                                    <form method="POST"
                                        action="{{ route('admin.articles.destroy', $article) }}"
                                        onsubmit="return confirm('Delete this article?')">
                                        @csrf @method('DELETE')
                                        <button class="text-xs text-red-400 hover:text-red-600 transition font-medium">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-6">{{ $articles->links() }}</div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">

                <!-- Categories -->
                <div class="bg-white rounded-2xl shadow-sm p-8">
                    <h2 class="font-display text-xl font-bold mb-6">Categories</h2>
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="mb-6">
                        @csrf
                        <div class="flex gap-2">
                            <input name="name" type="text" placeholder="New category name"
                                class="flex-1 border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-black transition">
                            <button class="bg-black text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-gray-800 transition">
                                Add
                            </button>
                        </div>
                    </form>
                    <ul class="space-y-3">
                        @foreach($categories as $cat)
                        <li class="flex justify-between items-center py-2 border-b border-gray-50">
                            <span class="text-sm font-medium">{{ $cat->name }}</span>
                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}">
                                @csrf @method('DELETE')
                                <button class="text-gray-300 hover:text-red-500 transition text-lg leading-none">×</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Quick links -->
                <div class="bg-black text-white rounded-2xl p-8">
                    <h2 class="font-display text-xl font-bold mb-6">Quick Links</h2>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('home') }}" target="_blank"
                                class="text-gray-400 hover:text-white transition flex items-center gap-2">
                                → View Site
                            </a>
                        </li>
                        <li>
                            <a href="/api/articles" target="_blank"
                                class="text-gray-400 hover:text-white transition flex items-center gap-2">
                                → REST API
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.articles.create') }}"
                                class="text-gray-400 hover:text-white transition flex items-center gap-2">
                                → New Article
                            </a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection