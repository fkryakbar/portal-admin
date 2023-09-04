<?php

namespace App\Http\Controllers;

use App\Imports\MataKuliahImport;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matkul  = MataKuliah::latest()->paginate();
        return view('mata-kuliah.index', compact('matkul'));
    }

    public function tambah()
    {
        return view('mata-kuliah.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:matkul',
            'nama' => 'required|max:50',
            'jumlah_sks' => 'required|numeric|max:10',
            'semester' => 'required|numeric|max:20',
            'keterangan' => 'required|max:50',
            'jenis' => 'required|max:2',
        ]);

        MataKuliah::create($request->all());

        return back()->with('message', 'Mata Kuliah berhasil ditambah');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'mimes:xlsx,xls|required'
        ]);
        Excel::import(new MataKuliahImport, $request->file('excel'));
        return back()->with('message', 'Mata Kuliah Berhasil ditambah');
    }

    public function delete($kode)
    {
        $matkul = MataKuliah::where('kode', $kode)->firstOrFail();

        $matkul->delete();
        return back()->with('message', 'Mata kuliah berhasil dihapus');
    }

    public function edit($kode)
    {
        $matkul = MataKuliah::where('kode', $kode)->firstOrFail();
        return view('mata-kuliah.edit', compact('matkul'));
    }

    public function update($kode,  Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required|max:50',
            'jumlah_sks' => 'required|numeric|max:10',
            'semester' => 'required|numeric|max:20',
            'keterangan' => 'required|max:50',
            'jenis' => 'required|max:2',
        ]);
        $matkul = MataKuliah::where('kode', $kode)->firstOrFail();

        $matkul->update($request->all());

        return redirect('/mata-kuliah')->with('message', 'Mata Kuliah berhasil diperbarui');
    }
}
