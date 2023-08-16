<?php

namespace App\Http\Controllers;

use App\Models\BiodataDosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DosenController extends Controller
{
    private function get_file_name($name)
    {
        $array = explode('/', $name);
        return  $array[1];
    }
    public function index()
    {
        $dosen = User::where('role', 'dosen')->latest()->paginate();
        return view('dosen.index', [
            'dosen' => $dosen
        ]);
    }

    public function tambah()
    {
        return view('dosen.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users|max:100'
        ]);

        $request->merge([
            'role' => 'dosen',
            'password_reset' => Str::random(10)
        ]);

        $user = User::create($request->all());
        BiodataDosen::create(['user_id' => $user->id]);
        return back()->with('message', 'Dosen Berhasil ditambah');
    }

    public function edit($username)
    {
        $dosen = User::where('role', 'dosen')->where('username', $username)->firstOrFail();
        return view('dosen.edit', [
            'dosen' => $dosen
        ]);
    }

    public function update($username,  Request $request)
    {
        $dosen = User::where('role', 'dosen')->where('username', $username)->firstOrFail();

        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|max:100',
            'is_reset_password' => 'required',

            'gambar' => 'file|mimes:jpeg,png|max:100',
            'nik' => 'max:100',
            'email' => 'max:100',
            'no_telp' => 'max:30',
            'jenis_kelamin' => 'max:20',
            'tempat_lahir' => 'max:50',
            'tanggal_lahir' => 'max:15',
            'alamat' => 'max:300',
            'pendidikan_terakhir' => 'max:50',
            'progam_studi' => 'max:40'

        ]);

        $dosen->update($request->only(['name', 'username', 'is_reset_password']));

        $biodata = BiodataDosen::where('user_id', $dosen->id)->firstOrFail();

        if ($request->profile) {
            if ($biodata->gambar) {
                $path = $request->file('profile')->storeAs('/profile', $this->get_file_name($biodata->gambar));
                $request->merge(['gambar' =>  $biodata->gambar]);
            } else {
                $path = $request->file('profile')->store('/profile');
                $request->merge(['gambar' =>  $path]);
            }
        }


        $biodata->update($request->except(['profile', 'name', 'username', 'is_reset_password']));

        return back()->with('message', 'Biodata berhasil disimpan');
    }

    public function delete($username)
    {
        $user = User::where('username', $username)->where('role', 'dosen')->firstOrFail();

        $biodata = BiodataDosen::where('user_id', $user->id)->firstOrFail();

        if ($biodata->gambar) {
            Storage::delete($biodata->gambar);
        }

        $biodata->delete();
        $user->delete();

        return back()->with('message', 'Data Berhasil dihapus');
    }
}
