<?php

use App\Http\Controllers\Order\CreateOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('order', CreateOrderController::class)->name('order.create');
