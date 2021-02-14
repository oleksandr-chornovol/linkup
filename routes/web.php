<?php

use Illuminate\Support\Facades\Route;
use \App\Models\Category;

/*
|---------------------------------------------------------w-----------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $firstCategory = Category::first();
    return redirect("/category/{$firstCategory->rozetka_id}");
});

View::composer('layouts.app', function ($view) {
    $view->with('categories', Category::all());
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::put('/product/{id}', '\App\Http\Controllers\ProductController@update');
    Route::delete('/product/{id}', '\App\Http\Controllers\ProductController@destroy');
});

Route::resource('category', '\App\Http\Controllers\CategoryController');
Route::resource('product', '\App\Http\Controllers\ProductController');
