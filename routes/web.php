<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('login.index');

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/store', [CategoryController::class, 'store']);
    Route::put('/update/{index}', [CategoryController::class, 'update']);
    Route::delete('/destroy/{index}', [CategoryController::class, 'destroy']);
});

Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::put('/update/{index}', [ProductController::class, 'update']);
    Route::delete('/destroy/{index}', [ProductController::class, 'destroy']);
});

Route::prefix('sales')->group(function () {
    Route::get('/', [SalesController::class, 'index']);
    Route::post('/store', [SalesController::class, 'store']);
    Route::put('/update/{index}', [SalesController::class, 'update']);
    Route::delete('/destroy/{index}', [SalesController::class, 'destroy']);
});


