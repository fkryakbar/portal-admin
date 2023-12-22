<?php

namespace App\Imports;

use App\Models\KartuStudi;
use App\Models\MataKuliah;
use App\Traits\KonversiNilai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HasilStudiImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */

    use KonversiNilai;

    public function collection(Collection $collection)
    {

        foreach ($collection as $row) {
            $checkKHSExist = KartuStudi::where('username', $row['username'])->where('kode_mata_kuliah', $row['kode_mata_kuliah'])->first();
            $mata_kuliah = MataKuliah::where('kode', $row['kode_mata_kuliah'])->first();
            if ($checkKHSExist) {

                $nilai = $this->konversi_nilai(0, 0, 0, $mata_kuliah->jumlah_sks);

                if ($row['tugas'] && $row['uts'] && $row['uas'] && $mata_kuliah) {
                    $nilai = $this->konversi_nilai($row['tugas'], $row['uts'], $row['uas'], $mata_kuliah->jumlah_sks);
                }

                $checkKHSExist->update([
                    'tugas' => $nilai->tugas,
                    'uts' => $nilai->uts,
                    'uas' => $nilai->uas,
                    'angka' => $nilai->angka,
                    'bobot' => $nilai->bobot,
                    'huruf' => $nilai->huruf
                ]);
            }
        }
    }
}
