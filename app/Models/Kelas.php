<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function mata_kuliah()
    {
        return $this->hasOne(MataKuliah::class, 'kode', 'kode_mata_kuliah');
    }


    public function dosen()
    {
        return $this->belongsToMany(User::class, 'user_kelas');
    }
    public function mahasiswa()
    {
        return $this->belongsToMany(User::class, 'user_kelas');
    }

    public function tahun_ajaran()
    {
        return $this->hasOne(TahunAjaran::class, 'kode_tahun_ajaran', 'kode_tahun_ajaran');
    }
}
