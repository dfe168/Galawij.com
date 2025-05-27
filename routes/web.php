<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaintingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactFormController;
use Illuminate\Http\Request;

//public
Route::get('/', function () {
    return redirect('home');
})->name('homepage');

Route::inertia('/home', 'Home')
    ->name('home');

Route::inertia('/about', 'About')
    ->name('about');

Route::get('/gallery', function (Request $request) {
    $paintings = app(PaintingsController::class)->index($request);
    return Inertia::render('Gallery', ['paintings' => $paintings]);
})->name('gallery');

Route::inertia('/contact', 'Contact')
    ->name('contact');

Route::post('/contact', [ContactFormController::class, 'send'])->name('contact.send');

Route::middleware('guest')->group(function () {
    Route::inertia('/login', 'Auth/Login')
        ->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

//Auth users
Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
});


require __DIR__ . "/dashboard.php";
