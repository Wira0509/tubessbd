<?php

namespace App\Providers;

use App\Models\ItineraryCategory;
use Illuminate\Support\ServiceProvider;
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
        View::composer('includes.navbar', function ($view) {
            $categories = ItineraryCategory::with('children.children.children')->whereNull('parent_id')->get();
            $view->with('categories', $categories);
        });
    }

    
}
