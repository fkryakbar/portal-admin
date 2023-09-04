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
        Schema::create('kartu_studi', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('kode_mata_kuliah');
            $table->string('tahun_ajaran');
            $table->string('dosen_ampu')->nullable();
            $table->string('jadwal')->nullable();
            $table->string('tugas')->nullable();
            $table->string('uts')->nullable();
            $table->string('uas')->nullable();
            $table->string('angka')->nullable();
            $table->float('bobot')->nullable();
            $table->string('huruf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_studi');
    }
};
