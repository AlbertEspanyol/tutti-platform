<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projects/big', [ProjectController::class, 'biggestId']);
Route::get('projects', [ProjectController::class, 'index']);
Route::prefix('/project')->group( function() {
    Route::post('/store', [ProjectController::class, 'store']);
    Route::put('/{id}', [ProjectController::class, 'update']);
    Route::delete('/{id}', [ProjectController::class, 'destroy']);
});

Route::get('users', [UserController::class, 'index']);
Route::prefix('/user')->group( function() {
    Route::post('/store', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::get('/files', [FileController::class, 'get']);
Route::prefix('/file')->group( function() {
    Route::post('/upload/{id}/{name}', [FileController::class, 'upload']);
    Route::delete('/{path}', [FileController::class, 'destroy']);
});

