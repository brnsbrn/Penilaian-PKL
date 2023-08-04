<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPenilaian extends Model
{
    use HasFactory;

    protected $table = 'hasil_penilaian';
    protected $primaryKey = 'id_hasil_penilaian';
    protected $fillable = [
        'id_user',
        'id_siswa',
        'id_form',
        'data_penilaian',
        'komentar',
    ];

    protected $casts = [
        'data_penilaian' => 'json',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    // Definisikan relasi HasilPenilaian dengan User (penilai)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function formPenilaian()
    {
        return $this->belongsTo(FormPenilaian::class, 'id_form');
    }
}
