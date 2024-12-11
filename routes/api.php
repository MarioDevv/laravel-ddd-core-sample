<?php

use App\Http\Controllers\Order\CreateOrderController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/user', function () {
    return User::all();
});

Route::post('order', CreateOrderController::class);
