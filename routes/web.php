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
    Route::get('/users/index', 'App\Http\Controllers\UserController@index')->name('users.index');
    Route::get('/users/{user}/edit', 'App\Http\Controllers\UserController@edit')->name('users.edit');
    Route::put('/users/{user}/update', 'App\Http\Controllers\UserController@update')->name('users.update');

    Route::get('/posts/create', 'App\Http\Controllers\PostController@create')->name('posts.create');
    Route::post('/post/store', 'App\Http\Controllers\PostController@store')->name('posts.store');
    Route::get('/post/{post}/show', 'App\Http\Controllers\PostController@show')->name('posts.show');
    Route::get('/post/{post}/comments', 'App\Http\Controllers\PostController@fetchComments')->name('posts.comments');

    Route::get('/admin/index', 'App\Http\Controllers\RoleController@adminIndex')->name('admin.index');

    Route::get('/roles/show', 'App\Http\Controllers\RoleController@index')->name('roles.index');

    Route::post('/comment/create', 'App\Http\Controllers\CommentController@store')->name('comments.create');
    Route::post('/comment/reply', 'App\Http\Controllers\CommentController@replyStore')->name('comments.replies');
    Route::put('/comments/{comment}/edit', 'App\Http\Controllers\CommentController@update')->name('comments.edit');

});

Route::middleware(['auth', 'role:Administrator'])->group(function () {
    Route::delete('/post/{post}/delete', 'App\Http\Controllers\PostController@destroy')->name('posts.delete');
    Route::post('/roles/{role}/attach', 'App\Http\Controllers\RoleController@attach')->name('roles.attach');
    Route::post('/roles/{role}/detach', 'App\Http\Controllers\RoleController@detach')->name('roles.detach');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
