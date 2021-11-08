<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasteController;
use Illuminate\Support\Facades\Route;




Route::middleware('auth:sanctum')->name('pastes.')->prefix('pastes')->group(function(){
    Route::get('/', [PasteController::class, 'index'])->name('index');
    Route::get('/{id}', [PasteController::class, 'show'])->name('show');
    Route::post('/', [PasteController::class, 'index'])->name('store');
});

Route::name('users.')->prefix('users')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/{id}', [UserController::class, 'show'])->name('show');
});

Route::name('auth.')->prefix('auth')->group(function(){
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/check', [AuthController::class, 'check'])->name('check');
    });
    Route::middleware(['guest'])->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
    });
});
