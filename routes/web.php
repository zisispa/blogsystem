<?php

use App\Http\Controllers\Blog\PostController as BlogPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/blog/posts/{post}', [BlogPostController::class, 'show'])->name('blog.show');

Route::get('/blog/categories/{category}', [BlogPostController::class, 'category'])->name('blog.category');

Route::get('/blog/tags/{tag}', [BlogPostController::class, 'tag'])->name('blog.tag');

Auth::routes();



Route::middleware('auth')->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categories', 'App\Http\Controllers\CategoryController');

    Route::resource('tags', 'App\Http\Controllers\TagController');

    Route::resource('posts', 'App\Http\Controllers\PostController');

    Route::get('trashed-posts', [PostController::class, 'trashed'])->name('trashed-posts.index');

    Route::put('restore-post/{post}', [PostController::class, 'restore'])->name('restore-posts');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('users/profile', [UsersController::class, 'edit'])->name('users.edit-profile');

    Route::put('users/profile', [UsersController::class, 'update'])->name('users.update-profile');

    Route::get('users', [UsersController::class, 'index'])->name('users.index');

    Route::post('users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
});
