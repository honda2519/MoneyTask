<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

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
        if (\App::enviroment(['production'])){
            \URL::forceScheme('https');
        }
    }
//zanpが壊れるとここが重要
    private function shareCategories() {
        return Category::all();
    }
}
