<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

/*
Route::get('/register', function () {
    return view('register');
});
*/

Route::get('/access', [AccessController::class, 'index']);

Route::get('/login', [LoginController::class, 'showLogin']);

Route::get('/register', [RegisterController::class, 'showRegister']);

Route::get('/home', [HomeController::class, 'index']);

