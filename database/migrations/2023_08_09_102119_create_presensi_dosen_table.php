<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('kode_pertemuan')->unique();
            $table->string('kode_tahun_ajaran');
            $table->string('mata_kuliah');
            $table->text('aktivitas');
            $table->string('jumlah_mahasiswa');
            $table->string('mahasiswa_tidak_hadir');
            $table->string('detail_mahasiswa_tidak_hadir')->nullable()->default('-');
            $table->string('waktu_perkuliahan'); //include tanggal dari jam sampai jam brp
            $table->string('image_path');
            $table->string('status')->default('Approved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_dosen');
    }
};
