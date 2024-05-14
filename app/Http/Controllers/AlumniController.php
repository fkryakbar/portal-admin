<?php

namespace App\Http\Controllers;

use App\Exports\AlumniExport;
use App\Imports\AlumniImport;
use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $alumni = Alumni::latest()->paginate();

        if ($request->search) {
            $alumni = Alumni::where('nama', 'like', "%{$request->search}%")
                ->orWhere('nim', 'like', "%{$request->search}%")
                ->orWhere('no_ijazah', 'like', "%{$request->search}%")
                ->paginate();
        }

        return view('alumni.index', compact('alumni'));
    }


    public function tambah()
    {
        return view('alumni.tambah');
    }


    public function store(Request $request)
    {
        $request->validate([
            'no_ijazah' => 'required|unique:alumni',
            'nama' => 'required',
            'nim' => 'required|unique:alumni',
            'jenjang_pendidikan' => 'required',
            'ipk' => 'required',
            'program_studi' => 'required',
            'tanggal_lulus' => 'required',
        ]);

        $request->mergeIfMissing([
            'u_id' => Str::uuid()->toString()
        ]);

        Alumni::create($request->all());

        return back()->with('message', 'Alumni Berhasil ditambahkan');
    }

    public function update(Request $request, $u_id)
    {
        $alumni = Alumni::where('u_id', $u_id)->firstOrFail();
        $request->validate([
            'no_ijazah' => 'required|unique:alumni,no_ijazah,' . $alumni->id,
            'nama' => 'required',
            'nim' => 'required|unique:alumni,nim,' . $alumni->id,
            'jenjang_pendidikan' => 'required',
            'ipk' => 'required',
            'program_studi' => 'required',
            'tanggal_lulus' => 'required',
        ]);

        $alumni->update($request->all());

        return redirect('/alumni')->with('message', 'Data berhasil disimpan');
    }

    public function edit($u_id)
    {
        $alumni = Alumni::where('u_id', $u_id)->firstOrFail();
        return view('alumni.edit', compact('alumni'));
    }


    public function delete($u_id)
    {
        $alumni = Alumni::where('u_id', $u_id)->firstOrFail();
        $alumni->delete();

        return back()->with('message', 'Alumni Berhasil dihapus');
    }


    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'mimes:xlsx,xls|required'
        ]);

        Excel::import(new AlumniImport, $request->file('excel'));
        return back()->with('message', 'Alumni Berhasil ditambah');
    }

    public function export()
    {
        return Excel::download(new AlumniExport, 'alumni.xlsx');
    }


    public function api_verif($u_id,  Request $request)
    {
        if ($request->hasHeader('access_key')) {
            if ($request->header('access_key') == 'israel_should_be_destroyed') {
                $alumni = Alumni::where('u_id', $u_id)->first();

                if ($alumni) {
                    return response([
                        'message' => 'Success',
                        'data' => $alumni
                    ]);
                }
                return response([
                    'message' => 'Not found'
                ], 404);
            }
        }

        return response([
            'message' => "You're not authorized"
        ], 401);
    }
}
