<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('products/trash', [ProductController::class, 'indextrash'])->name('products.trash');
    Route::patch('products/{product}/restore', [ProductController::class, 'restore'])->withTrashed()->name('products.restore');
    Route::delete('products/{product}/permanentdelete', [ProductController::class, 'forcedelete'])->withTrashed()->name('products.permanentdelete');
    Route::resource('products', ProductController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
