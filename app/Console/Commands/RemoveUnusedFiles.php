<?php

namespace App\Console\Commands;

use App\Models\BiodataDosen;
use App\Models\BiodataMahasiswa;
use App\Models\PresensiDosen;
use App\Models\RiwayatRegistrasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:remove-unused-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unused files from filesystem';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $localFiles = Storage::allFiles('');
        $localFiles = collect($localFiles);

        $biodataMahasiswa = BiodataMahasiswa::all()->pluck('gambar')->filter(function ($file) {
            return $file != null;
        });

        $biodataDosen = BiodataDosen::all()->pluck('gambar')->filter(function ($file) {
            return $file != null;
        });

        $presensiDosen = PresensiDosen::all()->pluck('image_path')->filter(function ($file) {
            return $file != null;
        });


        $riwayatRegistrasi = RiwayatRegistrasi::all()->pluck('file_bukti_path')->filter(function ($file) {
            return $file != null;
        });

        $databaseFiles = collect([]);

        $databaseFiles =  $databaseFiles->merge($biodataMahasiswa);
        $databaseFiles =  $databaseFiles->merge($biodataDosen);
        $databaseFiles =  $databaseFiles->merge($presensiDosen);
        $databaseFiles =  $databaseFiles->merge($riwayatRegistrasi);


        $unusedFiles =  $localFiles->diff($databaseFiles);

        $unusedFiles->each(function ($item) {
            Storage::disk('public')->delete($item);
        });
        $this->info($unusedFiles->count() . ' Unused files deleted');
    }
}
