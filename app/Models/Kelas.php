<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    // protected $table = "kelas";
    protected $fillable = [
        'jenjang_id', 'kelas',
    ];

    public function siswa(){

        return $this->belongsTo(Siswa::class, 'id', 'kelas_id');
    }
}
