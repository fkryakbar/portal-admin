<?php

namespace App\Imports;

use App\Models\BiodataMahasiswa;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class MahasiswaImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $checkUserIsExist = User::where('username', $row['username'])->where('role', 'mahasiswa')->first();

            if ($checkUserIsExist) {
                throw ValidationException::withMessages([
                    'username' => 'Username (' . $checkUserIsExist->name . ' - ' . $checkUserIsExist->username . ') already exists'
                ]);
            }

            $user =  User::create([
                'name' => $row['name'],
                'username' => $row['username'],
                'role' => 'mahasiswa',
                'password_reset' => Str::random(10),
            ]);

            BiodataMahasiswa::create([
                'user_id' => $user->id,
                'angkatan' => $row['angkatan'],
                'program_studi' => $row['program_studi']
            ]);
        }
    }
}
