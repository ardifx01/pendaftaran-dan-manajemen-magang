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
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['hadir','tidak_hadir','izin','sakit']);
            $table->text('keterangan')->nullable();
            $table->date('tanggal');
            $table->time('jam')->nullable();
            $table->string('hari');    
            $table->foreignID('mahasiswa_id')
            ->constrained('mahasiswa', 'nim_nisn')
            ->onDelete('cascade')->onUpdate('cascade')
            ->index('absensi_mahasiswa_nim_nisn_foreign')->unsigned();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
    }
};
