<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {

    Route::get('/admin', [AdminsController::class, 'index'])->name('admin.index');
});
