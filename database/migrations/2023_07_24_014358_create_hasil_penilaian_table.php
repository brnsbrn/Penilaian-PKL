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
        Schema::create('hasil_penilaian', function (Blueprint $table) {
            $table->id('id_hasil_penilaian');
            $table->unsignedBigInteger('id_user'); // kolom untuk menyimpan id penilai (karyawan perusahaan A)
            $table->unsignedBigInteger('id_siswa'); // kolom untuk menyimpan id siswa yang dinilai
            $table->unsignedBigInteger('id_form'); // kolom untuk menyimpan id form penilaian yang digunakan dalam penilaian
            $table->json('data_penilaian'); // kolom untuk menyimpan data hasil penilaian
            $table->string('komentar'); // kolom untuk menyimpan komentar yang diberikan oleh penilai
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');
            $table->foreign('id_form')->references('id_form')->on('form_penilaian')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_penilaian');
    }
};
