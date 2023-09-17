<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Models\PresensiDosen;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class PresensiDosenController extends Controller
{
    public function index(Request $request)
    {
        $dosen = User::where('role', 'dosen')->latest()->paginate();
        if ($request->search) {
            $searchQuery = $request->search;
            $dosen = User::where('role', 'dosen')->where(function (Builder $query) use ($searchQuery) {
                $query->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('username', 'like', '%' . $searchQuery . '%');
            })
                ->latest()
                ->paginate();
        }
        return view('presensi-dosen.index', [
            'dosen' => $dosen
        ]);
    }

    public function detail($username)
    {
        $dosen = User::where('username', $username)->where('role', 'dosen')->firstOrFail();
        $tahun_ajaran = TahunAjaran::limit(14)->latest()->get();

        return view('presensi-dosen.detail', [
            'dosen' => $dosen,
            'tahun_ajaran' => $tahun_ajaran
        ]);
    }

    public function edit($username, $kode_pertemuan)
    {
        $dosen = User::where('username', $username)->where('role', 'dosen')->firstOrFail();
        $presensi = PresensiDosen::where('user_id', $dosen->id)->where('kode_pertemuan', $kode_pertemuan)->firstOrFail();
        $mata_kuliah = MataKuliah::latest()->get();
        return view('presensi-dosen.edit', [
            'dosen' => $dosen,
            'presensi' => $presensi,
            'mata_kuliah' => $mata_kuliah
        ]);
    }

    public function api_get_presensi($username, $tahun_ajaran)
    {
        $dosen = User::where('username', $username)->where('role', 'dosen')->firstOrFail();
        $presensi = PresensiDosen::where('user_id', $dosen->id)->where('kode_tahun_ajaran', $tahun_ajaran)->latest()->get();

        return response([
            'message' => 'success',
            'data' => $presensi
        ]);
    }

    public function delete($kode_pertemuan)
    {
        $presensi = PresensiDosen::where('kode_pertemuan', $kode_pertemuan)->firstOrFail();
        Storage::delete($presensi->image_path);
        $presensi->delete();
        return back()->with('message', 'Presensi berhasil dihapus');
    }

    public function update($username, $kode_pertemuan,  Request $request)
    {
        $request->validate([
            'mata_kuliah' => 'required|max:50',
            'jumlah_sks' => 'required|numeric|max:10',
            'aktivitas' => 'required|max:500',
            'jumlah_mahasiswa' => 'required|numeric|max:300',
            'mahasiswa_tidak_hadir' => 'required|numeric|max:300',
            'detail_mahasiswa_tidak_hadir' => 'max:500',
            'waktu_perkuliahan' => 'max:30',

            'foto_perkuliahan' => 'file|mimes:jpeg,png|max:500',
        ]);

        $dosen = User::where('username', $username)->where('role', 'dosen')->firstOrFail();
        $presensi = PresensiDosen::where('user_id', $dosen->id)->where('kode_pertemuan', $kode_pertemuan)->firstOrFail();

        if ($request->foto_perkuliahan) {
            $request->file('foto_perkuliahan')->storeAs('/', $presensi->image_path);
        }

        $presensi->update($request->except(['foto_perkuliahan']));
        return back()->with('message', 'Data berhasil diperbarui');
    }
}
