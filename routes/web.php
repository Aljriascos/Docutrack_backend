<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function (){
    return "Hello world";
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
