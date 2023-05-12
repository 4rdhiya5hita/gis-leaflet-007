@extends('layouts.app')

@section('title', __('outlet.detail'))

@section('content')
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height: fit-content; padding-top:10px;">

<div class="row justify-content-center">
    <div class="col-md-10 mb-3">
        <div class="card">
            <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">{{ __('outlet.detail') }}</div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6 p-2">
                            <div class="row px-5">
                                <img src="{{ secure_asset('img/'.$image->image) }}" alt="" style="width: 100%; height: 255px">
                            </div>
                            <div class="row px-5">
                                <button id="toggleButtonGuru" class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" 
                                    aria-expanded="false" aria-controls="collapseExample" onclick="toggleCollapse()">
                                    Data Guru
                                </button>
                                <button id="toggleButtonSiswa" class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" 
                                    aria-expanded="false" aria-controls="collapseExample" onclick="toggleCollapse()">
                                    Data Siswa
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm" style="margin: 0;">
                                <tbody>
                                        <tr><td>{{ __('outlet.name') }}</td><td>{{ $outlet->name }}</td></tr>
                                        <tr><td>{{ __('outlet.address') }}</td><td>{{ $outlet->alamat }}</td></tr>                        
                                        <tr><td>{{ __('outlet.akreditas') }}</td><td>{{ $outlet->akreditas }}</td></tr>
                                        <tr><td>{{ __('outlet.jenjang') }}</td><td>{{ $jenjang->jenjang }}</td></tr>
                                        <tr><td>{{ __('outlet.jumlah_siswa') }}</td><td>#</td></tr>
                                        <tr><td>{{ __('outlet.jumlah_guru') }}</td><td>#</td></tr>
                                        <tr><td>{{ __('outlet.latitude') }}</td><td>{{ $outlet->latitude }}</td></tr>
                                        <tr><td>{{ __('outlet.longitude') }}</td><td>{{ $outlet->longitude }}</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row mt-3 mb-5">
                        <table class="table table-sm" style="margin: 0;">
                            <tbody>
                                <tr>
                                    <td>
                                    <div id="divGuru" class="container collapse">
                                        <h1>Data Guru</h1>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#home">Status</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Golongan</a></li>
                                            <li><a data-toggle="tab" href="#menu2">Sertifikasi</a></li>
                                            <li><a data-toggle="tab" href="#menu3">Jenis Kelamin</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="home" class="tab-pane active">
                                                <table class="table table-sm" border="1" bordercolor="#CCCCCC">
                                                    <thead>
                                                        <tr><td class="text-center">Status</td><td class="text-center">Jumlah</td></tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr><td><b>Total</b></td><td>#</td></tr>
                                                        <tr><td>PNS</td><td>#</td></tr>
                                                        <tr><td>Honor</td><td>#</td></tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="menu1" class="tab-pane fade">
                                                <table class="table table-sm" border="1" bordercolor="#CCCCCC">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-center">I</td>
                                                            <td class="text-center">II</td>
                                                            <td class="text-center">III</td>
                                                            <td class="text-center">IV</td>
                                                            <td class="text-center">Jumlah</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><b></b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                            <h3>Menu 2</h3>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                            </div>
                                            <div id="menu3" class="tab-pane fade">
                                            <h3>Menu 3</h3>
                                            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    <div id="divSiswa" class="container collapse">
                                        <h1>Data Siswa</h1>
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                                            <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                                            <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                                            <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                                        </ul>

                                        <div class="tab-content">
                                            <div id="home" class="tab-pane active">
                                            <h3>HOME</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                            </div>
                                            <div id="menu1" class="tab-pane fade">
                                            <h3>Menu 1</h3>
                                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            </div>
                                            <div id="menu2" class="tab-pane fade">
                                            <h3>Menu 2</h3>
                                            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                            </div>
                                            <div id="menu3" class="tab-pane fade">
                                            <h3>Menu 3</h3>
                                            <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                            </div>
                                        </div>
                                    </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <!-- <div class="card-header">{{ trans('outlet.location') }}</div> -->
                        @if ($outlet->coordinate)
                            <div class="card-body" id="mapid"></div>
                            @else
                            <div class="card-body">{{ __('outlet.no_coordinate') }}</div>
                        @endif

                        @if( Auth::check() )
                        <div class="card-footer">
                            <a href="{{ route('outlets.edit', $outlet) }}" id="edit-outlet-{{ $outlet->id }}" class="btn btn-primary">{{ __('outlet.edit') }}</a>
                            <!-- <a href="{{ route('outlets.index') }}" class="btn btn-outline-primary">{{ __('outlet.back_to_index') }}</a> -->
                            <a href="{{ route('outlet_map.index') }}" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>
                        </div>
                        @endif
                    </div>
                </div>

        </div>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 200px; }

    #button{
        width: 100%;
    }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script>
    $(document).ready(function(){
        $("#toggleButtonGuru").click(function(){
            $("#divGuru").collapse('toggle');
        });
    });

    $(document).ready(function(){
        $("#toggleButtonSiswa").click(function(){
            $("#divSiswa").collapse('toggle');
        });
    });	
</script>

<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>
    var map = L.map('mapid').setView([{{ $outlet->latitude }}, {{ $outlet->longitude }}], {{ config('leaflet.detail_zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([{{ $outlet->latitude }}, {{ $outlet->longitude }}]).addTo(map)
        .bindPopup('{!! $outlet->map_popup_content !!}');
</script>
@endpush
