<?php

use App\Http\Controllers\AbsenController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;

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

Route::controller(LoginController::class)->group(function () {
    Route::get('/auth', 'index')->name('login')->middleware('guest');
    Route::post('/auth', 'authenticate');
    Route::post('/logout', 'logout');
});

    
Route::get('/', [DashboardController::class, 'index'])->middleware('auth');


Route::middleware(['auth'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/data-pegawai', 'members');   
        Route::post('/data-pegawai/store', 'store');
        Route::post('/data-pegawai/destroy', 'destroy');
    });
    
    Route::controller(DivisionController::class)->group(function () {
        Route::get('/data-sekbid', 'index');
        Route::post('/data-sekbid', 'store');
        Route::post('/data-sekbid/destroy', 'destroy');
    });
    
    Route::controller(AbsenController::class)->group(function () {
        Route::get('/riwayat-absen', 'history');
        Route::get('/rekap-absen', 'recap');
        Route::get('/riwayat-absen/export', 'export')->name('data.export');
        Route::post('/riwayat-absen', 'import');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('/settings', 'index');
        Route::post('/settings/shift', 'store')->name('shift.setting');
    });
});
    