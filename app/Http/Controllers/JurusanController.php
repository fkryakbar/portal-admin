<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::latest()->paginate();
        return view('jurusan.index', compact('jurusan'));
    }

    public function tambah()
    {
        return view('jurusan.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|max:100',
            'kode_jurusan' => 'required|unique:jurusan',
        ]);

        Jurusan::create($request->all());

        return back()->with('message', 'Jurusan berhasil ditambahkan');
    }

    public function edit($kode_jurusan)
    {
        $jurusan = Jurusan::where('kode_jurusan', $kode_jurusan)->firstOrFail();
        return view('jurusan.edit', compact('jurusan'));
    }

    public function update($kode_jurusan,  Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|max:100',
            'kode_jurusan' => 'required|unique:jurusan',
        ]);
        $jurusan = Jurusan::where('kode_jurusan', $kode_jurusan)->firstOrFail();

        $jurusan->update($request->all());

        return redirect('/jurusan')->with('message', 'Jurusan berhasil diperbarui');
    }

    public function delete($kode_jurusan)
    {
        $jurusan = Jurusan::where('kode_jurusan', $kode_jurusan)->firstOrFail();
        $jurusan->delete();
        return redirect('/jurusan')->with('message', 'Jurusan berhasil dihapus');
    }
}
