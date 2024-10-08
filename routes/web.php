<?php

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

//Route::get('/', function () {
//    return view('test');
//});

Route::get('/', 'App\Http\Controllers\PostController@index');

//Ресурсный маршрут не работает. Надо отлаживать
//Route::resource('/post', '\App\Http\Controllers\PostController');

Route::get('post/', 'App\Http\Controllers\PostController@index')->name('post.index');
Route::get('post/create', 'App\Http\Controllers\PostController@create')->name('post.create');
Route::get('post/show/{id}', 'App\Http\Controllers\PostController@show')->name('post.show');
Route::get('post/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('post.edit');
Route::post('post/', 'App\Http\Controllers\PostController@store')->name('post.store');
Route::patch('post/show/{id}', 'App\Http\Controllers\PostController@update')->name('post.update');
Route::delete('post/{id}', 'App\Http\Controllers\PostController@destroy')->name('post.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
