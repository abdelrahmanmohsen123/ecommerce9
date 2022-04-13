<?php


use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CitiesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ModelsController;
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
    return view('welcome');
});


Route::group(['prefix'=>'admin'],function(){
    Route::get('/',DashboardController::class)->name('dashboard');
    //brands
    Route::group(['prefix'=>'brands','controller'=>BrandsController::class,'as'=>'brands.'],function(){
        Route::get('/','index')->name('index');
        Route::get('create','create')->name('create');
        Route::get('{brand}/edit','edit')->name('edit');
        Route::post('store','store')->name('store');
        Route::put('{brand}/update','update')->name('update');
        Route::delete('{brand}/destroy','destroy')->name('destroy');
    });

    //moedls
    Route::resource('models',ModelsController::class);

    //cities
    Route::group(['prefix'=>'cities','controller'=>CitiesController::class,'as'=>'cities.'],function(){
        Route::get('/','index')->name('index');
        Route::get('create','create')->name('create');
        Route::get('{id}/edit','edit')->name('edit');
        Route::post('store','store')->name('store');
        Route::put('{id}/update','update')->name('update');
        Route::delete('{id}/destroy','destroy')->name('destroy');




    });


});
