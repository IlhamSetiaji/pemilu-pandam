<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DapilController;
use App\Http\Controllers\ParlemenController;
use App\Http\Controllers\PemilihController;
use App\Http\Controllers\PresidentController;

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

Route::get('ip', [AdminController::class, 'getIp']);

// Route::group(['middleware' => 'ipcheck'], function(){
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'storeLogin']);

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('is.pemilih')->group(function () {
        Route::get('/', [PemilihController::class, 'index']);
        Route::post('/{userID}/vote', [PemilihController::class, 'vote']);
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
            Route::delete('pemilih/{pemilihID}/delete', [AdminController::class, 'deletePemilih']);

            Route::get('{pemiluId}/print', [AdminController::class, 'printUsers']);

            Route::get('{pemiluID}/hasil', [AdminController::class, 'hasilPemilu']);
            Route::get('{dapilID}/hasil/dapil', [AdminController::class, 'hasilPemiluDapil']);
            Route::get('{pemiluID}/latest-pemilu', [AdminController::class, 'latestPemilu']);

            Route::prefix('dapil')->group(function () {
                Route::get('/', [DapilController::class, 'index']);
                Route::post('create', [DapilController::class, 'create']);
                Route::put('{id}/update', [DapilController::class, 'update']);
                Route::delete('{id}/delete', [DapilController::class, 'delete']);
            });

            Route::prefix('parlement')->group(function () {
                Route::get('{id}/show', [ParlemenController::class, 'index']);
                Route::get('{id}/edit', [ParlemenController::class, 'editView']);
                Route::get('{id}/create', [ParlemenController::class, 'create']);
                Route::post('{id}/create', [ParlemenController::class, 'store']);
                Route::put('{id}/update', [ParlemenController::class, 'update']);
                Route::delete('{id}/delete', [ParlemenController::class, 'delete']);
            });

            Route::prefix('president')->group(function () {
                Route::get('/', [PresidentController::class, 'listPemilu']);
                Route::get('{id}/list', [PresidentController::class, 'listPresident']);
                Route::get('{id}/create', [PresidentController::class, 'create']);
                Route::post('{id}/create', [PresidentController::class, 'store']);
                Route::get('{id}/edit', [PresidentController::class, 'edit']);
                Route::put('{id}/edit', [PresidentController::class, 'update']);
                Route::delete('{id}/delete', [PresidentController::class, 'delete']);
            });
        });
    });
});
// });
