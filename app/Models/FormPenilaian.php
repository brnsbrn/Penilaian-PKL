<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPenilaian extends Model
{
    use HasFactory;

    protected $table = 'form_penilaian';

    protected $primaryKey = 'id_form';

    protected $fillable = [
        'id_sekolah',
        'data_form',
    ];

    protected $casts = [
        'data_form' => 'json',
    ];

    // Relasi ke model Sekolah
    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class, 'id_sekolah');
    }
}
