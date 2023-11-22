<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('auth')->as('auth.')->namespace('Auth')->group(function (Router $router) {
    $router->get('login', 'LoginController@showLoginForm')->name('login');
    $router->post('login', 'LoginController@login')->name('login');
});

Route::middleware('auth')->group(function (){
    Route::get('/', 'HomeController@index')->name('home');

    Route::prefix('user')->as('user.')->group(function () {
        Route::namespace('Auth')->group(function (Router $router){
            $router->get('/logout', 'LoginController@logout')->name('logout');
            $router->post('/logout', 'LoginController@logout')->name('logout');
        });

        Route::namespace('User')->group(function (Router $router){
            $router->resource('users', 'UsersController');
        });
    });

    Route::prefix('storehouse')->as('storehouse.')->group(function (){
        Route::namespace('Storehouse')->group(function (Router $router){
            $router->resource('storehouses', 'StorehousesController');

            $router->get('/orders/archive', 'OrdersController@archive')->name('orders.archive');
            $router->put('/orders/change_state/{order}', 'OrdersController@change_state')->name('orders.change_state');
            $router->resource('orders', 'OrdersController');

            $router->put('/loads/accept_order/{loadOrder}', 'LoadsController@accept_order')->name('loads.accept_order');
            $router->resource('loads', 'LoadsController');
        });
    });
});

// routes/web.php

Route::get('/khj', 'NewPageController@index')->name('khujand.index');

// routes/web.php

Route::get('/storehouse/loads/release/{id}', 'StorehouseController@release')->name('storehouse.loads.release');

// Добавляем новый маршрут для метода release
Route::delete('storehouse/loads/{load}/release', 'Storehouse\LoadsController@release')
    ->name('storehouse.loads.release');





