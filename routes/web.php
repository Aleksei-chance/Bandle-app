<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\LoginCheck;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', [AuthController::class, 'AuthPage'])->middleware(LoginCheck::class);
Route::get('/MyBandles', [UserController::class, 'MyBandles'])->middleware(AuthCheck::class);;
Route::post('/registration', [AuthController::class, 'registration']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/api', [ApiController::class, 'Api']);


//->middleware(Authenticate::class)