<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;    
    protected $fillable = [
        'id', 'jabatan',
    ];

    public function jabatan(){
        return $this->belongsTo(Guru::class, 'id', 'jabatan_id');
    }
}
