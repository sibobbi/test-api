<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::get('/category/all', [CategoryController::class, 'index']);
Route::get('/report', [ReportController::class, 'getReport']);

Route::prefix('categories')->as('.categories')->group(function () {
    Route::post('/sort/{category:id}', [App\Http\Controllers\CategoryController::class, 'sort'])->name('.category.sort');
    Route::post('/move/{category:id}', [App\Http\Controllers\CategoryController::class, 'move'])->name('.category.move');
});

Route::prefix('products')->as('.products')->group(function () {
    Route::post('/sort/{product:id}', [App\Http\Controllers\ProductController::class, 'sort'])->name('.product.sort');
    Route::post('/move/{product:id}', [App\Http\Controllers\ProductController::class, 'move'])->name('.product.move');
});

