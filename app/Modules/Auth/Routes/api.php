<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')
    ->middleware(['api'])
    ->namespace('Modules\\Auth\\Controllers')
    ->group(function () {
        Route::get('/auth/ping', function () {
            return response()->json(['status' => 'ok', 'module' => 'Auth', 'api' => true]);
        });
    });
