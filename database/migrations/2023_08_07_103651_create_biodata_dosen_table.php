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
        Schema::create('biodata_dosen', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->unique();
            $table->string('gambar')->nullable();
            $table->string('nik')->nullable();
            $table->string('email')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('progam_studi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_dosen');
    }
};
