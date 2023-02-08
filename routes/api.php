<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MusicianController;
use App\Http\Controllers\SongController;
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

Route::resource('musicians', MusicianController::class)->only(['index']);
Route::get('musicians/{id}', [MusicianController::class, 'show']);

Route::resource('genres', GenreController::class)->only(['index']);;
Route::get('genres/{id}', [GenreController::class, 'show']);

Route::resource('songs', SongController::class)->only(['index']);;
Route::get('songs/{id}', [SongController::class, 'show']);
Route::get('/songs/search/{name}', [SongController::class, 'search']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    // Route::put("presenters/{id}", [PresenterController::class, "update"]);
    Route::resource("musicians", MusicianController::class)->only(['store', 'update','destroy']);
    
    // Route::put("studios/{id}", [StudioController::class, "update"]);
    Route::resource("genres", GenreController::class)->only(['store', 'update','destroy']);

    // Route::put("tvshows/{id}", [TVShowController::class, "update"]);
    Route::resource("songs", SongController::class)->only(['store', 'update', 'show']);

    Route::post('/logout', [AuthController::class, 'logout']);
});