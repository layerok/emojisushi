<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Cart;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('site.partials.nav', function ($view) {
            $view->with('categories', Category::where([
                ['id', '>' , 1],
                ['hidden', '=' , 0],
            ])->get());
        });
        View::composer('site.partials.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
    }
}
