<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $dosen = User::where('role', 'dosen')->get();
        $mahasiswa = User::where('role', 'mahasiswa')->get();
        return view('dashboard.index', [
            'dosen' => $dosen,
            'mahasiswa' => $mahasiswa
        ]);
    }
}
