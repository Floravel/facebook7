<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use \App\Http\Controllers\UserPostController;
use \App\Http\Controllers\AuthUserController;

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

Route::middleware('auth:api')->group(function () {

    Route::get('/auth-user', [AuthUserController::class, 'show']);

    Route::apiResources([
        '/posts' => PostController::class,
        '/users' => UserController::class,
        '/users/{user}/posts' => UserPostController::class
    ]);
});



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
