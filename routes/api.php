<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
use App\Http\Controllers\Api\V1\TweetController;

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

    Route::middleware("auth:sanctum")->group(function () {
        Route::prefix("tweets")->group(function () {
            Route::post("", [TweetController::class, "store"]);
        });
    });

});
