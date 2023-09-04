<?php

namespace App\Imports;

use App\Models\KartuStudi;
use App\Models\MataKuliah;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HasilStudiImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $checkKHSExist = KartuStudi::where('username', $row['username'])->where('kode_mata_kuliah', $row['kode_mata_kuliah'])->first();
            $mata_kuliah = MataKuliah::where('kode', $row['kode_mata_kuliah'])->first();
            if ($checkKHSExist) {
                $angka = null;
                $huruf = null;
                $bobot = null;
                if ($row['tugas'] && $row['uts'] && $row['uas'] && $mata_kuliah) {
                    $angka = ((int)$row['tugas'] * 30 +  (int)$row['uts'] * 30 + (int)$row['uas'] * 40) / 100;
                    $angka = number_format($angka, 2);
                    $huruf = 'E';
                    $bobot = 0 * (int)$mata_kuliah->jumlah_sks;

                    if ($angka >= 85) {
                        $huruf = "A";
                        $bobot = 4 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 80) {
                        $huruf = 'A-';
                        $bobot = 3.75 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 75) {
                        $huruf = 'B+';
                        $bobot = 3.5 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 70) {
                        $huruf = 'B';
                        $bobot = 3 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 65) {
                        $huruf = 'B-';
                        $bobot = 2.70 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 60) {
                        $huruf = 'C+';
                        $bobot = 2.35 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 55) {
                        $huruf = 'C';
                        $bobot = 2 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 50) {
                        $huruf = 'D+';
                        $bobot = 1.50 * (int)$mata_kuliah->jumlah_sks;
                    } else if ($angka >= 40) {
                        $huruf = 'D';
                        $bobot = 1 * (int)$mata_kuliah->jumlah_sks;
                    }
                }

                $checkKHSExist->update([
                    'tugas' => $row['tugas'],
                    'uts' => $row['uts'],
                    'uas' => $row['uas'],
                    'angka' => $angka,
                    'bobot' => $bobot,
                    'huruf' => $huruf
                ]);
            }
        }
    }
}
