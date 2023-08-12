<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    public function index()
    {
        $tahun_ajaran = TahunAjaran::latest()->get();

        return view('tahun-ajaran.index', [
            'tahun_ajaran' => $tahun_ajaran
        ]);
    }

    public function tambah()
    {
        return view('tahun-ajaran.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_tahun_ajaran' => 'required|max:99992|numeric',
            'nama_tahun_ajaran' => 'required|max:30',
        ], [
            'kode_tahun_ajaran.required' => 'Kode Wajib diisi',
            'nama_tahun_ajaran.required' => 'Nama Wajib diisi',
        ]);

        TahunAjaran::create($request->all());

        return redirect()->to('/tahun-ajaran')->with('message', 'Tahun Ajaran Baru berhasil ditambahkan');
    }

    public function edit($kode_tahun_ajaran)
    {
        $tahun_ajaran = TahunAjaran::where('kode_tahun_ajaran', $kode_tahun_ajaran)->firstOrFail();
        return view('tahun-ajaran.edit', [
            'tahun_ajaran' => $tahun_ajaran
        ]);
    }

    public function update(Request $request, $kode_tahun_ajaran)
    {
        $request->validate([
            'nama_tahun_ajaran' => 'required|max:30',
            'isi_krs' => 'required',
            'isi_nilai' => 'required'
        ], [
            'nama_tahun_ajaran.required' => 'Nama Wajib diisi',
            'isi_krs.required' => 'Pengaturan KRS Wajib diisi',
            'isi_nilai.required' => 'Pengaturan Nilai Wajib diisi',
        ]);

        TahunAjaran::where('kode_tahun_ajaran', $kode_tahun_ajaran)->firstOrFail()->update($request->except(['kode_tahun_ajaran']));
        return redirect()->to('/tahun-ajaran')->with('message', 'Tahun ajaran berhasil diubah');
    }

    public function delete($kode_tahun_ajaran)
    {
        TahunAjaran::where('kode_tahun_ajaran', $kode_tahun_ajaran)->firstOrFail()->delete();
        return back()->with('message', 'Tahun ajaran berhasil dihapus');
    }
}
