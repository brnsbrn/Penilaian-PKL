<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('mahasiswas')->insert([
            'nama_mahasiswa' => 'John Doe',
            'asal_instansi' => 'Instansi A',
            'divisi_pkl' => 'Divisi Teknologi Informasi',
            'no_telp' => '1234567890',
            'tanggal_mulai' => '2023-07-01',
            'tanggal_berakhir' => '2023-08-31',
        ]);
    }
}
