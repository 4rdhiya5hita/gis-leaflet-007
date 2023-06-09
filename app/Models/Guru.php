<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'school_id', 'jabatan_id', 'nama', 'nip', 'email', 'jenis_kelamin', 'status', 'golongan', 'sertifikasi', 'masa_jabatan_awal', 'masa_jabatan_akhir',
    ];

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

}
