<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
    return view('index');
});


Route::get('/brands', 'App\Http\Controllers\BrandController@index');
Route::put('/brands/update', 'App\Http\Controllers\BrandController@update');
Route::post('/brands/store', 'App\Http\Controllers\BrandController@store');
Route::delete('/brands/delete/{id}', 'App\Http\Controllers\BrandController@destroy');
Route::get('/brands/search', 'App\Http\Controllers\BrandController@show');

Route::resource('products', ProductController::class);
