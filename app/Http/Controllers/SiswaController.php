<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    
    public function create($outlet)
    {
        $school = Outlet::find($outlet);     
        $kelas = Kelas::where('jenjang_id', $school->jenjang_id)->get();
        $tahun_siswa = Siswa::where('school_id', $outlet)
        ->orderBy('tahun', 'desc')
        ->distinct()
        ->pluck('tahun');

        // $siswa = Siswa::where('school_id', $outlet)->get();
        $siswa = DB::table('kelas')
            ->leftJoin('siswas', 'kelas.id', '=', 'siswas.kelas_id')
            ->where('siswas.school_id', $outlet)
            ->get(['kelas.kelas AS kelas']);
        
        // dd($siswa);
        
        return view('siswa.create', compact('outlet', 'school', 'kelas', 'siswa', 'tahun_siswa'));
    }

    public function getSiswaKelas(Request $request)
    {
        $tahun = $request->input('tahun');
        $siswa = Siswa::where('tahun', $tahun)->get();

        return response()->json(['data' => $siswa]);
    }

    public function store(Request $request, $outlet)
    {
        $newSiswa = $request->validate([
            'kelas'      => 'required',
            'jumlah_laki'   => 'nullable|max:20',
            'jumlah_perempuan' => 'nullable|max:20',
            'tahun'   => 'required',
        ]);
        $kelas = Kelas::where('kelas', $request->kelas)->first();
        // dd($kelas->id);

        DB::table('siswas')->insert([
            'kelas_id'      => $kelas->id,
            'jumlah_laki'    => $newSiswa['jumlah_laki'],
            'jumlah_perempuan' => $newSiswa['jumlah_perempuan'],
            'tahun' => $newSiswa['tahun'],
            'school_id' => $outlet,
            // Add more fields and their values as needed
        ]);

        // $newSiswa['creator_id'] = auth()->id();
        // $Siswa = Siswa::create($newSiswa);

        // return redirect()->back();
        return redirect()->route('outlets.show', $outlet);
    }
        
    public function edit($outlet, $id)
    {
        $school = Outlet::find($outlet);
        $siswa = Siswa::find($id);
        return view('siswa.edit', compact('siswa', 'school', 'outlet'));
    }

    public function update(Request $request, $outlet, $id)
    {        
        $request->validate([
            'jumlah_laki'   => 'nullable|max:20',
            'jumlah_perempuan' => 'nullable|max:20',
        ]);

        $update_siswa = Siswa::find($id);
        $update_siswa->jumlah_laki = $request->jumlah_laki;
        $update_siswa->jumlah_perempuan = $request->jumlah_perempuan;
        $update_siswa->save();

        return redirect()->route('outlets.show', $outlet);
    }

    public function delete($outlet, $id)
    {
        Siswa::find($id)->delete();
        return redirect()->route('outlets.show', $outlet);
    }
    
}
