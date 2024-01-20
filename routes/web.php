<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/stocks', [StockController::class, 'index'])->name('stock.index');
Route::get('/stocks/create', [StockController::class, 'create'])->name('stock.create');
Route::post('/stocks', [StockController::class, 'store'])->name('stock.store');
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
Route::post('/orders', [OrderController::class, 'store'])->name('order.place');
