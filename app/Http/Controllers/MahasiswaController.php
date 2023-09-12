<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use App\Models\BiodataMahasiswa;
use App\Models\Jurusan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
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
        return view('mahasiswa.index', [
            'mahasiswa' => $mahasiswa
        ]);
    }

    public function tambah()
    {
        return view('mahasiswa.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:100',
            'angkatan' => 'required|numeric|max:4000'
        ]);

        $request->merge([
            'role' => 'mahasiswa',
            'password_reset' => Str::random(10)
        ]);
        $user = User::create($request->except(['angkatan']));
        BiodataMahasiswa::create([
            'user_id' => $user->id,
            'angkatan' => $request->angkatan,
            'program_studi' => 'PAI'
        ]);
        return back()->with('message', 'Mahasiswa Berhasil ditambah');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel' => 'mimes:xlsx,xls|required'
        ]);

        Excel::import(new MahasiswaImport, $request->file('excel'));

        return back()->with('message', 'Mahasiswa Berhasil ditambah');
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    }

    public function delete($username)
    {
        $user = User::where('username', $username)->where('role', 'mahasiswa')->firstOrFail();
        $biodata = BiodataMahasiswa::where('user_id', $user->id)->firstOrFail();

        if ($biodata->gambar) {
            Storage::delete($biodata->gambar);
        }

        $biodata->delete();
        $user->delete();

        return back()->with('message', 'Data Berhasil dihapus');
    }


    public function edit($username)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->where('username', $username)->firstOrFail();
        $jurusan = Jurusan::latest()->get();
        return view('mahasiswa.edit', compact('mahasiswa', 'jurusan'));
    }

    public function update(Request $request, $username)
    {
        $mahasiswa = User::where('role', 'mahasiswa')->where('username', $username)->firstOrFail();
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'angkatan' => 'required|max:4000',
            'is_reset_password' => 'required',

            'gambar' => 'file|mimes:jpeg,png|max:100',
            'nik' => 'max:100',
            'email' => 'max:100',
            'no_telp' => 'max:30',
            'jenis_kelamin' => 'max:20',
            'tempat_lahir' => 'max:50',
            'tanggal_lahir' => 'max:15',
            'alamat' => 'max:300',
            'asal_sekolah' => 'max:50',
            'progam_studi' => 'max:40'
        ]);

        $mahasiswa->update($request->only(['name', 'username', 'is_reset_password']));

        $biodata = BiodataMahasiswa::where('user_id', $mahasiswa->id)->firstOrFail();
        if ($request->file('profile')) {
            if ($mahasiswa->biodata->gambar) {
                Storage::delete($mahasiswa->biodata->gambar);
                $path =  $request->file('profile')->store('/profile');
            } else {
                $path =  $request->file('profile')->store('/profile');
            }
            $request->merge(['gambar' => $path]);
        }
        $biodata->update($request->except(['profile', 'name', 'username', 'is_reset_password']));
        return back()->with('message', 'Biodata berhasil disimpan');
    }
}
