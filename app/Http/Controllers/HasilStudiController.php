<?php

namespace App\Http\Controllers;

use App\Imports\HasilStudiImport;
use App\Models\KartuStudi;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HasilStudiController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->latest()->paginate();
        if ($request->search) {
            $searchQuery = $request->search;
            $mahasiswa = User::where('role', 'mahasiswa')->where(function (Builder $query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('username', 'like', '%' . $searchQuery . '%');
            })
                ->latest()
                ->paginate();
        }
        return view('hasil-studi.index', compact('mahasiswa'));
    }

    public function detail($username)
    {
        $tahun_ajaran = TahunAjaran::latest()->get();
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        return view('hasil-studi.detail', compact('mahasiswa', 'tahun_ajaran'));
    }

    public function edit($username, $khs_id)
    {
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        $khs = KartuStudi::where('username', (int)$username)->where('id', $khs_id)->firstOrFail();
        return view('hasil-studi.edit', compact('mahasiswa', 'khs'));
    }

    public function update(Request $request, $username, $khs_id)
    {
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        $khs = KartuStudi::where('username', (int)$username)->where('id', $khs_id)->firstOrFail();
        $mata_kuliah = MataKuliah::where('kode', $khs->kode_mata_kuliah)->first();
        $request->validate([
            'tugas' => 'numeric|max:100',
            'uts' => 'numeric|max:100',
            'uas' => 'numeric|max:100'
        ]);

        $angka = null;
        $huruf = null;
        $bobot = null;
        if ($request->tugas && $request->uts && $request->uas && $mata_kuliah) {
            $angka = ((int)$request->tugas * 30 +  (int)$request->uts * 30 + (int)$request->uas * 40) / 100;
            $angka = number_format($angka, 2);
            $huruf = 'E';
            $bobot = 0 * (int)$mata_kuliah->jumlah_sks;

            if ($angka >= 85) {
                $huruf = "A";
                $bobot = 4 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 80) {
                $huruf = 'A-';
                $bobot = 3.75 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 75) {
                $huruf = 'B+';
                $bobot = 3.5 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 70) {
                $huruf = 'B';
                $bobot = 3 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 65) {
                $huruf = 'B-';
                $bobot = 2.70 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 60) {
                $huruf = 'C+';
                $bobot = 2.35 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 55) {
                $huruf = 'C';
                $bobot = 2 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 50) {
                $huruf = 'D+';
                $bobot = 1.50 * (int)$mata_kuliah->jumlah_sks;
            } else if ($angka >= 40) {
                $huruf = 'D';
                $bobot = 1 * (int)$mata_kuliah->jumlah_sks;
            }
        }

        $khs->update([
            'tugas' => $request->tugas,
            'uts' => $request->uts,
            'uas' => $request->uas,
            'angka' => $angka,
            'bobot' => $bobot,
            'huruf' => $huruf,
        ]);

        return back()->with('message', 'KHS Berhasil diperbarui');
    }


    public function api_get_khs($username, $tahun_ajaran)
    {
        $khs = KartuStudi::where('username', (int)$username)->where('tahun_ajaran', $tahun_ajaran)->with('mata_kuliah')->latest()->get();

        $ip = 0;
        $total_bobot = 0;
        $total_sks = 0;
        if (count($khs) > 0) {
            foreach ($khs as $key => $k) {
                if ($k->mata_kuliah) {
                    $total_sks += (float) $k->mata_kuliah->jumlah_sks;
                    $total_bobot += (float)$k->bobot;
                }
            }
            $ip = number_format($total_bobot / $total_sks, 2);
        }

        return response([
            'message' => 'Success',
            'data' => [
                'khs' => $khs,
                'ip' => $ip,
                'total_bobot' => $total_bobot,
                'total_sks' => $total_sks,
            ]
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'mimes:xlsx,xls|required'
        ]);

        Excel::import(new HasilStudiImport, $request->file('excel'));
        return back()->with('message', 'Hasil Studi Berhasil diperbarui');
    }
}
