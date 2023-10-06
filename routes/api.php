<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/menus', [MenuController::class, 'index']); 
Route::post('/menus', [MenuController::class, 'store']); 
// Route::get('/orders', [OrderController::class, 'addToOrderpg']);
Route::post('/orders', [OrderController::class, 'store']);

