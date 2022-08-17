<?php

use App\Http\Controllers\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/user/{id}', [UserController::class, 'show']);
Route::patch('/user/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::get('/films/{film}', [FilmController::class, 'show'])->name('films.show');
Route::post('/films', [FilmController::class, 'store']);
Route::patch('/films/{id}', [FilmController::class, 'update']);
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::patch('/genres/{genre}', [GenreController::class, 'update'])->middleware('auth:sanctum')->name('genres.update');
Route::get('/favorite', [FavoriteController::class, 'index'])->middleware('auth:sanctum');
Route::post('films/{id}/favorite', [FavoriteController::class, 'store'])->middleware('auth:sanctum');
Route::delete('films/{id}/favorite', [FavoriteController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/films/{film}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::post('/films/{film}/comments/{comment?}', [CommentController::class, 'store'])
    ->middleware('auth:sanctum')->name('comments.store');
Route::patch('/films/{id}/comments', [CommentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth:sanctum', 'can:moderator')->name('comments.destroy');
Route::get('/films/{id}/similar', [FilmController::class, 'similar']);
Route::get('/promo', [FilmController::class, 'getPromo']);
Route::post('/promo/{id}', [FilmController::class, 'setPromo']);
