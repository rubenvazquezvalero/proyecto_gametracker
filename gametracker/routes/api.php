<?php

use App\Http\Controllers\AuthController;
//use App\Http\Controllers\GameController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout',[AuthController::class,'logout']);
    Route::post('/list/add-game', 'GameListController@addGame');
});

Route::get('/game-by-slug/{slug}', 'GameController@showBySlug');

Route::apiResource('game', GameController::class);
Route::apiResource('genre', GenreController::class);
Route::apiResource('list', GameListController::class);