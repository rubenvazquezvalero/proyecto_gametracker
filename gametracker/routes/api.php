<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GameListController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PlatformController;
use App\Http\Controllers\GameModeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/list/add-game', [GameListController::class, 'addGame']);
});

Route::get('/game-by-slug/{slug}', [GameController::class, 'showBySlug']);
Route::get('/companies/name', [CompanyController::class, 'indexOnlyName']);
Route::get('/platforms/paginate', [PlatformController::class, 'indexPaginate']);
Route::get('/companies/paginate', [CompanyController::class, 'indexPaginate']);
Route::get('/modes/paginate', [GameModeController::class, 'indexPaginate']);
Route::post('/game/filtro', [GameController::class, 'filter']);

Route::apiResource('game', GameController::class);
Route::apiResource('list', GameListController::class);
Route::apiResource('companies', CompanyController::class);
Route::apiResource('platforms', PlatformController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('themes', ThemeController::class);
Route::apiResource('modes', GameModeController::class);
Route::apiResource('users', UserController::class);
