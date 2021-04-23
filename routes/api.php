<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\TweetController;
use App\Http\Controllers\Api\V1\FollowController;
use App\Http\Controllers\Api\V1\StatisticsController;
use App\Http\Controllers\Api\V1\Auth\LogoutController;

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

Route::prefix("v1")->group(function () {
    Route::post("login", [LoginController::class, "login"]);
    Route::post("register", [RegisterController::class, "register"]);
    Route::post("logout", [LogoutController::class, "logout"])->middleware("auth:sanctum");

    // This can go to auth:sanctum group in case access must be by authorized user
    Route::prefix("statistics")->group(function () {
        Route::get("", [StatisticsController::class, "index"]);
    });

    Route::middleware("auth:sanctum")->group(function () {
        Route::prefix("tweets")->group(function () {
            Route::post("", [TweetController::class, "store"]);
        });

        Route::prefix("follows")->group(function () {
            Route::post("", [FollowController::class, "store"]);
        });

    });
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});
