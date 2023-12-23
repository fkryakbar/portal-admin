<?php

namespace App\Livewire\Kelas;

use App\Models\Kelas;
use App\Models\MataKuliah;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class Index extends Component
{
    #[Validate('required|max:100')]
    public $nama;

    #[Validate('required')]
    public $kode_mata_kuliah;

    #[Validate('required')]
    public $kode_tahun_ajaran;

    #[Validate('required|max:30')]
    public $jadwal;


    public $search_kelas = '';
    public function create()
    {
        $this->validate();

        Kelas::create([
            'kode_kelas' => time(),
            'nama' => $this->nama,
            'kode_mata_kuliah' => $this->kode_mata_kuliah,
            'kode_tahun_ajaran' => $this->kode_tahun_ajaran,
            'jadwal' => $this->jadwal,
        ]);

        session()->flash('success', 'Kelas Berhasil dibuat');
        $this->reset('nama', 'kode_mata_kuliah', 'jadwal', 'kode_tahun_ajaran');
    }
    public function delete($kode_kelas)
    {
        $kelas = Kelas::where('kode_kelas', $kode_kelas)->firstOrFail();

        $kelas->dosen()->detach();
        $kelas->mahasiswa()->detach();

        $kelas->delete();

        session()->flash('success', 'Kelas Berhasil dihapus');
    }

    #[Layout('layouts.main')]
    public function render()
    {
        $search_kelas = $this->search_kelas;
        $kelas = Kelas::latest()->with('tahun_ajaran')->get()->groupBy('tahun_ajaran.nama_tahun_ajaran');
        if (Str::length($this->search_kelas) >= 3) {
            $kelas = Kelas::where(function (Builder $query) use ($search_kelas) {
                $query->where('nama', 'like', '%' . $search_kelas . '%')
                    ->orWhere('kode_mata_kuliah', 'like', '%' . $search_kelas . '%');
            })->latest()->with('tahun_ajaran')->get()->groupBy('tahun_ajaran.nama_tahun_ajaran');
        }
        return view('kelas.index', [
            'mata_kuliah' => MataKuliah::orderBy('nama')->get(),
            'kelas' => $kelas
        ]);
    }
}
