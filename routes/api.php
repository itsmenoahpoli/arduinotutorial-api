<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Media\MediaVideosController;

Route::prefix('v1')->group(function() {
    Route::prefix('auth')->group(function() {
        Route::post('signin', [AuthController::class, 'signin']);
    });

    Route::apiResource('media/videos', MediaVideosController::class);
});
