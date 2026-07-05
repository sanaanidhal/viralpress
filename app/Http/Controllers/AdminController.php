<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AdminController extends Controller
{
    public function index()
    {
        $articles = Article::with('category', 'user')->latest()->paginate(10);
        $categories = Category::all();
        $totalArticles = Article::count();
        $totalViews = Article::sum('views');
        $totalCategories = Category::count();
        return view('admin.dashboard', compact(
            'articles', 'categories',
            'totalArticles', 'totalViews', 'totalCategories'
        ));
    }

    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|max:255']);
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return back()->with('success', 'Category created!');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return back()->with('success', 'Category deleted!');
    }
}