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
        // admin = pegawai
        Schema::create('admin', function (Blueprint $table) {
            $table->id('nip');
            $table->string('nama', 255);
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('image')->nullable(); 
            $table->foreignID('devisi_id')->nullable()->constrained('devisi', 'id')
            ->onUpdate('cascade')->onDelete('set null')
            ->index('admin_devisi_id_foreign')->unsigned();
            $table->timestamps();
      
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
        
    }
};
