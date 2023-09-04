<?php

namespace App\Imports;

use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MataKuliahImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $checkIfMatkulExists = MataKuliah::where('kode', $row['kode'])->first();
            if ($checkIfMatkulExists) {
                throw ValidationException::withMessages([
                    'kode' => 'Mata Kuliah dengan kode' . $checkIfMatkulExists->kode . 'sudah ada'
                ]);
            }

            MataKuliah::create([
                'kode' => $row['kode'],
                'nama' => $row['nama'],
                'jumlah_sks' => $row['jumlah_sks'],
                'semester' => $row['semester'],
                'keterangan' => $row['keterangan'],
                'jenis' => $row['jenis'],
            ]);
        }
    }
}
