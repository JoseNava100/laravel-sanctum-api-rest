<?php

use App\Http\Controllers\GeneratePasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeneratePasswordController::class, 'password']);
