<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

require __DIR__.'/auth.php';
// Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/categories', 'App\Http\Controllers\CategoryController@index')->name('categories');
Route::get('/categories/{slug}', 'App\Http\Controllers\CategoryController@detail')->name('categories-detail');
Route::get('/details/{id}', 'App\Http\Controllers\DetailController@index')->name('detail');
Route::post('/details/{id}', 'App\Http\Controllers\DetailController@add')->name('detail-add');

Route::post('/checkout', 'App\Http\Controllers\CheckoutController@process')->name('checkout');

Route::post('/checkout/callback', 'App\Http\Controllers\CheckoutController@callback')->name('midtrans-callback');

Route::get('/success', 'App\Http\Controllers\CartController@success')->name('success');
Route::get('/register/success', 'App\Http\Controllers\RegisterController@success')->name('register-success');
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');

Route::get('/register', 'App\Http\Controllers\RegisterController@index')->name('register');
Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login');

Route::group(['middleware' => ['auth']], function(){

    Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart');
    Route::post('/cart/{id}', 'App\Http\Controllers\CartController@delete')->name('cart-delete');
    Route::post('/checkout', 'App\Http\Controllers\CheckoutController@process')->name('checkout');
    Route::get('/dashboard', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
    Route::get('/dashboard/products', 'App\Http\Controllers\DashboardProductController@index')->name('dashboard-product');
    Route::get('/dashboard/products/create', 'App\Http\Controllers\DashboardProductController@create')->name('dashboard-product-create');
    Route::post('/dashboard/products', 'App\Http\Controllers\DashboardProductController@store')->name('dashboard-product-store');

    Route::get('/dashboard/products/{id}', 'App\Http\Controllers\DashboardProductController@details')->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}', 'App\Http\Controllers\DashboardProductController@update')->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', 'App\Http\Controllers\DashboardProductController@uploadGallery')->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'App\Http\Controllers\DashboardProductController@deleteGallery')->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', 'App\Http\Controllers\DashboardTransactionController@index')->name('dashboard-transactions');
    Route::get('/dashboard/transactions/{id}', 'App\Http\Controllers\DashboardTransactionController@details')->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/{id}', 'App\Http\Controllers\DashboardTransactionController@updateresi')->name('dashboard-transactions-update');
    
    Route::get('/dashboard/settings', 'App\Http\Controllers\DashboardSettingController@store')->name('dashboard-settings-store');
    Route::get('/dashboard/account', 'App\Http\Controllers\DashboardSettingController@account')->name('dashboard-settings-account');
    Route::post('/dashboard/account/{redirect}', 'App\Http\Controllers\DashboardSettingController@update')->name('dashboard-settings-redirect');

});
// ->middleware(['auth','admin'])
Route::prefix('admin')
    ->namespace('App\Http\Controllers\Admin')
    ->middleware(['auth','admin'])
    ->group(function(){
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery','ProductgalleryController');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');