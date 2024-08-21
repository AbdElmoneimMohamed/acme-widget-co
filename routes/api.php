<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;

Route::post('/basket/add', [BasketController::class, 'addProduct']);
Route::get('/basket/total', [BasketController::class, 'getTotal']);
