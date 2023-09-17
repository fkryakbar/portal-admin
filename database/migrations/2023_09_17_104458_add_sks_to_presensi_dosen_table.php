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
        Schema::table('presensi_dosen', function (Blueprint $table) {
            $table->string('jumlah_sks')->nullable()->after('mata_kuliah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('presensi_dosen', function (Blueprint $table) {
            $table->dropColumn('jumlah_sks');
        });
    }
};
