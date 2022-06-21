<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\GenreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{id}', [UserController::class, 'show']);
Route::patch('/user/{id}', [UserController::class, 'update']);
Route::get('/films', [FilmController::class, 'index']);
Route::get('/films/{id}', [FilmController::class, 'show']);
Route::post('/films', [FilmController::class, 'store']);
Route::patch('/films/{id}', [FilmController::class, 'update']);
Route::get('/genres', [GenreController::class, 'index']);
Route::patch('/genres/{genre}', [GenreController::class, 'update']);
Route::get('/favorite', [FavoriteController::class, 'index']);
Route::post('films/{id}/favorite', [FavoriteController::class, 'store']);
Route::delete('films/{id}/favorite', [FavoriteController::class, 'destroy']);
Route::get('/films/{id}/comments', [CommentController::class, 'index']);
Route::post('/films/{id}/comments', [CommentController::class, 'store']);
Route::patch('/films/{id}/comments', [CommentController::class, 'update']);
Route::delete('/films/{id}/comments', [CommentController::class, 'destroy']);
Route::get('/films/{id}/similar', [FilmController::class, 'similar']);
Route::get('/promo', [FilmController::class, 'getPromo']);
Route::post('/promo/{id}', [FilmController::class, 'setPromo']);
