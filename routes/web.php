<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\writer\AuthController as WriterAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WriterController;
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
Route::middleware('auth')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('user.dashboard');
});
Route::get('/login', [AuthController::class, 'loginForm'])->name('user.login.form');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('user.register.form');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::prefix('/admin')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    });
    Route::get('/register', [AdminAuthController::class, 'registerForm'])->name('admin.register.form');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
    Route::get('/login', [AdminAuthController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::prefix('/writer')->group(function () {
    Route::middleware(['auth:writer'])->group(function () {
        Route::get('/dashboard', [WriterController::class, 'index'])->name('writer.dashboard');

        Route::resource('posts', PostController::class)->only(['index', 'create', 'store']);
    });
    Route::get('/register', [WriterAuthController::class, 'registerForm'])->name('writer.register.form');
    Route::post('/register', [WriterAuthController::class, 'register'])->name('writer.register');
    Route::get('/login', [WriterAuthController::class, 'loginForm'])->name('writer.login.form');
    Route::post('/login', [WriterAuthController::class, 'login'])->name('writer.login');
    Route::post('/logout', [WriterAuthController::class, 'logout'])->name('writer.logout');
});


