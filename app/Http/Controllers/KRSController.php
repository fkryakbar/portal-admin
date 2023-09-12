<?php

namespace App\Http\Controllers;

use App\Imports\KRSImport;
use App\Models\KartuStudi;
use App\Models\MataKuliah;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

class KRSController extends Controller
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
        return view('krs.index', compact('mahasiswa'));
    }

    public function detail($username)
    {
        $tahun_ajaran = TahunAjaran::latest()->get();
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        return view('krs.detail', compact('tahun_ajaran', 'mahasiswa'));
    }

    public function tambah($username)
    {
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        $tahun_ajaran = TahunAjaran::latest()->get();
        $matkul = MataKuliah::latest()->get();
        return view('krs.tambah', compact('mahasiswa', 'tahun_ajaran', 'matkul'));
    }

    public function store(Request $request, $username)
    {
        $request->validate([
            'kode_mata_kuliah' => 'required',
            'tahun_ajaran' => 'required',
            'dosen_ampu' => 'max:40',
            'jadwal' => 'max:100',
        ]);

        $request->merge(['username' => $username]);

        KartuStudi::create($request->all());
        return back()->with('message', 'Kartu Studi berhasil ditambahkan');
    }


    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'mimes:xlsx,xls|required'
        ]);

        Excel::import(new KRSImport, $request->file('excel'));
        return back()->with('message', 'KRS Berhasil ditambahkan');
    }

    public function delete($id)
    {
        KartuStudi::find($id)->delete();
        return redirect('/krs')->with('message', 'Kartu Studi Berhasil Dihapus');
    }

    public function edit($username, $krs_id)
    {
        $tahun_ajaran = TahunAjaran::latest()->get();
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        $krs = KartuStudi::where('username', (int)$username)->where('id', $krs_id)->firstOrFail();
        $matkul = MataKuliah::latest()->get();
        return view('krs.edit', compact('tahun_ajaran', 'mahasiswa', 'krs', 'matkul'));
    }

    public function update($username, $krs_id, Request $request)
    {
        $mahasiswa = User::where('username', (int)$username)->firstOrFail();
        $krs = KartuStudi::where('username', (int)$username)->where('id', $krs_id)->firstOrFail();

        $request->validate([
            'kode_mata_kuliah' => 'required',
            'tahun_ajaran' => 'required',
            'dosen_ampu' => 'max:40',
            'jadwal' => 'max:100',
        ]);


        $krs->update($request->all());
        return back()->with('message', 'KRS Berhasil diperbarui');
    }

    public function api_get_krs($username, $tahun_ajaran)
    {
        $krs = KartuStudi::where('username', (int)$username)->where('tahun_ajaran', $tahun_ajaran)->with('mata_kuliah')->latest()->get();

        return response([
            'message' => 'Success',
            'data' => $krs
        ]);
    }
}
