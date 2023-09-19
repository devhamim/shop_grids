<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use View;
use ShoppingCart;

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
        //
        View::composer(['website.includes.header'],function($view){
            $view->with('categories',Category::get());
        });
//        View::composer(['website.includes.header'],function($view){
//            $view->with('cart_products',ShoppingCart::all());
//        });
    }
}
