<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Mahasiswa;
use App\Models\Absensi;
use Carbon\Carbon;

class AutoCreateAbsensi extends Command
{
    protected $signature = 'absensi:auto-create';
    protected $description = 'Menciptakan absensi otomatis setelah pukul 16:00';

    public function handle()
    {
        $mahasiswas = Mahasiswa::all();

        foreach ($mahasiswas as $mahasiswa) {
            $this->createAutoAbsensi($mahasiswa);
        }

        $this->info('Penciptaan Absensi Otomatis berhasil.');
    }
   



    protected function createAutoAbsensi($mahasiswa)
{
    $today = Carbon::today();

    if (now() > $today->copy()->addHours(16)) {
        $absensiAda = Absensi::where([
            'mahasiswa_id' => $mahasiswa->nim_nisn,
            'tanggal' => $today,
        ])->first();

        if (!$absensiAda) {
            $newAbsensi = Absensi::create([
                'mahasiswa_id' => $mahasiswa->nim_nisn,
                'status' => 'tidak_hadir',
                'keterangan' => 'Tidak Hadir',
                'tanggal' => $today,
                'hari' => $today->isoFormat('dddd'),
            ]);

    
            $this->info("Absensi berhasil dibuat: Mahasiswa ID {$mahasiswa->nim_nisn}, Absensi ID {$newAbsensi->nim_nisn}");
        }
    }
}
    
}
