<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\LoginController;
use Modules\Auth\Controllers\LogoutController;
use Modules\Auth\Controllers\RegisterController;
use Modules\Auth\Middleware\RoleMiddleware;

Route::middleware(['web'])
    ->namespace('Modules\\Auth\\Controllers')
    ->group(function () {
        // Health check
        Route::get('/auth/ping', function () {
            return response()->json(['status' => 'ok', 'module' => 'Auth', 'env' => app()->environment()]);
        });

        // Auth routes
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');

        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

        // Dashboard (dummy) - accessible to authenticated users
        Route::get('/dashboard', function () {
            return view('auth.dashboard');
        })->middleware('auth');

        // Example role protected route
        Route::get('/dashboard/admin', function () {
            return view('auth.dashboard');
        })->middleware([RoleMiddleware::class.':admin']);
    });
