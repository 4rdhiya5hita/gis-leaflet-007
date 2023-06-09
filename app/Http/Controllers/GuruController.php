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
        $jabatans = Jabatan::all();
        $school = Outlet::find($outlet);        
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
        ]);

        DB::table('gurus')->insert([
            'name'      => $newGuru['name'],
            'nip'    => $newGuru['nip'],
            'email' => $newGuru['email'],
            'jenis_kelamin' => $newGuru['jenis_kelamin'],
            'status' => $newGuru['status'],
            'golongan' => $newGuru['golongan'],
            'sertifikasi' => $newGuru['sertifikasi'],
            'jabatan_id' => $newGuru['jabatan'],
            'status_aktif' => $newGuru['status_aktif'],
            'school_id' => $outlet,
            // Add more fields and their values as needed
        ]);


        // $newGuru['creator_id'] = auth()->id();
        // $Guru = Guru::create($newGuru);

        // return redirect()->back();
        return redirect()->route('outlets.show', $outlet);
    }

    public function edit($outlet, $id)
    {
        $jabatans = Jabatan::all();
        $school = Outlet::find($outlet);
        $guru = Guru::find($id);
        $golongan = ['I', 'II', 'III', 'IV', 'V'];
        $status_aktif = ['aktif', 'tidak aktif', 'pensiun', 'berhenti', 'pindah'];
        // dd($guru);

        return view('guru.edit', compact('jabatans', 'outlet', 'school', 'guru', 'golongan','status_aktif'));
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
        $update_guru->save();

        return redirect()->route('outlets.show', $outlet);
    }

    public function delete($outlet, $id)
    {
        Guru::find($id)->delete();
        return redirect()->route('outlets.show', $outlet);
    }
}
