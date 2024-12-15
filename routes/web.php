<?php

use App\Http\Controllers\Order\PostOrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('order', PostOrderController::class)->name('order.create');
