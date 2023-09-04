<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class KartuStudi extends Model
{
    use HasFactory;
    protected $table = 'kartu_studi';
    protected $guarded = [];


    public function mata_kuliah(): HasOne
    {
        return $this->hasOne(MataKuliah::class, 'kode', 'kode_mata_kuliah');
    }
}
