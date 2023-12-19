<?php

use Illuminate\Support\Facades\Route;
use Src\Agenda\Message\Presentation\HTTP\Controllers\MessageController;

Route::prefix("api")
    ->name("api.message")
    ->namespace('Src\\Agenda\\Message\\Presentation\\HTTP\\Controllers')
    ->group(function () {
        Route::post("message", [MessageController::class, "store"])->name("store")->middleware( 'auth');
    });
