<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\EmailVerificationController;

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

Route::middleware(['guest:admin'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products/{id}', 'getProduct')->name('getProduct');
    });
});

Route::controller(HomeController::class)->group(function(){
    Route::get('/', 'getAllProduct')->name('getAllProduct');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/{category}', 'index')->name('categoryPage');
    Route::get('/category/{category}/{sort}', 'sortProducts')->name('sortProducts');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products/{id}', 'getProduct')->name('getProduct');
});

Route::middleware(['guest:web,admin'])->group(function () {
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

Route::middleware(['auth'])->group(function () {
    Route::controller(EmailVerificationController::class)->group(function () {
        Route::get('/email/verify', 'verificationNotice')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['signed'])->name('verification.verify');
        Route::post('/email/verification-notification', 'resendVerification')->middleware(['throttle:6,1'])->name('verification.send');
    });
});

Route::controller(GoogleDriveController::class)->group(function () {
    Route::post('/store-file', 'storeFile')->name('storeFile');
    Route::get('/get-file', 'getFile')->name('getFile');
    Route::get('/test', 'index')->name('testDrive');
});
Route::fallback(function () {
    return view('errors.404');
})->middleware(['web','admin']);
