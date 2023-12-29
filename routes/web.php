<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [AuthController::class, 'login']);

Route::post('/login', [AuthController::class, 'AuthLogin'])->name('admin.auth.login');
Route::get('/logout', [AuthController::class, 'AuthLogout'])->name('admin.auth.logout');
Route::get('/forgot-password', [AuthController::class, 'ForgotPassWord'])->name('admin.auth.forgot-password');
Route::post('/forgot-password', [AuthController::class, 'ForgotPasswordConfirm'])->name('admin.auth.forgot-password-confirm');
Route::get('/reset/{oken}', [AuthController::class, 'ResetPassword'])->name('admin.auth.reset-password');
Route::post('/reset/{token}', [AuthController::class, 'ResetPasswordConfirm'])->name('admin.auth.reset-password-confirm');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-admin');
    // Route::get('/admin-management', [DashBoardController::class, 'index'])->name('admin-management');
    Route::get('/admin-management', function () {
        return view('admin.adminManagement.list');
    })->name('admin-management');
});

Route::prefix('teacher')->middleware(['auth', 'teacher'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-teacher');
});

Route::prefix('student')->middleware(['auth', 'student'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-student');
});

Route::prefix('parent')->middleware(['auth', 'parent'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-parent');
});