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
        Schema::create('form_penilaian', function (Blueprint $table) {
            $table->id('id_form');
            $table->unsignedBigInteger('id_sekolah'); // kolom untuk menyimpan id sekolah
            $table->json('data_form'); // kolom untuk menyimpan data bentuk form penilaian
            $table->timestamps();

            $table->foreign('id_sekolah')->references('id_sekolah')->on('sekolah')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_penilaian');
    }
};
