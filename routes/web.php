<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\UserController;
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
Route::get('/', [UserController::class, 'index'])->name('user.dashboard')->middleware('auth');
Route::get('/login', [AuthController::class, 'loginForm'])->name('user.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('user.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::prefix('/admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(['auth:admin']);

    Route::get('/register', [AdminAuthController::class, 'registerForm'])->name('admin.register.form');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});


