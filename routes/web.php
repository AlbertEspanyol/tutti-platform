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


Route::get('/access', function (){
    return redirect('/access/login');
});

Route::get('/access/{mode}', [AccessController::class, 'show']);
Route::get('/access/register/{id}', [AccessController::class, 'showStep2']);

Route::get('/home', [HomeController::class, 'show']);
Route::get('/', function(){
    return redirect('/home');
});


Route::get('search/{type}/{search?}', [SearchController::class, 'show']);

Route::get('project/{id}', [ProjectPageController::class, 'show']);

Route::get('project/{id}/edit', [ProjectPageController::class, 'edit']);

Route::get('create', [ProjectPageController::class, 'create']);

