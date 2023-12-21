<?php

namespace App\Livewire\Kelas;

use App\Models\Kelas;
use App\Models\MataKuliah;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    #[Validate('required|max:30')]
    public $nama;

    #[Validate('required')]
    public $kode_mata_kuliah;

    #[Validate('required')]
    public $kode_tahun_ajaran;

    #[Validate('required|max:30')]
    public $jadwal;

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
        return view('kelas.index', [
            'mata_kuliah' => MataKuliah::all(),
            'kelas' => Kelas::latest()->with('tahun_ajaran')->get()->groupBy('tahun_ajaran.nama_tahun_ajaran')
        ]);
    }
}
