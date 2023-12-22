<?php

namespace App\Http\Controllers;

use App\Imports\HasilStudiImport;
use App\Models\KartuStudi;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Traits\KonversiNilai;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class HasilStudiController extends Controller
{
    use KonversiNilai;

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
        $mahasiswa = User::where('username', $username)->firstOrFail();
        return view('hasil-studi.detail', compact('mahasiswa', 'tahun_ajaran'));
    }

    public function edit($username, $khs_id)
    {
        $mahasiswa = User::where('username', $username)->firstOrFail();
        $khs = KartuStudi::where('username', $username)->where('id', $khs_id)->firstOrFail();
        return view('hasil-studi.edit', compact('mahasiswa', 'khs'));
    }

    public function update(Request $request, $username, $khs_id)
    {
        $mahasiswa = User::where('username', $username)->firstOrFail();
        $khs = KartuStudi::where('username', $username)->where('id', $khs_id)->firstOrFail();
        $mata_kuliah = MataKuliah::where('kode', $khs->kode_mata_kuliah)->first();
        $request->validate([
            'tugas' => 'numeric|min:0|max:100',
            'uts' => 'numeric|min:0|max:100',
            'uas' => 'numeric|min:0|max:100'
        ]);

        $nilai = $this->konversi_nilai($request->tugas, $request->uts, $request->uas, $mata_kuliah->jumlah_sks);

        $khs->update([
            'tugas' => $nilai->tugas,
            'uts' => $nilai->uts,
            'uas' => $nilai->uas,
            'angka' => $nilai->angka,
            'bobot' => $nilai->bobot,
            'huruf' => $nilai->huruf,
        ]);

        return back()->with('message', 'KHS Berhasil diperbarui');
    }


    public function api_get_khs($username, $tahun_ajaran)
    {
        $khs = KartuStudi::where('username', $username)->where('tahun_ajaran', $tahun_ajaran)->with('mata_kuliah')->latest()->get();

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

    public function cetak_khs($username, $kode_tahun_ajaran)
    {
        $mahasiswa = User::where('username', $username)->firstOrFail();
        $khs = KartuStudi::where('username', $username)->where('tahun_ajaran', $kode_tahun_ajaran)->with('mata_kuliah')->latest()->get();
        $tahun_ajaran = TahunAjaran::where('kode_tahun_ajaran', $kode_tahun_ajaran)->first();
        $tanggal =  Carbon::today()->translatedFormat('d F Y');
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
            if ($total_sks > 0) {
                $ip = number_format($total_bobot / $total_sks, 2);
            }
        }
        $pdf = Pdf::loadView('cetak.khs', compact('khs', 'ip', 'total_bobot', 'total_sks', 'tanggal', 'tahun_ajaran', 'mahasiswa'));
        // return view('cetak.khs', compact('khs', 'ip', 'total_bobot', 'total_sks', 'tanggal', 'tahun_ajaran'));
        return $pdf->stream('Kartu Hasil Studi.pdf');
    }

    public function cetak_rekapitulasi($username)
    {
        $mahasiswa = User::where('username', $username)->firstOrFail();
        $rekap = KartuStudi::where('username', $username)->with('mata_kuliah')->latest()->get();
        $tanggal =  Carbon::today()->translatedFormat('d F Y');
        $total_bobot = 0;
        $total_sks = 0;
        foreach ($rekap as $key => $r) {
            $total_bobot += (float) $r->bobot;
            $total_sks += (float) $r->mata_kuliah->jumlah_sks;
        }
        $pdf = Pdf::loadView('cetak.rekapitulasi', compact('rekap', 'total_bobot', 'total_sks', 'tanggal', 'mahasiswa'));
        // return view('cetak.rekapitulasi', compact('rekap', 'ipk', 'total_bobot', 'total_sks'));
        return $pdf->stream('Rekapitulasi Hasil Studi.pdf');
    }
}
