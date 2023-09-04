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
        Schema::create('riwayat_registrasi', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('kode_tahun_ajaran');
            $table->string('status_registrasi')->default('pending');
            $table->string('file_bukti_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_registrasi');
    }
};
