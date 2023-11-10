<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/menus', [MenuController::class, 'index']); 
Route::get('/menu/{id}', [MenuController::class, 'show']);
Route::post('/menu', [MenuController::class, 'store']); 
Route::post('/orders', [OrderController::class, 'store']);

Route::put('/menu/{id}', [MenuController::class, 'update']);
Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

// routes/api.php
