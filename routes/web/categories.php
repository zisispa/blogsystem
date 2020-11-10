<?php

use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');

    Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');

    Route::get('/categories/{categorie}/edit', [CategorieController::class, 'edit'])->name('categories.edit');

    Route::delete('/categories/{categorie}/destroy', [CategorieController::class, 'destroy'])->name('categories.destroy');

    Route::put('/categories/{categorie}/update', [CategorieController::class, 'update'])->name('categories.update');
});
