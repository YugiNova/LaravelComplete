<?php

namespace App\Providers;

use App\Models\ProductCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $arrayViewCategory = [
            'client.pages.home',
            'client.pages.shop_details',
            'client.pages.shoping_cart',
            'client.pages.checkout'
        ];
        View::composer($arrayViewCategory, function ($view) {
            $categories = ProductCategory::latest()->take(8)->get()->filter(function($categories){
                return $categories->products->count();
            });
            $view->with('categories',$categories);
        });
    }
}
