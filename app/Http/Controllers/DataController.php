<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\Models\Guru;
use App\Models\Siswa;
use App\Outlet;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataController extends Controller
{
    public function index()
    {
        $sekolah = Outlet::all();
        // $sekolah = Outlet::pluck('id');
        // dd($sekolah);
        $outlet = Outlet::where('id', 1)->first();
        // dd($outlet);

        $jenjang = Jenjang::find($outlet->jenjang_id);
        $image = Outlet::where('image', '=', $outlet->image)->first();

        $tahun = Siswa::where('school_id', '=', $outlet->id)
            ->orderBy('tahun', 'desc')
            ->distinct()
            ->pluck('tahun');

        $cek = DB::table('siswas')->where('school_id', '=', $outlet->id)->get();
        $total_siswa = 0;

        if (count($cek) > 0) {
            $siswa = Siswa::where('school_id', $outlet->id)
                ->where('tahun', $tahun[0])
                ->get();
            // $coba = Siswa::class();
            // dd($siswa);
            foreach($siswa as $sis){
                $total = $sis->jumlah_laki + $sis->jumlah_perempuan;
                $total_siswa += $total;
            }
        } else {
            $siswa = "kosong";
        }

        $guru = DB::table('gurus')
            ->leftJoin('jabatans', 'gurus.jabatan_id', '=', 'jabatans.id')
            ->where('school_id', $outlet->id)
            ->where(function ($query) {
                $query->where('status_aktif', '=', 'aktif')
                    ->orWhere('status_aktif', '=', 'tidak aktif');
            })
            ->whereNull('deleted_at')
            ->get(['gurus.*', 'jabatans.jabatan AS jabatan']);
        // dd($guru);
        $count_guru = count($guru);

        // dd($sekolah);
        return view('outlets.data', compact('outlet', 'jenjang', 'image', 'siswa', 'tahun', 'sekolah', 'guru', 'cek', 'count_guru', 'total_siswa'));
    }

    public function getData($outlet, $sekolah)
    {
        $isAuthenticated = false;
        if (Auth::check()) {
            $isAuthenticated = true;
        }        

        $dataSiswa = Siswa::where('school_id', $sekolah)            
            ->with('kelas')
            ->orderBy('tahun', 'asc')
            ->get();

        $dataGuru = DB::table('gurus')
            ->leftJoin('jabatans', 'gurus.jabatan_id', '=', 'jabatans.id')
            ->where('school_id', $sekolah)
            ->where(function ($query) {
                $query->where('status_aktif', '=', 'aktif')
                    ->orWhere('status_aktif', '=', 'tidak aktif');
            })
            ->whereNull('deleted_at')
            ->get();

        return response()->json([
            'is_authenticated' => $isAuthenticated,
            'guru' => $dataGuru,
            'siswa' => $dataSiswa,
        ]);
    }
}
