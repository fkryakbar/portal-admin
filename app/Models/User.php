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


    public function ipk()
    {
        if ($this->role == 'mahasiswa') {
            $khs = KartuStudi::where('username', $this->username)->with('mata_kuliah')->latest()->get();
            $ipk = number_format(0, 2);
            $total_bobot = 0;
            $total_sks = 0;
            if (count($khs) > 0) {
                foreach ($khs as $key => $k) {
                    if ($k->mata_kuliah) {
                        $total_sks += (float) $k->mata_kuliah->jumlah_sks;
                        $total_bobot += (float)$k->bobot;
                    }
                }
                $ipk = number_format($total_bobot / $total_sks, 2);
            }

            return $ipk;
        }
    }
}
