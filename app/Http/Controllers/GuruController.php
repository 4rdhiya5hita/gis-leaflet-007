<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jabatan;
use App\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function create($outlet)
    {
        $school = Outlet::find($outlet);        
        // $jabatans = Jabatan::whereNotIn('id', Guru::where('school_id', $outlet)->whereIn('status_aktif', ['aktif', 'tidak_aktif'])->pluck('jabatan_id')->toArray())
        // ->pluck('id')
        // ->toArray();
        $jabatans = DB::table('jabatans')
            ->whereNotIn('id', function ($query) use ($outlet) {
                $query->select('jabatan_id')
                      ->from('gurus')
                      ->where('school_id', $outlet)
                      ->whereIn('status_aktif', ['aktif', 'tidak_aktif']);
            })
            ->get();
        // dd($jabatans);
        $status_aktif = ['aktif', 'tidak aktif', 'pensiun', 'berhenti', 'pindah'];

        return view('guru.create', compact('jabatans', 'outlet', 'school', 'status_aktif'));
    }

    public function store(Request $request, $outlet)
    {
        $newGuru = $request->validate([
            'name'      => 'required|max:60',
            'nip'   => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'jenis_kelamin'   => 'nullable|max:255',
            'status'   => 'nullable|max:255',
            'golongan'   => 'nullable|max:255',
            'sertifikasi'   => 'nullable|max:255',
            'jabatan'   => 'nullable|max:255',
            'status_aktif'   => 'nullable|max:20',
            'masa_jabatan_awal'   => 'nullable|date',
            'masa_jabatan_akhir'   => 'nullable|date',
        ]);

        DB::table('gurus')->insert([
            'name' => $newGuru['name'],
            'nip' => $newGuru['nip'],
            'email' => $newGuru['email'],
            'jenis_kelamin' => $newGuru['jenis_kelamin'],
            'status' => $newGuru['status'],
            'golongan' => $newGuru['golongan'],
            'sertifikasi' => $newGuru['sertifikasi'],
            'jabatan_id' => $newGuru['jabatan'],
            'status_aktif' => $newGuru['status_aktif'],
            'masa_jabatan_awal' => $newGuru['masa_jabatan_awal'],
            'masa_jabatan_akhir' => $newGuru['masa_jabatan_akhir'],
            'school_id' => $outlet,
            // Add more fields and their values as needed
        ]);


        // $newGuru['creator_id'] = auth()->id();
        // $Guru = Guru::create($newGuru);

        // return redirect()->back();
        return redirect()->route('outlets.show', $outlet);
    }

    public function detail($outlet, $id) 
    {
        $guru = Guru::find($id);

        return view('guru.detail', compact('guru', 'outlet'));
    }

    public function edit($outlet, $id)
    {
        $school = Outlet::find($outlet);
        $guru = Guru::find($id);
        $jabatans = DB::table('jabatans')
            ->whereNotIn('id', function ($query) use ($outlet) {
                $query->select('jabatan_id')
                      ->from('gurus')
                      ->where('school_id', $outlet)
                      ->whereIn('status_aktif', ['aktif', 'tidak_aktif']);
            })
            ->get();

        $golongan = ['I', 'II', 'III', 'IV', 'V'];
        $status_aktif = ['aktif', 'tidak aktif', 'pensiun', 'berhenti', 'pindah'];
        // dd($guru);

        return view('guru.edit', compact('jabatans', 'outlet', 'school', 'guru', 'golongan', 'status_aktif'));
    }

    public function update(Request $request, $outlet, $id)
    {                
        $request->validate([
            'name'      => 'required|max:60',
            'nip'   => 'nullable|max:255',
            'email' => 'nullable|max:255',
            'jenis_kelamin'   => 'nullable|max:255',
            'status'   => 'nullable|max:255',
            'golongan'   => 'nullable|max:255',
            'sertifikasi'   => 'nullable|max:255',
            'jabatan'   => 'nullable|max:255',
            'status_aktif'   => 'nullable|max:20',
            'masa_jabatan_awal'   => 'nullable|date',
            'masa_jabatan_akhir'   => 'nullable|date',
        ]);

        $update_guru = Guru::find($id);
        $update_guru->name = $request->name;
        $update_guru->nip = $request->nip;
        $update_guru->email = $request->email;
        $update_guru->jenis_kelamin = $request->jenis_kelamin;
        $update_guru->status = $request->status;
        $update_guru->golongan = $request->golongan;
        $update_guru->sertifikasi = $request->sertifikasi;
        $update_guru->jabatan_id = $request->jabatan;
        $update_guru->status_aktif = $request->status_aktif;
        $update_guru->masa_jabatan_awal = $request->masa_jabatan_awal;
        $update_guru->masa_jabatan_akhir = $request->masa_jabatan_akhir;
        $update_guru->save();

        return redirect()->route('outlets.show', $outlet);
    }

    public function delete($outlet, $id)
    {
        Guru::find($id)->delete();
        return redirect()->route('outlets.show', $outlet);
    }
}
