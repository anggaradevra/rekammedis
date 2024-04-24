<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('partial.main');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
