<?php

namespace App\Livewire\Kelas;

use App\Models\Kelas;
use App\Models\MataKuliah;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;


class ManageKelas extends Component
{
    #[Locked]
    public $kode_kelas;

    #[Validate('required|max:100')]
    public $nama;

    #[Validate('required')]
    public $kode_mata_kuliah;

    #[Validate('required')]
    public $kode_tahun_ajaran;

    #[Validate('required|max:30')]
    public $jadwal;

    #[Validate('required|max:30')]
    public $is_visible;

    #[Validate('required|max:30')]
    public $is_validated;

    public function update()
    {
        $this->validate();
        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->with([
            'tahun_ajaran',
            'mahasiswa' => function ($query) {
                $query->where('role', 'mahasiswa');
            },
            'dosen' => function ($query) {
                $query->where('role', 'dosen');
            }
        ])->firstOrFail();

        $kelas->update([
            'nama' => $this->nama,
            'jadwal' => $this->jadwal,
            'kode_mata_kuliah' => $this->kode_mata_kuliah,
            'kode_tahun_ajaran' => $this->kode_tahun_ajaran,
            'is_validated' => $this->is_validated,
            'is_visible' => $this->is_visible,
        ]);

        session()->flash('success', 'Kelas Berhasil diperbarui');
    }

    public function mount($kode_kelas)
    {
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->firstOrFail();
        $this->nama = $kelas->nama;
        $this->jadwal = $kelas->jadwal;
        $this->kode_mata_kuliah = $kelas->kode_mata_kuliah;
        $this->kode_tahun_ajaran = $kelas->kode_tahun_ajaran;
        $this->is_visible = $kelas->is_visible;
        $this->is_validated = $kelas->is_validated;
    }

    public $dosen_query = '';

    public $mahasiswa_query = '';


    public function attach_dosen($id)
    {
        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->firstOrFail();
        if (!$kelas->dosen->contains($id)) {
            $kelas->dosen()->attach([$id]);
        }
        // $this->dosen_query = '';
    }
    public function detach_dosen($id)
    {
        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->firstOrFail();
        $kelas->dosen()->detach([$id]);
    }

    public function attach_mahasiswa($id)
    {
        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->firstOrFail();
        if (!$kelas->mahasiswa->contains($id)) {
            $kelas->mahasiswa()->attach([$id]);
        }
        // $this->mahasiswa_query = '';
    }
    public function detach_mahasiswa($id)
    {
        $kelas = Kelas::where('kode_kelas', $this->kode_kelas)->firstOrFail();
        $kelas->mahasiswa()->detach([$id]);
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $kelas =  Kelas::where('kode_kelas', $this->kode_kelas)->with(['mata_kuliah', 'dosen', 'mahasiswa'])->firstOrFail();

        $mahasiswa_selected = User::where('role', 'mahasiswa')->whereHas('kelas', function ($query) {
            $query->where('kode_kelas', $this->kode_kelas);
        })->whereHas('kartu_studi', function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        })->with(['kartu_studi' => function ($query) use ($kelas) {
            $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
        }, 'kelas'])->get();
        // dd($mahasiswa_selected);
        $dosen_query = $this->dosen_query;
        $mahasiswa_query = $this->mahasiswa_query;

        $dosen = collect([]);
        $mahasiswa = collect([]);


        if (Str::length($this->dosen_query) >= 3) {
            $dosen = User::where('role', 'dosen')->where(function (Builder $query) use ($dosen_query) {
                $query->where('name', 'like', '%' . $dosen_query . '%')
                    ->orWhere('username', 'like', '%' . $dosen_query . '%');
            })->whereDoesntHave('kelas', function ($query) use ($kelas) {
                $query->where('kelas_id', $kelas->id);
            })->get();
        } else {
            $dosen = collect([]);
        }

        if (Str::length($this->mahasiswa_query) >= 3) {
            $mahasiswa = User::where('role', 'mahasiswa')->where(function (Builder $query) use ($mahasiswa_query) {
                $query->where('name', 'like', '%' . $mahasiswa_query . '%')
                    ->orWhere('username', 'like', '%' . $mahasiswa_query . '%');
            })->whereHas('kartu_studi', function ($query) use ($kelas) {
                $query->where('kode_mata_kuliah', $kelas->mata_kuliah->kode);
            })->whereDoesntHave('kelas', function ($query) use ($kelas) {
                $query->where('kelas_id', $kelas->id);
            })->get();
        } else {
            $mahasiswa = collect([]);
        }

        return view('kelas.manage-kelas', [
            'kelas' => $kelas,
            'mata_kuliah' => MataKuliah::orderBy('nama')->get(),
            'dosen' => $dosen,
            'mahasiswa' => $mahasiswa,
            'mahasiswa_selected' => $mahasiswa_selected
        ]);
    }
}
