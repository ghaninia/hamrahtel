<?php

use Illuminate\Support\Facades\Route;
use Src\Auth\Presentation\HTTP\Controllers\AuthController;

Route::prefix("api")
    ->name("api.")
    ->namespace('Src\\Auth\\Presentation\\HTTP\\Controllers')
    ->group(function () {
        Route::post("login", [AuthController::class, "login"])->name("login")->middleware( 'guest');
        Route::post("logout", [AuthController::class, "logout"])->name("logout")->middleware('auth');
        Route::get("me", [AuthController::class, "me"])->name("me")->middleware('auth');
    });
