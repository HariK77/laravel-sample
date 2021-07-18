<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\GalleryController;
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

    // Resourceful Controllers
    Route::resource('categories', CategoryController::class);
    Route::resource('gallery', GalleryController::class);

    // Excel Operations
    Route::get('/excel', [ExcelController::class, 'index'])->name('excel');
    Route::get('excel/export',[ExcelController::class, 'export'])->name('excel.export');
    Route::get('excel/export-multiple-sheets',[ExcelController::class, 'exportMultipleSheets'])->name('excel.export-multiple-sheets');
    Route::post('excel/import',[ExcelController::class, 'import'])->name('excel.import');
    Route::post('excel/import-multiple-sheets',[ExcelController::class, 'importMultipleSheets'])->name('excel.import-multiple-sheets');

    // Ajax Operations
    Route::get('/ajax', [AjaxController::class, 'index'])->name('ajax');
    Route::get('/ajax/get-products', [AjaxController::class, 'getProducts'])->name('ajax.get-products');
    Route::post('/ajax/store', [AjaxController::class, 'store'])->name('ajax.store');
    Route::get('/ajax/{product}/edit', [AjaxController::class, 'edit'])->name('ajax.edit');

});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
