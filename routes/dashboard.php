<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaintingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactFormController;
use Illuminate\Http\Request;
use Inertia\inertia;

Route::middleware('auth')->group(function () {

    Route::prefix('dashboard')->group(function () {

        Route::get('/', function (Request $request) {

            $paintings = app(PaintingsController::class)->index($request);
            return Inertia::render('Dashboard/Home', [
                'paintings' => $paintings,
                'searchTerm' => $request->search,
            ]);
        })->name('dashboard.home');

        Route::inertia('/add', 'Dashboard/Add')
            ->name('dashboard.add');

        Route::inertia('/register', 'Dashboard/Register')
            ->name('dashboard.register');

        Route::get('/user', function () {
            $userInfo = app(UserController::class)->show();
            return Inertia::render('Dashboard/User', ['userInfo' => $userInfo]);
        })->name('dashboard.user');

        Route::inertia('/contacts', 'Dashboard/Contacts', ['messages' => function () {
            return app(ContactFormController::class)->messages();
        }])->name('dashboard.contacts');
    });

    Route::post('/paintings', [PaintingsController::class, 'create'])->name('paintings.create');
    Route::post('/paintings/{id}', [PaintingsController::class, 'update'])->name('painting.update'); //Browsers ondersteunen geen bestandsuploads via PUT of PATCH!!
    Route::delete('/paintings/{id}', [PaintingsController::class, 'destroy'])->name('painting.delete');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
});
