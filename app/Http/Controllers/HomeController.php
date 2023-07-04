<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Outlet::all();
        // return view('outlets.map', compact('data'));

        $addressPoints = [];

        $outlets = Outlet::select('latitude', 'longitude')->get();

        foreach ($outlets as $outlet) {
            $addressPoints[] = [
                'latitude' => $outlet->latitude,
                'longitude' => $outlet->longitude,
            ];
        }

        return view('outlets.cluster', compact('addressPoints', 'data'));
    }
}
