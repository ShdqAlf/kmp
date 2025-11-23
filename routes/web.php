<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboardController;

Route::get('/', [dashboardController::class, 'dashboard'])->name('dashboard');
