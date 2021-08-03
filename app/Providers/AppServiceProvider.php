<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Country;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Session::has('cart')){
            View::share('key', 'value');
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
        
            View::share('products',$cart->items);
            View::share('totalPrice',$cart->totalPrice);
        }

        $countries= Country::all();
        View::share('countries',$countries);
        $services=Category::where('type',0)->get();
        View::share('services',$services);
        $shops=Category::where('type',1)->get();
        View::share('shops',$shops);
        Paginator::useBootstrap();
    
    }
}
