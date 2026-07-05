<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // Public homepage
    public function index()
    {
        $articles = Article::with('category', 'user')->latest()->paginate(9);
        $categories = Category::all();
        return view('articles.index', compact('articles', 'categories'));
    }

    // Single article page
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $article->increment('views');
        $related = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)->take(3)->get();
        return view('articles.show', compact('article', 'related'));
    }

    // Articles by category
    public function byCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $articles = Article::where('category_id', $category->id)->latest()->paginate(9);
        $categories = Category::all();
        return view('articles.index', compact('articles', 'categories', 'category'));
    }

    // Search
    public function search(Request $request)
    {
        $q = $request->get('q');
        $articles = Article::where('title', 'like', "%$q%")
            ->orWhere('excerpt', 'like', "%$q%")
            ->latest()->paginate(9);
        $categories = Category::all();
        return view('articles.index', compact('articles', 'categories', 'q'));
    }

    // REST API endpoint
    public function apiIndex()
    {
        $articles = Article::with('category')->latest()->take(20)->get();
        return response()->json([
            'status' => 'success',
            'count' => $articles->count(),
            'data' => $articles
        ]);
    }

    // Admin - create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }

    // Admin - store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        Article::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => auth()->id(),
            'image' => $request->image ?? null,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Article created!');
    }

    // Admin - edit form
    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    // Admin - update
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article->update([
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'image' => $request->image ?? $article->image,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Article updated!');
    }

    // Admin - delete
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Article deleted!');
    }
}