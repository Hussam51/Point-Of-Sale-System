<?php

use App\Http\Controllers\Dashboard\CategoryController;

use App\Http\Controllers\Dashboard\DashboardController ;

use App\Http\Controllers\Dashboard\OrderController  ;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Symfony\Component\Translation\laravelLocalizationTranslator;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth']
    ],
    function () {

        Route::group(
            ['prefix' => 'dashboard'],
            function () {
                Route::get('/index', [DashboardController::class, 'index'])->name('dashboard.welcome');
                Route::resource('users','UserController');
                Route::resource('roles', 'RoleController');
                Route::resource('categories', 'CategoryController');
                Route::resource('products','ProductController');
                Route::resource('orders','OrderController')->except('show');
                Route::get('orders/{order}/products','OrderController@products')->name('order.products');
                //client routes
                Route::resource('clients','ClientController');

                //
                Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
            }
        );
    }
);
