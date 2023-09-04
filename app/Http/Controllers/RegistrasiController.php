<?php

namespace App\Http\Controllers;

use App\Models\RegistrasiAkademik;
use App\Models\RiwayatRegistrasi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class RegistrasiController extends Controller
{
    public function index()
    {
        $registrasi_akademik = RegistrasiAkademik::latest()->get();
        return view('registrasi.index', compact('registrasi_akademik'));
    }


    public function tambah()
    {
        $tahun_ajaran = TahunAjaran::latest()->get();
        return view('registrasi.tambah', compact('tahun_ajaran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tahun_ajaran' => 'required|unique:registrasi_akademik',
            'nama_registrasi' => 'required'
        ]);

        RegistrasiAkademik::create($request->all());

        $mahasiswa = User::where('role', 'mahasiswa')->get();

        foreach ($mahasiswa as $key => $m) {
            RiwayatRegistrasi::create([
                'username' => $m->username,
                'kode_tahun_ajaran' => $request->kode_tahun_ajaran
            ]);
        }

        return redirect('/registrasi')->with('message', 'Registrasi Akademik Berhasil dibuat');
    }

    public function delete($kode_tahun_ajaran)
    {
        $registrasi_akademik = RegistrasiAkademik::where('kode_tahun_ajaran', $kode_tahun_ajaran)->firstOrFail()->delete();

        $riwayat_registrasi = RiwayatRegistrasi::where('kode_tahun_ajaran', $kode_tahun_ajaran)->delete();

        return back()->with('message', 'Registrasi Akademik Berhasil dihapus');
    }

    public function detail($kode_tahun_ajaran,  Request $request)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->with('riwayat_registrasi')->latest()->paginate();
        if ($request->search) {
            $searchQuery = $request->search;
            $mahasiswa = User::where('role', 'mahasiswa')->where(function (Builder $query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('username', 'like', '%' . $searchQuery . '%');
            })
                ->with('riwayat_registrasi')
                ->latest()
                ->paginate();
        }
        $belum_registrasi = RiwayatRegistrasi::where('kode_tahun_ajaran', $kode_tahun_ajaran)->where('status_registrasi', 'verified')->get();
        $riwayat_registrasi = RiwayatRegistrasi::where('kode_tahun_ajaran', $kode_tahun_ajaran)->get();
        return view('registrasi.detail', compact('mahasiswa', 'belum_registrasi', 'riwayat_registrasi', 'kode_tahun_ajaran'));
    }

    public function change_status($kode_tahun_ajaran, $username)
    {
        $riwayat_registrasi = RiwayatRegistrasi::where('kode_tahun_ajaran', $kode_tahun_ajaran)->where('username', $username)->firstOrFail();

        if ($riwayat_registrasi->status_registrasi == 'pending') {
            $riwayat_registrasi->update([
                'status_registrasi' => 'verified'
            ]);
        } else if ($riwayat_registrasi->status_registrasi == 'verified') {
            $riwayat_registrasi->update([
                'status_registrasi' => 'pending'
            ]);
        }

        return back()->with('message', 'Status Berhasil diperbarui');
    }
}
