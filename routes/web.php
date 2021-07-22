<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Auth\RegisterController;

// User Routes
Route::get('/',  [HomeController::class, 'index'])->name('home.index');
Route::post('/setcookies',[HomeController::class,'location'])->name('cookie.set');// Set location cookie

Route::get('/login', [RegisterController::class, 'signin'])->name('signin');
Route::post('/login', [RegisterController::class, 'login'])->name('login');
Route::get('account/signup', [RegisterController::class, 'signup'])->name('signup');
Route::get('account/signup/partner', [RegisterController::class, 'partnersignup'])->name('partner.signup');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
//Forgot password
Route::get('account/forgot/password', [RegisterController::class, 'forgotpassword'])->name('password.forgot');
Route::post('home/forgot/password', [RegisterController::class,'sendresetemail'])->middleware('guest')->name('password.email');
Route::get('account/reset-password/{token}',[RegisterController::class,'resetpassword'])->middleware('guest')->name('password.reset');
Route::post('reset-password', [RegisterController::class,'updatepassword'])->middleware('guest')->name('password.update');
//Facebook socialite 
Route::get('/redirect/facebook',[RegisterController::class,'redirect'])->name('login.facebook');
Route::get('/callback/facebook', [RegisterController::class,'callback']);
//Google socialite 
Route::get('/redirect/google',[RegisterController::class,'googleredirect'])->name('login.google');
Route::get('/callback/google', [RegisterController::class,'googlecallback']);

Route::get('home/home', [HomeController::class, 'index'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('about', [HomeController::class, 'about'])->name('about');

Route::get('/product-categories/{id}',[HomeController::class,'categories'])->name('categories');//Gets shop categories searched
Route::get('/services/{id}',[HomeController::class,'services'])->name('services');//Gets shop categories searched
Route::get('search',[HomeController::class,'search'])->name('search');

Route::get('/shop/{id}/products',[HomeController::class,'shopproducts'])->name('products.shop');//Gets products in searched
Route::get('/service/{id}}',[HomeController::class,'service'])->name('service');//Gets products in searched
Route::get('/{shop}/add-to-cart/{id}',[HomeController::class,'addToCart'])->name('product.addtocart');
Route::get('/reduce/{id}',[HomeController::class,'reduce'])->name('reduce');
Route::get('/remove/{id}',[HomeController::class,'remove'])->name('remove');
Route::get('/cart',[HomeController::class,'cart'])->name('products.cart');
Route::get('/checkout',[HomeController::class,'checkout'])->name('checkout')->middleware('auth');
Route::post('/confirm',[HomeController::class,'confirm'])->name('confirm')->middleware('auth');
Route::post('/placeorder',[HomeController::class,'placeorder'])->name('placeorder');
Route::get('/bookservice/{id}',[HomeController::class,'bookservice'])->name('bookservice');
Route::post('/bookservice/{id}',[HomeController::class,'confirmbooking'])->name('confirmbooking');

Route::get('/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
Route::get('/myorders',[DashboardController::class,'dashboard'])->name('myorders');
Route::get('/mybookings',[DashboardController::class,'mybookings'])->name('mybookings');
Route::get('/myaddress',[DashboardController::class,'myaddress'])->name('myaddress');
Route::get('/myaccount',[DashboardController::class,'myaccount'])->name('myaccount');
Route::get('/change-password',[DashboardController::class,'changepassword'])->name('changepassword');

Route::get('cancel/{id}',[DashboardController::class,'cancel'])->name('cancel');
Route::get('booking/cancel/{id}',[DashboardController::class,'cancelbooking'])->name('booking.cancel');
Route::get('booking/reschedule/{id}',[DashboardController::class,'reschedulebooking'])->name('booking.reschedule');
Route::post('booking/reschedule/{id}',[DashboardController::class,'rescheduled'])->name('rescheduled');

Route::post('profile',[DashboardController::class,'profile'])->name('profile.update');
Route::post('password',[DashboardController::class,'password'])->name('password.change');

Route::get('/profile/create',[PartnerController::class,'create'])->name('partner.create');
Route::post('/profile/store',[PartnerController::class,'store'])->name('partner.store');

Route::group(['middleware'=>'profile'],function(){
    // Partner Routes
    Route::get('/dashboard/partner',[PartnerController::class,'index'])->name('partner.dashboard');
    Route::get('/profile',[PartnerController::class,'profile'])->name('dashboard.profile');
    Route::post('/profile/update',[PartnerController::class,'update'])->name('partner.update');
    Route::post('/business/profile-update',[PartnerController::class,'businessupdate'])->name('business.update');

    Route::get('/payments/create',[PartnerController::class,'payments'])->name('payments.create');
    Route::post('/payments/store',[PartnerController::class,'paymentsstore'])->name('payments.store');
    Route::post('/payments/update',[PartnerController::class,'paymentsupdate'])->name('payments.update');

    Route::resource('/categories',CategoryController::class);
    Route::resource('/products',ProductController::class);

    Route::get('/orders',[OrderController::class,'index'])->name('orders.index');
    Route::get('/show/{id}',[OrderController::class,'show'])->name('order.show');
    Route::get('/accept/{id}',[OrderController::class,'accept'])->name('order.accept');
    Route::get('/process/{id}',[OrderController::class,'process'])->name('order.process');
    Route::get('/boda/{id}',[OrderController::class,'boda'])->name('order.boda');
    Route::post('/deliver',[OrderController::class,'deliver'])->name('order.deliver');
    Route::get('/paid/{id}',[OrderController::class,'paid'])->name('order.paid');
    Route::get('/partner/cancel/{id}',[OrderController::class,'cancel'])->name('order.cancel');

    Route::get('/bookings',[BookingController::class,'index'])->name('bookings.index');
    Route::get('/view/{id}',[BookingController::class,'show'])->name('booking.show');
    Route::get('/accept/{id}/booking',[BookingController::class,'accept'])->name('booking.accept');
    Route::get('/completed/{id}',[BookingController::class,'completed'])->name('booking.completed');


    Route::get('/notifications',[NotificationController::class,'index'])->name('notifications.index');
    Route::get('/notifications/{id}',[NotificationController::class,'show'])->name('notifications.show');
    Route::get('/notifications/{id}/delete',[NotificationController::class,'delete'])->name('notifications.delete');
    Route::get('/customer/notifications',[NotificationController::class,'customerindex'])->name('customer.notifications.index');
    Route::get('/notifications/{id}/delete/customer',[NotificationController::class,'customerdelete'])->name('customer.notifications.delete');
});

