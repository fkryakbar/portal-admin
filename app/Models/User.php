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
        }
        // return $query->when($this->role == 'dosen', function ($q) {
        // });
    }
    protected $guarded = [];
    protected $hidden = ['password', 'password_reset', 'is_reset_password'];
}
