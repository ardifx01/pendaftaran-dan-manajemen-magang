<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurnal', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('hari');    
            $table->text('kegiatan');
            $table->foreignID('mahasiswa_id')
            ->references('nim_nisn')->on('mahasiswa')
            ->onDelete('cascade')->onUpdate('cascade')
            ->index('jurnal_mahasiswa_nim_nisn_foreign_id');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurnal');
    }
};
