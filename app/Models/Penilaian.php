<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\User;

class Penilaian extends Model
{
    protected $table = 'penilaian';

    protected $primaryKey = 'id_penilaian';

    protected $fillable = [
        'user_id',
        'id_mahasiswa',
        'kedisiplinan',
        'kinerja_kerja',
        'kerapian',
        'kesopanan',
        'komentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa');
    }

    public function penilai()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
