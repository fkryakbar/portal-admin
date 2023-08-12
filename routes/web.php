<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
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
    // return view('welcome');
})->name('login');
Route::get('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();
    // return redirect()->to('https://siamad.stitastbr.ac.id');
    return redirect()->to('/');
});


// development purpose
Route::post('/', function (Request $request) {
    $credentials =  $request->validate([
        'username' => 'required',
        'password' => 'required'
    ]);


    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('dashboard');
    }

    return back()->withErrors([
        'username' => 'The provided credentials do not match our records.',
    ]);
});

Route::get('auth', function (Request $request) {
    try {
        $token = $request->token;
        $decrypted =  Crypt::decryptString($token);
        $decoded = json_decode($decrypted);
        $user = User::find($decoded->id);
        Auth::login($user);
    } catch (\Throwable $th) {
        abort(404);
    }
    return redirect()->to('/dashboard');
});
