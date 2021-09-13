<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectPageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
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


Route::get('/access', [AccessController::class, 'show']);

Route::get('/access/register', function () {
    return view('registerStep2');
});

Route::get('/login', [LoginController::class, 'showLogin']);

Route::get('/register', [RegisterController::class, 'showRegister']);

Route::get('/home', [HomeController::class, 'show']);
Route::get('/', [HomeController::class, 'show']);

Route::get('search/{type}/{search?}', [SearchController::class, 'show']);

Route::get('project/{id}', [ProjectPageController::class, 'show']);

Route::get('project/{id}/edit', [ProjectPageController::class, 'edit']);

Route::get('create', [ProjectPageController::class, 'create']);

