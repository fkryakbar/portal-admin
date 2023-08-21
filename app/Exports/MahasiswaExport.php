<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;

class MahasiswaExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $user = User::where('role', 'mahasiswa')->get(['username', 'name', 'password_reset']);
        $data = DB::table('users')
            ->join('biodata_mahasiswa', 'biodata_mahasiswa.user_id', '=', 'users.id')
            ->select('users.name', 'users.username', 'users.password_reset', 'biodata_mahasiswa.*') // Select columns you need
            ->get();
        return $data;
    }
}
