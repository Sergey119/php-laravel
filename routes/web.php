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

Route::get('posts/', 'App\Http\Controllers\PostController@index')->name('posts.index');
Route::get('posts/create', 'App\Http\Controllers\PostController@create')->name('posts.create');
Route::get('posts/show/{id}', 'App\Http\Controllers\PostController@show')->name('posts.show');
Route::get('posts/edit/{id}', 'App\Http\Controllers\PostController@edit')->name('posts.edit');
Route::post('posts/', 'App\Http\Controllers\PostController@store')->name('posts.store');
Route::patch('posts/show/{id}', 'App\Http\Controllers\PostController@update')->name('posts.update');
Route::delete('posts/{id}', 'App\Http\Controllers\PostController@destroy')->name('posts.destroy');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
