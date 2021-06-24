<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [HomeController::class, 'index'])->name('home.index');
Route::post('/setcookies',[HomeController::class,'location'])->name('cookie.set');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/categories/{id}',[HomeController::class,'categories'])->name('categories');//Gets shop categories searched
Route::get('/services/{id}',[HomeController::class,'services'])->name('services');//Gets shop categories searched

Route::get('/shop/{id}/products',[HomeController::class,'shopproducts'])->name('products.shop');//Gets products in searched
Route::get('/service/{id}}',[HomeController::class,'service'])->name('service');//Gets products in searched
Route::get('/{shop}/add-to-cart/{id}',[HomeController::class,'addToCart'])->name('product.addtocart');
Route::get('/reduce/{id}',[HomeController::class,'reduce'])->name('reduce');
Route::get('/remove/{id}',[HomeController::class,'remove'])->name('remove');
Route::get('/cart',[HomeController::class,'cart'])->name('products.cart');
Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout');
Route::post('/placeorder',[HomeController::class,'placeorder'])->name('placeorder');
Route::get('/bookservice/{id}',[HomeController::class,'bookservice'])->name('bookservice');
Route::post('/bookservice/{id}',[HomeController::class,'confirmbooking'])->name('confirmbooking');

Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');