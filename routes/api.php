<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasteController;
use Illuminate\Support\Facades\Route;


Route::name('pastes.')->prefix('pastes')->group(function(){

    Route::middleware(['auth:sanctum'])->group(function () {
        //get pastes for auth user
        Route::get('/my', [PasteController::class, 'my'])->name('my');
    });

    //get all public pastes
    Route::get('/', [PasteController::class, 'index'])->name('index');

    //get metadata {langs, accesses}
    Route::get('/meta', [PasteController::class, 'meta'])->name('meta');

    //get one paste
    Route::get('/{slug}', [PasteController::class, 'show'])->name('show');

    //add paste
    Route::post('/', [PasteController::class, 'store'])->name('store');

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
