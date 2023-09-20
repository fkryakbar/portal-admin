<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresensiDosen extends Model
{
    use HasFactory;

    protected $table = 'presensi_dosen';


    public function dosen()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    protected $guarded = [];
}
