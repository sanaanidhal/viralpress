# ⚡ ViralPress — Laravel Publishing Platform

A full-stack viral content publishing platform built with Laravel, MySQL, and Tailwind CSS.

## 🚀 Features
- Public article feed with category filtering, search, and pagination
- Single article pages with view counter and related articles
- Multi-role authentication (Admin / Reader) via Laravel Breeze
- Admin dashboard with KPI stats (total articles, views, categories)
- Full CRUD for articles and categories
- REST API endpoint — `GET /api/articles` returns JSON
- Responsive UI with Tailwind CSS
- Auto-generated slugs, performance-optimized queries with eager loading

## 🛠 Tech Stack
- **Backend:** PHP 8, Laravel 11, MySQL
- **Frontend:** Blade templates, Tailwind CSS, JavaScript
- **Auth:** Laravel Breeze
- **API:** REST JSON endpoint
- **Tools:** Git, Composer, NPM, Vite

## ⚙️ Installation
```bash
git clone https://github.com/sanaanidhal/viralpress.git
cd viralpress
composer install
npm install
cp .env.example .env
php artisan key:generate
# Configure DB in .env
php artisan migrate --seed
php artisan serve
npm run dev
```

## 🔑 Demo Credentials
- **Email:** admin@viralpress.com
- **Password:** password

## 📡 API