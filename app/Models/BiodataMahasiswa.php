<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'biodata_mahasiswa';
    protected $guarded = [];
    public function jurusan()
    {
        return $this->hasOne(Jurusan::class, 'kode_jurusan', 'program_studi');
    }
}
