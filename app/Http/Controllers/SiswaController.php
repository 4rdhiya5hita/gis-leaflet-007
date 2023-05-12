<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function getSiswaTahun($tahun)
    {
        $siswaTahun = Siswa::where('school_id', $outlet->id)
                        ->where('tahun', $tahun)
                        ->orderBy('tahun', 'asc')
                        ->get();

        return response()->json($siswaTahun);
    }
}
