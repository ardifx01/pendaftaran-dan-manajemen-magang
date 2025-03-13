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
        Schema::create('permintaan_magang', function (Blueprint $table) {
            $table->id('nim_nisn');
            $table->string('nama', 255);
            $table->string('email')->unique();
            $table->string('sekolah_univ');
            $table->string('jurusan');
            $table->text('alamat');
            $table->string('no_telp');
            $table->string('no_guru');
            $table->string('image')->nullable(); 
            $table->timestamp('tanggal_masuk');
            $table->timestamp('tanggal_keluar');
            $table->timestamps();
        
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_magang');
    }
};
