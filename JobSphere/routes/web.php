<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pages', [HomeController::class, 'index']);

Route::get('/jobs', [JobController::class, 'index']);
