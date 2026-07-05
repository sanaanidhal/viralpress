<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@viralpress.com',
            'password' => bcrypt('password'),
        ]);

        // Create categories
        $categories = ['Technology', 'Entertainment', 'Sports', 'Science', 'Travel'];
        foreach ($categories as $name) {
            Category::create(['name' => $name, 'slug' => Str::slug($name)]);
        }

        // Create sample articles
        $titles = [
            'Top 10 AI Tools Taking Over the Internet',
            'Why Everyone is Talking About This New App',
            'Scientists Discover Breakthrough in Energy Storage',
            'The Most Viral Videos of the Year',
            'How This Startup Made Millions in 6 Months',
            'The Future of Electric Cars is Here',
            'This Travel Destination is Blowing Up on Social Media',
            'The Sport That is Taking the World by Storm',
            'New Study Reveals Shocking Health Facts',
            'Inside the World of Viral Content Creation',
        ];

        $categories = Category::all();

        foreach ($titles as $title) {
            Article::create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'excerpt' => 'This is a short excerpt that summarizes the article content in a few sentences. Readers can get a quick overview before clicking to read more.',
                'body' => "This is the full body of the article.\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.\n\nUt enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n\nDuis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.",
                'views' => rand(100, 9999),
            ]);
        }
    }
}