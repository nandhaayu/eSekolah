<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
     use HasFactory;

    protected $fillable = ['nama'];

    // Relasi ke siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }

    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }
}
