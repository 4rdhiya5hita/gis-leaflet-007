<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    // protected $table = "siswas";
    protected $fillable = [
        'school_id', 'kelas_id', 'jumlah_perempuan', 'jumlah_laki', 'tahun',
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

}


