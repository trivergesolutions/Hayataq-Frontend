<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $categories = Category::with('categoryDescription')
            ->where('type', 'product')
            ->whereNull('parent_id')
            // ->where('is_active', 1)
            ->get();

        View::share('categories', $categories);
    }
}
