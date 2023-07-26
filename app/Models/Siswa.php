<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa'; // Nama tabel di database

    protected $primaryKey = 'id_siswa'; // Nama primary key

    protected $fillable = [
        'id_sekolah',
        'nama_siswa',
        'divisi_pkl',
        'tanggal_mulai',
        'tanggal_berakhir',
    ]; // Kolom yang dapat diisi secara massal

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah', 'id_sekolah');
    }
}
