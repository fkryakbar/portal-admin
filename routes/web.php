<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HasilStudiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KRSController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\PresensiDosenController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\TahunAjaranController;
use App\Livewire\Kelas\Index as Kelas;
use App\Livewire\Kelas\ManageKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::middleware(['superAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::group(['prefix' => 'jurusan'], function () {
        Route::get('/', [JurusanController::class, 'index']);
        Route::get('/tambah', [JurusanController::class, 'tambah']);
        Route::post('/tambah', [JurusanController::class, 'store']);
        Route::get('/{kode_jurusan}', [JurusanController::class, 'edit']);
        Route::post('/{kode_jurusan}', [JurusanController::class, 'update']);
        Route::get('/{kode_jurusan}/hapus', [JurusanController::class, 'delete']);
    });
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
        Route::post('/import', [MahasiswaController::class, 'import']);
        Route::get('/export', [MahasiswaController::class, 'export']);
        Route::get('/{username}', [MahasiswaController::class, 'edit']);
        Route::post('/{username}', [MahasiswaController::class, 'update']);
        Route::get('/{username}/hapus', [MahasiswaController::class, 'delete']);
    });

    Route::group(['prefix' => 'registrasi'], function () {
        Route::get('/', [RegistrasiController::class, 'index']);
        Route::get('/tambah', [RegistrasiController::class, 'tambah']);
        Route::post('/tambah', [RegistrasiController::class, 'store']);
        Route::get('/{kode_tahun_ajaran}', [RegistrasiController::class, 'detail']);
        Route::get('/{kode_tahun_ajaran}/hapus', [RegistrasiController::class, 'delete']);
        Route::get('/{kode_tahun_ajaran}/{username}', [RegistrasiController::class, 'change_status']);
    });

    Route::group(['prefix' => 'tahun-ajaran'], function () {
        Route::get('/', [TahunAjaranController::class, 'index']);
        Route::get('/tambah', [TahunAjaranController::class, 'tambah']);
        Route::post('/tambah', [TahunAjaranController::class, 'store']);
        Route::get('/{kode_tahun_ajaran}', [TahunAjaranController::class, 'edit']);
        Route::post('/{kode_tahun_ajaran}', [TahunAjaranController::class, 'update']);
        Route::get('/{kode_tahun_ajaran}/hapus', [TahunAjaranController::class, 'delete']);
    });

    Route::group(['prefix' => 'kelas'], function () {
        Route::get('/', Kelas::class);
        Route::get('/{kode_kelas}', ManageKelas::class);
        Route::get('/{kode_kelas}/cetak', [KelasController::class, 'cetak']);
    });
    Route::group(['prefix' => 'krs'], function () {
        Route::get('/', [KRSController::class, 'index']);
        Route::get('/{username}', [KRSController::class, 'detail']);
        Route::get('{username}/tambah', [KRSController::class, 'tambah']);
        Route::post('{username}/tambah', [KRSController::class, 'store']);
        Route::get('/{id}/hapus', [KRSController::class, 'delete']);
        Route::get('{username}/{krs_id}', [KRSController::class, 'edit']);
        Route::post('{username}/{krs_id}', [KRSController::class, 'update']);
        Route::post('/import', [KRSController::class, 'import']);
        Route::get('/{username}/{kode_tahun_ajaran}/cetak', [KRSController::class, 'cetak']);
    });

    Route::group(['prefix' => 'hasil-studi'], function () {
        Route::get('/', [HasilStudiController::class, 'index']);
        Route::get('/{username}', [HasilStudiController::class, 'detail']);
        Route::get('/{username}/cetak-rekapitulasi', [HasilStudiController::class, 'cetak_rekapitulasi']);
        Route::get('{username}/{khs_id}', [HasilStudiController::class, 'edit']);
        Route::post('{username}/{khs_id}', [HasilStudiController::class, 'update']);
        Route::post('/import', [HasilStudiController::class, 'import']);
        Route::get('/{username}/{kode_tahun_ajaran}/cetak-khs', [HasilStudiController::class, 'cetak_khs']);
    });


    Route::group(['prefix' => 'mata-kuliah'], function () {
        Route::get('/', [MataKuliahController::class, 'index']);
        Route::get('/tambah', [MataKuliahController::class, 'tambah']);
        Route::post('/tambah', [MataKuliahController::class, 'store']);
        Route::post('/import', [MataKuliahController::class, 'import']);
        Route::get('/{kode}', [MataKuliahController::class, 'edit']);
        Route::post('/{kode}', [MataKuliahController::class, 'update']);
        Route::get('/{kode}/hapus', [MataKuliahController::class, 'delete']);
    });

    Route::group(['prefix' => 'presensi-dosen'], function () {
        Route::get('/', [PresensiDosenController::class, 'index']);
        Route::get('/cetak/{kode_tahun_ajaran}', [PresensiDosenController::class, 'cetak']);
        Route::get('/{username}', [PresensiDosenController::class, 'detail']);
        Route::get('/{kode_pertemuan}/hapus', [PresensiDosenController::class, 'delete']);
        Route::get('/{username}/{kode_pertemuan}', [PresensiDosenController::class, 'edit']);
        Route::post('/{username}/{kode_pertemuan}', [PresensiDosenController::class, 'update']);
    });


    Route::group(['prefix' => 'api'], function () {
        Route::get('/presensi-dosen/{username}/{tahun_ajaran}', [PresensiDosenController::class, 'api_get_presensi']);
        Route::get('/krs/{username}/{tahun_ajaran}', [KRSController::class, 'api_get_krs']);
        Route::get('/hasil-studi/{username}/{tahun_ajaran}', [HasilStudiController::class, 'api_get_khs']);
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
// Route::get('/run-dev', function () {

//     $user = User::where('role', 'superAdmin')->firstOrFail();
//     Auth::login($user);

//     return redirect('/dashboard');
// });
