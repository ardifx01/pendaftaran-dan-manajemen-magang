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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin', 'mahasiswa' , 'super']);
            $table->string('email')->unique();
            $table->string('name');
            $table->string('password');
            $table->rememberToken();
            $table->foreignID('mahasiswa_id')->nullable()
            ->references('nim_nisn')->on('mahasiswa')
            ->onDelete('cascade')->onUpdate('cascade')
            ->index('users_nahasiswa_nim_nisn_foreign');
            $table->foreignID('admin_id')->nullable()
            ->references('nip')->on('admin')
            ->onDelete('cascade')->onUpdate('cascade')
            ->index('users_admin_nip_foreign');
            $table->timestamps();
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

