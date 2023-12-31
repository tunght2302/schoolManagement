<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\SchoolClassController;
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

Route::get('/', [AuthController::class, 'login'])->name('admin.auth.login');

Route::post('/login', [AuthController::class, 'AuthLogin'])->name('admin.auth.confirmlogin');
Route::get('/logout', [AuthController::class, 'AuthLogout'])->name('admin.auth.logout');
Route::get('/forgot-password', [AuthController::class, 'ForgotPassWord'])->name('admin.auth.forgot-password');
Route::post('/forgot-password', [AuthController::class, 'ForgotPasswordConfirm'])->name('admin.auth.forgot-password-confirm');
Route::get('/reset/{oken}', [AuthController::class, 'ResetPassword'])->name('admin.auth.reset-password');
Route::post('/reset/{token}', [AuthController::class, 'ResetPasswordConfirm'])->name('admin.auth.reset-password-confirm');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.adminManagement.index');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.adminManagement.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.adminManagement.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.adminManagement.edit');
    Route::patch('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.adminManagement.update');
    Route::get('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.adminManagement.destroy');
    Route::get('/admin/search', [AdminController::class, 'searchAdmin'])->name('admin.adminManagement.search');
    //School Class
    Route::get('/school-class/index', [SchoolClassController::class, 'index'])->name('admin.schoolClassManagement.index');
    Route::get('/school-class/create', [SchoolClassController::class, 'create'])->name('admin.schoolClassManagement.create');
    Route::post('/school-class/store', [SchoolClassController::class, 'store'])->name('admin.schoolClassManagement.store');
    Route::get('/school-class/edit/{id}', [SchoolClassController::class, 'edit'])->name('admin.schoolClassManagement.edit');
    Route::patch('/school-class/update/{id}', [SchoolClassController::class, 'update'])->name('admin.schoolClassManagement.update');
    Route::get('/school-class/destroy/{id}', [SchoolClassController::class, 'destroy'])->name('admin.schoolClassManagement.destroy');
    Route::get('/school-class/search', [SchoolClassController::class, 'searchSchoolClass'])->name('admin.schoolClassManagement.search');
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
