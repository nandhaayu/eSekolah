<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'nip', 'kelas_id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    
}
