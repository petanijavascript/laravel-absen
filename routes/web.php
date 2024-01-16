<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\RekapController;
use App\Http\Middleware\Authenticate;

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

//login
Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);
//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth.basic');
//absensi
Route::get('/absensi', [AbsensiController::class, 'index'])->middleware('auth.basic');
Route::post('/absensi/store', [AbsensiController::class, 'store']);
Route::post('/absensi/update', [AbsensiController::class, 'update']);
//register
Route::get('/register', [PenggunaController::class, 'index'])->middleware('auth.basic');
Route::post('/register/store', [PenggunaController::class, 'store']);
Route::post('/register/update', [PenggunaController::class, 'update']);
Route::post('/register/delete', [PenggunaController::class, 'delete']);
//rekap
Route::get('/rekap', [RekapController::class, 'index'])->middleware('auth.basic');
Route::post('/rekap/show', [RekapController::class, 'show']);
