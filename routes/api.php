<?php

use App\Http\Controllers\API\AuthenticationController;
use App\Http\Controllers\API\CarController;
use App\Http\Controllers\API\ValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthenticationController::class, 'register']);
Route::post('login', [AuthenticationController::class, 'login']);

Route::resource('validation', ValidationController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::resource('cars', CarController::class);
    Route::post('logout', [AuthenticationController::class, 'logout']);
}); 