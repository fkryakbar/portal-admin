<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PresensiDosenController;
use App\Http\Controllers\TahunAjaranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;

Route::middleware(['superAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::group(['prefix' => 'dosen'], function () {
        Route::get('/', [DosenController::class, 'index']);
        Route::get('/tambah', [DosenController::class, 'tambah']);
        Route::post('/tambah', [DosenController::class, 'store']);
        Route::get('/{username}', [DosenController::class, 'edit']);
        Route::post('/{username}', [DosenController::class, 'update']);
        Route::get('/{username}/hapus', [DosenController::class, 'delete']);
    });

    Route::group(['prefix' => 'mahasiswa'], function () {
        Route::get('/', [MahasiswaController::class, 'index']);
        Route::get('/tambah', [MahasiswaController::class, 'tambah']);
        Route::post('/tambah', [MahasiswaController::class, 'store']);
        Route::get('/{username}', [MahasiswaController::class, 'edit']);
        Route::post('/{username}', [MahasiswaController::class, 'update']);
        Route::get('/{username}/hapus', [MahasiswaController::class, 'delete']);
    });

    Route::group(['prefix' => 'tahun-ajaran'], function () {
        Route::get('/', [TahunAjaranController::class, 'index']);
        Route::get('/tambah', [TahunAjaranController::class, 'tambah']);
        Route::post('/tambah', [TahunAjaranController::class, 'store']);
        Route::get('/{kode_tahun_ajaran}', [TahunAjaranController::class, 'edit']);
        Route::post('/{kode_tahun_ajaran}', [TahunAjaranController::class, 'update']);
        Route::get('/{kode_tahun_ajaran}/hapus', [TahunAjaranController::class, 'delete']);
    });

    Route::group(['prefix' => 'presensi-dosen'], function () {
        Route::get('/', [PresensiDosenController::class, 'index']);
        Route::get('/{username}', [PresensiDosenController::class, 'detail']);
        Route::get('/{kode_pertemuan}/hapus', [PresensiDosenController::class, 'delete']);
        Route::get('/{username}/{kode_pertemuan}', [PresensiDosenController::class, 'edit']);
        Route::post('/{username}/{kode_pertemuan}', [PresensiDosenController::class, 'update']);
    });





    Route::group(['prefix' => 'api'], function () {
        Route::get('/presensi-dosen/{username}/{tahun_ajaran}', [PresensiDosenController::class, 'api_get_presensi']);
    });
});





Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role == 'superAdmin') {
            return redirect()->to('/dashboard');
        }
    }
    return redirect()->to('https://siamad.stitastbr.ac.id');
})->name('login');


Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    return redirect()->to('/');
});


// development purpose
Route::get('/run-dev', function () {

    $user = User::where('role', 'superAdmin')->firstOrFail();
    Auth::login($user);

    return redirect('/dashboard');
});
