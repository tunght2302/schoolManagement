<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\ClassSubjectsController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\SchoolSubjectController;
use App\Http\Controllers\SchoolSubjectTypeController;
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

Route::prefix('admin')->middleware(['admin'])->group(function () {
    //Admin
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('admin.dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::patch('/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');

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
    //School Subject Type
    Route::get('/school-subject-type/index', [SchoolSubjectTypeController::class, 'index'])->name('admin.schoolSubjectTypeManagement.index');
    Route::get('/school-subject-type/create', [SchoolSubjectTypeController::class, 'create'])->name('admin.schoolSubjectTypeManagement.create');
    Route::post('/school-subject-type/store', [SchoolSubjectTypeController::class, 'store'])->name('admin.schoolSubjectTypeManagement.store');
    Route::get('/school-subject-type/edit/{id}', [SchoolSubjectTypeController::class, 'edit'])->name('admin.schoolSubjectTypeManagement.edit');
    Route::patch('/school-subject-type/update/{id}', [SchoolSubjectTypeController::class, 'update'])->name('admin.schoolSubjectTypeManagement.update');
    Route::get('/school-subject-type/destroy/{id}', [SchoolSubjectTypeController::class, 'destroy'])->name('admin.schoolSubjectTypeManagement.destroy');
    Route::get('/school-subject-type/search', [SchoolSubjectTypeController::class, 'searchSchoolSubjectType'])->name('admin.schoolSubjectTypeManagement.search');
    //School Subject
    Route::get('/school-subject/index', [SchoolSubjectController::class, 'index'])->name('admin.schoolSubjectManagement.index');
    Route::get('/school-subject/create', [SchoolSubjectController::class, 'create'])->name('admin.schoolSubjectManagement.create');
    Route::post('/school-subject/store', [SchoolSubjectController::class, 'store'])->name('admin.schoolSubjectManagement.store');
    Route::get('/school-subject/edit/{id}', [SchoolSubjectController::class, 'edit'])->name('admin.schoolSubjectManagement.edit');
    Route::patch('/school-subject/update/{id}', [SchoolSubjectController::class, 'update'])->name('admin.schoolSubjectManagement.update');
    Route::get('/school-subject/destroy/{id}', [SchoolSubjectController::class, 'destroy'])->name('admin.schoolSubjectManagement.destroy');
    Route::get('/school-subject/search', [SchoolSubjectController::class, 'searchSchoolSubject'])->name('admin.schoolSubjectManagement.search');
    //Class Subject
    Route::get('/class-subject/index', [ClassSubjectController::class, 'index'])->name('admin.classSubjectManagement.index');
    Route::get('/class-subject/create', [ClassSubjectController::class, 'create'])->name('admin.classSubjectManagement.create');
    Route::post('/class-subject/store', [ClassSubjectController::class, 'store'])->name('admin.classSubjectManagement.store');
    Route::get('/class-subject/edit-single/{id}', [ClassSubjectController::class, 'edit'])->name('admin.classSubjectManagement.edit');
    Route::patch('/class-subject/update-single/{id}', [ClassSubjectController::class, 'update'])->name('admin.classSubjectManagement.update');
    Route::get('/class-subject/edit-all/{id}', [ClassSubjectController::class, 'edits'])->name('admin.classSubjectManagement.edits');
    Route::patch('/class-subject/update-all/{id}', [ClassSubjectController::class, 'updates'])->name('admin.classSubjectManagement.updates');
    Route::get('/class-subject/destroy/{id}', [ClassSubjectController::class, 'destroy'])->name('admin.classSubjectManagement.destroy');
    Route::get('/class-subject/search', [ClassSubjectController::class, 'searchClassSubject'])->name('admin.classSubjectManagement.search');
});

Route::prefix('teacher')->middleware(['teacher'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-teacher');
});

Route::prefix('student')->middleware(['student'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-student');
});

Route::prefix('parent')->middleware(['parent'])->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard-parent');
});