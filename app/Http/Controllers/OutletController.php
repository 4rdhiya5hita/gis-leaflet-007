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

class OutletController extends Controller
{
    /**
     * Display a listing of the outlet.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('manage_outlet');

        // $outlets = Outlet::all();
        $outletQuery = Outlet::query();
        $outletQuery->where('name', 'like', '%' . request('q') . '%');
        $outlets = $outletQuery->paginate(25);
        // dd($outlets);

        return view('outlets.index', compact('outlets'));
    }

    /**
     * Show the form for creating a new outlet.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $this->authorize('create', new Outlet);
        $jenjangs = Jenjang::all();

        return view('outlets.create', compact('jenjangs'));
    }

    /**
     * Store a newly created outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->authorize('create', new Outlet);
        // $school = null;

        // if ($request->type == 'school') {
        //     $newSchool = $request->validate([
        //         'akreditas'    => 'required|max:20',
        //         'jumlah_siswa' => 'required|max:20',
        //         'jenjang'      => 'required|max:20',
        //     ]);

        //     School::create($newSchool);
        //     $school = DB::table('schools')->latest('id')->first();
        // }

        // if ($school) {
        //     $school_id = $school->id; // Access the 'id' column value from the retrieved record
        // }

        $newOutlet = $request->validate([
            'name'      => 'required|max:60',
            'alamat'    => 'nullable|max:255',
            'akreditas' => 'nullable|max:255',
            'jenjang'   => 'nullable|max:255',
            'image'     => 'nullable|image|max:2048',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);

        if ($request->file('image')) {
            $gambar = $request->file('image');
            $destinationPath = 'img';
            $filename = $gambar->getClientOriginalName();
            $gambar->move($destinationPath, $filename);
            $urlgambar = $filename;
        }

        // dd($urlgambar);

        $outlet = DB::table('outlets')->insert([
            'name'      => $newOutlet['name'],
            'alamat'    => $newOutlet['alamat'],
            'akreditas' => $newOutlet['akreditas'],
            'jenjang_id' => $newOutlet['jenjang'],
            'image'     => $urlgambar,
            'latitude'  => $newOutlet['latitude'],
            'longitude' => $newOutlet['longitude'],
            // Add more fields and their values as needed
        ]);


        // $newOutlet['creator_id'] = auth()->id();
        // $outlet = Outlet::create($newOutlet);

        return redirect()->route('outlet_map.cluster', $outlet);
        // return redirect()->route('outlets.show', $outlet);
    }

    /**
     * Display the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function show(Outlet $outlet)
    {
        $this->middleware('auth');
        // $school = $outlet->creator;
        // $schools = Outlet::find($outlet->id);
        $jenjang = Jenjang::find($outlet->jenjang_id);
        $image = Outlet::where('image', '=', $outlet->image)->first();

        $tahun = Siswa::where('school_id', '=', $outlet->id)
            ->orderBy('tahun', 'desc')
            ->distinct()
            ->pluck('tahun');

        $cek = DB::table('siswas')->where('school_id', '=', $outlet->id)->get();
        $total_siswa = 0;

        if (count($cek) > 0) {
            $siswa = Siswa::where('school_id', '=', $outlet->id)
                ->where('tahun', '=', $tahun[0])
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

        return view('outlets.show', compact('outlet', 'jenjang', 'image', 'siswa', 'tahun', 'guru', 'cek', 'count_guru', 'total_siswa'));
    }

    public function getSiswaTahun($outlet, $tahun)
    {
        $isAuthenticated = false;
        if (Auth::check()) {
            $isAuthenticated = true;
        }
        
        $siswaTahun = Siswa::where('school_id', $outlet)
            ->where('tahun', $tahun)
            ->with('kelas')
            ->orderBy('kelas_id', 'asc')
            ->get();

        return response()->json([
            'is_authenticated' => $isAuthenticated,
            'siswa' => $siswaTahun,
        ]);
    }

    public function getSekolah($outlet, $sekolah)
    {
        $isAuthenticated = false;
        if (Auth::check()) {
            $isAuthenticated = true;
        }

        $tahun = Siswa::where('school_id', '=', $sekolah)
            ->orderBy('tahun', 'desc')
            ->distinct()
            ->pluck('tahun');
        
        $getSiswa = Siswa::where('school_id', $sekolah)            
            ->with('kelas')
            ->where('tahun', $tahun[0])
            ->orderBy('kelas_id', 'asc')
            ->get();

        // if(!$getSiswa){
        //     $getSiswa = 'null';
        //     $tahun = 'x';
        // }

        $getGuru = DB::table('gurus')
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
            'siswa' => $getSiswa,
            'guru' => $getGuru,
            'tahun_value' => $tahun,
        ]);
    }

    /**
     * Show the form for editing the specified outlet.
     *
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\View\View
     */
    public function edit(Outlet $outlet)
    {
        $this->authorize('update', $outlet);
        $jenjangs = Jenjang::all();
        $akreditas = ['A', 'B', 'C', 'D', 'E'];
        $image = $outlet->image;

        return view('outlets.edit', compact('outlet', 'jenjangs', 'akreditas', 'image'));
    }

    /**
     * Update the specified outlet in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function update(Request $request, Outlet $outlet)
    {
        $this->authorize('update', $outlet);
        // dd($request);

        $request->validate([
            'name'      => 'required|max:100',
            'alamat'   => 'nullable|max:255',
            'image'         => 'nullable|image|max:2048',
            'akreditas'     => 'nullable|max:20',
            'jenjang'     => 'nullable|max:10',
            'latitude'      => 'nullable|required_with:latitude|max:15',
            'longitude'      => 'nullable|required_with:longitude|max:15',
        ]);

        // dd($request->image);
        // $path_edited = $request->image;
        // dd($path_edited);
        
        $outlet->name = $request->name;
        $outlet->alamat = $request->alamat;
        $outlet->akreditas = $request->akreditas;
        $outlet->jenjang_id = $request->jenjang;
        $outlet->latitude = $request->latitude;
        $outlet->longitude = $request->longitude;
        $outlet->save();

        return redirect()->route('outlets.show', $outlet);
    }

    /**
     * Remove the specified outlet from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Outlet $outlet)
    {
        $this->authorize('delete', $outlet);

        if ($outlet->id && $outlet->delete()) {
            Outlet::findOrFail($outlet)->delete();
            return redirect()->route('outlet_map.cluster', $outlet);
        }

        return redirect()->route('outlet_map.cluster', $outlet);
    }
}
