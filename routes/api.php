<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::get('/posts', [App\Http\Controllers\API\PostsController::class, 'index']);
    Route::get('/posts/{id}', [App\Http\Controllers\API\PostsController::class, 'show']);
    Route::post('/create-posts', [App\Http\Controllers\API\PostsController::class, 'store']);
    Route::post('/update-posts', [App\Http\Controllers\API\PostsController::class, 'update']);
    Route::post('/delete-posts', [App\Http\Controllers\API\PostsController::class, 'delete']);

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/users', [App\Http\Controllers\API\UsersController::class, 'index']);
        Route::get('/users/{id}', [App\Http\Controllers\API\UsersController::class, 'show']);
        Route::post('/create-users', [App\Http\Controllers\API\UsersController::class, 'store']);
        Route::post('/update-users', [App\Http\Controllers\API\UsersController::class, 'update']);
        Route::post('/delete-users', [App\Http\Controllers\API\UsersController::class, 'delete']);
    });
});