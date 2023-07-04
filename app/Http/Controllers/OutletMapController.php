<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;

class OutletMapController extends Controller
{
    /**
     * Show the outlet listing in LeafletJS map.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = Outlet::all();
        $addressPoints = [];

        $outlets = Outlet::select('latitude', 'longitude')->get();

        foreach ($outlets as $outlet) {
            $addressPoints[] = [
                'latitude' => $outlet->latitude,
                'longitude' => $outlet->longitude,
            ];
        }
        
        // return view('outlets.map', compact('data'));
        return view('outlets.cluster', compact('addressPoints', 'data'));
    }

    public function cluster()
    {
        $data = Outlet::all();
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
