<?php

use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/email/verify', [EmailVerificationController::class, 'emailVerify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/resend-verification-notification', [EmailVerificationController::class, 'resendEmailVerificationLink'])->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
Route::get('/password/change', [ChangePasswordController::class, 'changePassword'])->name('change-password');
Route::post('/password/update', [ChangePasswordController::class, 'updatePassword'])->name('update-password');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
