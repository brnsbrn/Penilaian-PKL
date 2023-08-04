<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah'; // Nama tabel yang sesuai dengan tabel "schools"
    protected $primaryKey = 'id_sekolah'; // Nama kolom primary key pada tabel "schools"
    public $timestamps = true; // Apakah tabel "schools" memiliki kolom "created_at" dan "updated_at"

    protected $fillable = [
        'nama_sekolah',
    ];

    // Definisi relasi dengan model User
    public function users()
    {
        return $this->hasMany(User::class, 'id_sekolah');
    }
}
