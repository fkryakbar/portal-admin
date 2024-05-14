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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('u_id')->unique();
            $table->string('no_ijazah')->unique();
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('ipk');
            $table->string('jenjang_pendidikan');
            $table->string('program_studi');
            $table->date('tanggal_lulus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
