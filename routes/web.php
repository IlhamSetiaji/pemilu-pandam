<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PemilihController;

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

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'storeLogin']);

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('is.pemilih')->group(function () {
        Route::get('/', [PemilihController::class, 'index']);
        Route::get('/{userID}/pilih', [PemilihController::class, 'pilihKetua']);
    });
    Route::middleware('is.admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index']);
            Route::get('/pemilu', [AdminController::class, 'showAllPemilu']);
            Route::post('/pemilu', [AdminController::class, 'storePemilu']);
            Route::put('/pemilu/{pemiluID}/update', [AdminController::class, 'updatePemilu']);
            Route::put('/pemilu/{pemiluID}/update-status', [AdminController::class, 'updateStatusPemilu']);
            Route::delete('/pemilu/{pemiluID}/delete', [AdminController::class, 'deletePemilu']);

            Route::get('/calon', [AdminController::class, 'showAllKetua']);
            Route::post('/calon', [AdminController::class, 'storeKetua']);
            Route::post('/calon/{osisID}/update', [AdminController::class, 'updateKetua']);
            Route::get('/calon/{osisID}/delete', [AdminController::class, 'deleteKetua']);

            Route::get('/{pemiluID}/pemilih', [AdminController::class, 'showPemilih']);
            Route::post('/{pemiluID}/pemilih', [AdminController::class, 'storePemilih']);
            Route::get('/{pemiluID}/pemilih/{pemilihID}/delete', [AdminController::class, 'deletePemilih']);

            Route::get('/{pemiluID}/hasil', [AdminController::class, 'hasilPemilu']);
        });
    });
});
