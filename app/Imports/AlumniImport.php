<?php

namespace App\Imports;

use App\Models\Alumni;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class AlumniImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {

            $checkIfAlumniExist = Alumni::where('nim', $row['nim'])
                ->orWhere('no_ijazah', $row['no_ijazah'])
                ->first();

            if ($checkIfAlumniExist) {
            } else {
                if ($row['no_ijazah'] && $row['nama'] && $row['nim'] && $row['ipk'] && $row['jenjang_pendidikan'] && $row['program_studi'] && $row['tanggal_lulus'])
                    Alumni::create([
                        'u_id' => Str::uuid()->toString(),
                        'no_ijazah' => $row['no_ijazah'],
                        'nama' => $row['nama'],
                        'nim' => $row['nim'],
                        'ipk' => $row['ipk'],
                        'jenjang_pendidikan' => $row['jenjang_pendidikan'],
                        'program_studi' => $row['program_studi'],
                        'tanggal_lulus' => $row['tanggal_lulus'],
                    ]);
            }
        }
    }
}
