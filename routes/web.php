<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('posts.create');
    Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('posts.store');
    Route::get('/post/{post}/show', 'App\Http\Controllers\PostController@show')->name('posts.show');

    Route::post('/comment/create', 'App\Http\Controllers\CommentController@store')->name('comments.create');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
