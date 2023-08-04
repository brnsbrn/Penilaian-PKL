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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->unsignedBigInteger('id_sekolah'); // kolom untuk menyimpan id sekolah
            $table->string('nama_siswa');
            $table->string('divisi_pkl')->nullable(); // tambahkan kolom "divisi"
            $table->date('tanggal_mulai')->nullable(); // tambahkan kolom "tanggal_mulai"
            $table->date('tanggal_berakhir')->nullable(); // tambahkan kolom "tanggal_berakhir"
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
