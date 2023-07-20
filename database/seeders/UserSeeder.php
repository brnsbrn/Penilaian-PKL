<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'no_telp' => '089588776655'
            ],
            [
                'name' => 'Karyawan',
                'email' => 'karyawan@example.com',
                'password' => Hash::make('password'),
                'role' => 'karyawan',
                'no_telp' => '081122334455'
            ],
            [
                'name' => 'Mahasiswa',
                'email' => 'mahasiswa@example.com',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa', 
                'no_telp' => '081234567890'  
            ]
        ]);
    }
}

