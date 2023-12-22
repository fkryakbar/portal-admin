<?php

namespace App\Traits;


class Nilai
{
    public $tugas;
    public $uts;
    public $uas;
    public $angka;
    public $bobot;
    public $huruf;


    public function __construct($tugas, $uts, $uas, $angka, $bobot, $huruf)
    {
        $this->tugas = $tugas;
        $this->uts = $uts;
        $this->uas = $uas;
        $this->angka = $angka;
        $this->bobot = $bobot;
        $this->huruf = $huruf;
    }
}

trait KonversiNilai
{
    public function konversi_nilai($tugas, $uts, $uas, $jumlah_sks)
    {

        $angka = ((float)$tugas * 30 +  (float)$uts * 30 + (float)$uas * 40) / 100;
        $angka = number_format($angka, 2);
        $huruf = 'E';
        $bobot = 0 * (float)$jumlah_sks;

        if ($angka >= 85) {
            $huruf = "A";
            $bobot = 4 * (float)$jumlah_sks;
        } else if ($angka >= 80) {
            $huruf = 'A-';
            $bobot = 3.75 * (float)$jumlah_sks;
        } else if ($angka >= 75) {
            $huruf = 'B+';
            $bobot = 3.5 * (float)$jumlah_sks;
        } else if ($angka >= 70) {
            $huruf = 'B';
            $bobot = 3 * (float)$jumlah_sks;
        } else if ($angka >= 65) {
            $huruf = 'B-';
            $bobot = 2.70 * (float)$jumlah_sks;
        } else if ($angka >= 60) {
            $huruf = 'C+';
            $bobot = 2.35 * (float)$jumlah_sks;
        } else if ($angka >= 55) {
            $huruf = 'C';
            $bobot = 2 * (float)$jumlah_sks;
        } else if ($angka >= 50) {
            $huruf = 'D+';
            $bobot = 1.50 * (float)$jumlah_sks;
        } else if ($angka >= 40) {
            $huruf = 'D';
            $bobot = 1 * (float)$jumlah_sks;
        }

        return new Nilai($tugas, $uts, $uas, $angka, $bobot, $huruf);
    }
}
