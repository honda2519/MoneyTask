<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
        Paginator::useBootstrapFive();    
        Paginator::useBootstrapFour();
        if( Schema::hasTable('categores')) {
            View::share('categores', $this->shareCategories());
        }
    }
//zanpが壊れるとここが重要
    private function shareCategories() {
        return Category::all();
    }
}
