<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_mahasiswa';
    protected $guarded = [];
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_mahasiswa');
    }
}
