<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['guest:web'])->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'index')->name('login');
        Route::post('/login', 'login')->name('attemptLogin');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'index')->name('register');
        Route::post('/register', 'register')->name('attemptRegister');
    });
});

Route::middleware(['auth:web,admin'])->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['seller'])->group(function () {
    Route::get('/seller', function () {
        return view('test-seller');
    });
});
