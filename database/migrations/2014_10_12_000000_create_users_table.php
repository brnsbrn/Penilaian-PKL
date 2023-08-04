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
            $table->string('username');
            $table->string('password');
            $table->string('nama');
            $table->enum('peran', ['admin', 'sekolah', 'penilai']);
            $table->unsignedBigInteger('id_sekolah')->nullable(); // kolom baru untuk menyimpan id sekolah
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah')->onDelete('set null');
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
