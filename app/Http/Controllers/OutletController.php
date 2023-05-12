<?php

namespace App\Http\Controllers;

use App\Jenjang;
use App\Models\Guru;
use App\Models\Siswa;
use App\Outlet;
use App\School;
use Illuminate\Http\Request;
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

        return view('outlets.create');
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
        $school = null;

        if ($request->type == 'school') {
            $newSchool = $request->validate([
                'akreditas'    => 'required|max:20',
                'jumlah_siswa' => 'required|max:20',
                'jenjang'      => 'required|max:20',
            ]);

            School::create($newSchool);
            $school = DB::table('schools')->latest('id')->first();
        }

        if ($school) {
            $school_id = $school->id; // Access the 'id' column value from the retrieved record
        }

        $newOutlet = $request->validate([
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
            'type'      => 'nullable|max:60',
        ]);

        $outlet = DB::table('outlets')->insert([
            'school_id' => $school_id,
            'name'      => $newOutlet['name'],
            'address'   => $newOutlet['address'],
            'latitude'  => $newOutlet['latitude'],
            'longitude' => $newOutlet['longitude'],
            'type'      => $newOutlet['type'],
            // Add more fields and their values as needed
        ]);


        // $newOutlet['creator_id'] = auth()->id();
        // $outlet = Outlet::create($newOutlet);

        return redirect()->route('outlet_map.index', $outlet);
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

        $tahun = Siswa::where('school_id', $outlet->id)
            ->orderBy('tahun', 'desc')
            ->distinct()
            ->pluck('tahun');

        $cek = DB::table('siswas')->where('school_id', $outlet->id)->get();
        // dd($cek);

        if(count($cek) > 0){
            $siswa = Siswa::where('school_id', $outlet->id)
                ->where('tahun', $tahun)
                ->get();
            // $coba = Siswa::class();
            // dd($siswa);
        }else{
            $siswa = "kosong";
        }

        $guru = DB::table('gurus')->where('school_id', $outlet->id)->get();
        // dd($guru);

        return view('outlets.show', compact('outlet', 'jenjang', 'image', 'siswa', 'tahun', 'guru', 'cek'));
    }

    public function getSiswaTahun($outlet, $tahun)
    {
        $siswaTahun = Siswa::where('school_id', $outlet)
            ->where('tahun', $tahun)
            ->with('kelas')
            ->orderBy('tahun', 'asc')
            ->get();

        return response()->json($siswaTahun);
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
        $type = ['house' => 'House', 'school' => 'School', 'store' => 'Store'];

        $school = School::find($outlet->school_id);
        return view('outlets.edit', compact('outlet', 'school', 'type'));
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
        // dd($outlet->creator->id);
        if ($request->type == 'school') {
            $updateSchool = $request->validate([
                'akreditas'    => 'required|max:20',
                'jumlah_siswa' => 'required|max:20',
                'jenjang'      => 'required|max:20',
            ]);
            School::find($outlet->school_id)->update($updateSchool);

            // $data = School::find($outlet->creator->id);
            // dd($data);
            // // Update the fields with the new data
            // $data->akreditas = $request->input('akreditas');
            // $data->jumlah_siswa = $request->input('jumlah_siswa');
            // $data->jenjang = $request->input('jenjang');
            // $data->save();
            // $school = DB::table('schools')->latest('id')->first();
        } else {
            // $school_id = null;
            $school_id = $outlet->school_id;
            $outlet->update([
                'school_id' => null,
            ]);
            School::find($school_id)->delete();
        }

        $outletData = $request->validate([
            'name'      => 'required|max:60',
            'type'      => 'nullable|max:60',
            'address'   => 'nullable|max:255',
            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
            'type'      => 'nullable|max:60',
        ]);
        $outlet->update($outletData);



        return redirect()->route('outlets.show', $outlet);
    }

    /**
     * Remove the specified outlet from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Outlet  $outlet
     * @return \Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Outlet $outlet)
    {
        $this->authorize('delete', $outlet);

        $request->validate(['outlet_id' => 'required']);
        $school_id = $outlet->school_id;

        if ($request->get('outlet_id') == $outlet->id && $outlet->delete()) {
            School::find($school_id)->delete();
            return redirect()->route('outlet_map.index');
        }

        return back();
    }
}
