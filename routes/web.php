<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\AdminFormController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserAccountController;

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

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [FormController::class, 'FormIndex'])->name('FormIndex');
Route::post('forms', [FormController::class, 'FormCreate'])->name('FormCreate');

Route::middleware(['user'])->group(function () {
    Route::get('/user/accout/form', [UserAccountController::class, 'userAccountFormsIndex'])->name('userAccountFormsIndex');
    Route::get('/user/account/record', [UserAccountController::class, 'userRecordForm'])->name('userRecordForm');
    Route::get('/user/account/{id}/edit', [UserAccountController::class, 'userShowFormEdit'])->name('userShowFormEdit');
    Route::put('/user/forms/{id}/update', [UserAccountController::class, 'updateUserForm'])->name('updateUserForm');
    Route::get('/user/forms/export/{id}', [UserAccountController::class, 'exportUserPDF'])->name('exportUserPDF');
    Route::post('/user/{form}/reply', [UserAccountController::class, 'userReply'])->name('userReply');
    Route::delete('/land-change-notification/{id}', [UserAccountController::class, 'destroy'])->name('landChangeNotification.destroy');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/forms', [AdminFormController::class, 'adminshowform'])->name('adminshowform');
    Route::get('/admin/forms/{id}/edit', [AdminFormController::class, 'adminshowformedit'])->name('adminshowformedit');
    Route::put('/admin/forms/{id}', [AdminFormController::class, 'adminformupdate'])->name('adminformupdate');
    Route::get('/admin/forms/export/{id}', [AdminFormController::class, 'exportPDF'])->name('exportPDF');
    Route::post('/admin/{form}/reply', [AdminFormController::class, 'adminReply'])->name('adminReply');
    Route::post('/admin/forms/{id}/update-status', [AdminFormController::class, 'updateStatus'])->name('updateStatus');
});

