<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    public function biodataDosen()
    {
        return $this->hasOne(BiodataDosen::class);
    }

    public function biodata()
    {
        if ($this->role == 'dosen') {
            return $this->hasOne(BiodataDosen::class);
        } else if ($this->role == 'mahasiswa') {
            return $this->hasOne(BiodataMahasiswa::class);
        }
    }

    public function riwayat_registrasi()
    {
        return $this->hasOne(RiwayatRegistrasi::class, 'username', 'username');
    }

    public function presensi_dosen()
    {
        return $this->hasMany(PresensiDosen::class);
    }
    protected $guarded = [];
    protected $hidden = ['password', 'is_reset_password'];

    public function kartu_studi()
    {
        return $this->hasMany(KartuStudi::class, 'username', 'username');
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'user_kelas');
    }
}
