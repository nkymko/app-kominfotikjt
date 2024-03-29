<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\DashboardController;

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


Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);

    Route::get('profile/{user:username}', [UserController::class, 'show']); // user true

    Route::get('riwayat-absen/{user:username}', [AbsenController::class ,'userhistory']);
    Route::get('rekap-absen/{user:username}', [AbsenController::class ,'show'])->name('rekap.show'); // user true
    Route::post('rekap-exportpdf', [AbsenController::class ,'generatePDF'])->name('rekap.pdf');
    Route::post('rekap-exportxlsx', [AbsenController::class ,'recapexport'])->name('rekap.excel');
});

Route::middleware(['admin'])->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('data-pegawai', 'members');   
        Route::post('pegawai-store', 'store')->name('pegawai.store');
        Route::post('pegawai-destroy', 'destroy')->name('pegawai.destroy');
    });
    
    Route::controller(DivisionController::class)->group(function () {
        Route::get('data-sekbid', 'index');
        Route::post('sekbid-store', 'store')->name('sekbid.store');
        Route::post('sekbid-destroy', 'destroy')->name('sekbid.destroy');
        Route::post('data-sekbid/{slug}', 'edit')->name('sekbid.edit'); // all not true
    });

    Route::controller(PositionController::class)->group(function () {
        Route::get('data-jabatan', 'index');
        Route::post('position-store', 'store')->name('position.store');
        Route::post('position-destroy', 'destroy')->name('position.destroy'); // all not true
    });
    
    Route::controller(AbsenController::class)->group(function () {
        Route::get('riwayat-absen', 'history');
        Route::get('rekap-absen', 'recap');
        Route::get('riwayat-absen/export', 'export')->name('data.export');
        Route::post('riwayat-absen', 'import');
        Route::post('rekap-refresh', 'refresh')->name('absen.refresh');
    });

    Route::controller(SettingController::class)->group(function () {
        Route::get('settings', 'index');
        Route::post('settings/shift', 'store')->name('shift.setting');
    });
});
    