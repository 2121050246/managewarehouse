<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NumberBarController;
use App\Http\Controllers\Api\PercentController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//! number
Route::resource('number', NumberBarController::class);

Route::get('/number/{year}/{month}', [NumberBarController::class, 'showByYearMonth']);




