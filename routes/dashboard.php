<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\PaintingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [PaintingController::class, 'index'])->name('dashboard.home');
        Route::inertia('/add', 'Dashboard/Add')->name('dashboard.add');
        Route::inertia('/register', 'Dashboard/Register')->name('dashboard.register');
        Route::get('/user', [UserController::class, 'show'])->name('dashboard.user');
        Route::get('contacts', [ContactFormController::class, 'messages'])->name('dashboard.contacts');
    });

    Route::post('/painting', [PaintingController::class, 'create'])->name('painting.create');
    Route::post('/painting/{id}', [PaintingController::class, 'update'])->name('painting.update'); // Browsers ondersteunen geen bestandsuploads via PUT of PATCH!!
    Route::delete('/painting/{id}', [PaintingController::class, 'destroy'])->name('painting.delete');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
});
