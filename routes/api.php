<?php

use App\Http\Controllers\Order\GetOrderController;
use App\Http\Controllers\Order\PostOrderController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return User::all();
});

Route::post('order', PostOrderController::class);
Route::get('order/{id}', GetOrderController::class);
