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
Route::get('/companies/name', 'CompanyController@indexOnlyName');
Route::get('/platforms/paginate', 'PlatformController@indexPaginate');
Route::get('/companies/paginate', 'CompanyController@indexPaginate');
Route::get('/modes/paginate', 'GameModeController@indexPaginate');

Route::apiResource('game', GameController::class);
Route::apiResource('list', GameListController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('platforms', PlatformController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('themes', ThemeController::class);
Route::apiResource('modes', GameModeController::class);
Route::apiResource('users', UserController::class);