@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js" integrity="sha512-WXoSHqw/t26DszhdMhOXOkI7qCiv5QWXhH9R7CgvgZMHz1ImlkVQ3uNsiQKu5wwbbxtPzFXd1hK4tzno2VqhpA==" crossorigin=""></script>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="{{ secure_asset('/leaflet/dist/MarkerCluster.css') }}" />
	<link rel="stylesheet" href="{{ secure_asset('/leaflet/dist/MarkerCluster.Default.css') }}" />
	<script src="{{ secure_asset('/leaflet/dist/leaflet.markercluster-src.js') }}"></script>
	<!-- <script src="realworld.388.js"></script> -->
    <style>
        #map {
            width: 1330px; 
            height: 550px; 
            border: 1px solid #ccc;
            align-items: center;
        }

        #progress {
            display: none;
            position: absolute;
            z-index: 1000;
            left: 400px;
            top: 300px;
            width: 200px;
            height: 20px;
            margin-top: -20px;
            margin-left: -100px;
            background-color: #fff;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 4px;
            padding: 2px;
        }

        #progress-bar {
            width: 0;
            height: 100%;
            background-color: #76A6FC;
            border-radius: 4px;
        }
    </style>
@endsection

@section('content')
    <div class="card-body" id="map"></div>
@endsection

@section('filter')
    <div class="square-button">
        <img src="{{ secure_asset('img/list-icon.png') }}" alt="User Avatar" class="img-circle mr-3" width="30" height="30">
        <a class="nav-link dropbtn" href="{{ route('outlet_map.cluster') }}">{{ __('menu.our_outlets') }}</a>
        <div class="dropdown-content">
            <a class="filter-sd">SD </a>
            <a class="filter-smp">SMP </a>
            <a class="filter-sma">SMA </a>
            <a class="filter-smk">SMK </a>
            <a class="filter-semua">Semua </a>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Points &copy 2012 LINZ'
    });
    
    var latlng = L.latLng(-8.667021779179, 115.23016470585);
    
    var map = L.map('map', {
        center: latlng,
        zoom: 13,
        layers: [tiles]
    });
    
    var myTK = L.icon({
        iconUrl: 'img/marker-house.png',
        iconSize: [45, 45],
    }); 
    var mySD = L.icon({
        iconUrl: 'img/marker-school-SD.png',
        iconSize: [45, 45],
    }); 
    var mySMP = L.icon({
        iconUrl: 'img/marker-school-SMP.png',
        iconSize: [45, 45],
    }); 
    var mySMA = L.icon({
        iconUrl: 'img/marker-school-SMA.png',
        iconSize: [45, 45],
    }); 
    var mySMK = L.icon({
        iconUrl: 'img/marker-school-SMK.png',
        iconSize: [45, 45],
    }); 
    
    var myPoint = L.icon({
        iconUrl: 'img/marker-black.png',
        iconSize: [45, 45],
    });

    var markers = L.markerClusterGroup();

    document.addEventListener('DOMContentLoaded', function() {
    // Menginisialisasi filter yang dipilih
    var selectedFilter = null;

    // Menambahkan fungsi klik pada elemen filter
    document.querySelector('.filter-sd').addEventListener('click', function() {
        selectedFilter = 'SD';
        filterMarkers(selectedFilter);
    });

    document.querySelector('.filter-smp').addEventListener('click', function() {
        selectedFilter = 'SMP';
        filterMarkers(selectedFilter);
    });

    document.querySelector('.filter-sma').addEventListener('click', function() {
        selectedFilter = 'SMA';
        filterMarkers(selectedFilter);
    });

    document.querySelector('.filter-smk').addEventListener('click', function() {
        selectedFilter = 'SMK';
        filterMarkers(selectedFilter);
    });

    document.querySelector('.filter-semua').addEventListener('click', function() {
        selectedFilter = 'semua';
        filterMarkers(selectedFilter);
    });

    // Fungsi untuk memfilter penanda berdasarkan filter yang dipilih
    function filterMarkers(selectedFilter) {
        markers.clearLayers(); // Menghapus semua penanda dari peta

        axios.get('{{ route('api.outlets.index') }}')
            .then(function(response) {
                // console.log(response.data);
                console.log(selectedFilter);

                response.data.features.forEach(function(feature) {
                    var icon;

                    if (feature.properties.jenjang_id == 2) {
                        icon = mySD;
                    } else if (feature.properties.jenjang_id == 3) {
                        icon = mySMP;
                    } else if (feature.properties.jenjang_id == 4) {
                        icon = mySMA;
                    } else if (feature.properties.jenjang_id == 5) {
                        icon = mySMK;
                    } else {
                        icon = myTK;
                    }

                    if (selectedFilter == 'SD' && feature.properties.jenjang_id == 2) {
                        var markerSD = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                            icon: icon,
                            draggable: false
                        }).bindPopup(feature.properties.map_popup_content);
                        markers.addLayer(markerSD);
                    } 
                    
                    if (selectedFilter == 'SMP' && feature.properties.jenjang_id == 3) {
                        var markerSMP = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                            icon: icon,
                            draggable: false
                        }).bindPopup(feature.properties.map_popup_content);
                        markers.addLayer(markerSMP);
                    } 
                    
                    if (selectedFilter == 'SMA' && feature.properties.jenjang_id == 4) {
                        var markerSMA = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                            icon: icon,
                            draggable: false
                        }).bindPopup(feature.properties.map_popup_content);
                        markers.addLayer(markerSMA);
                    } 
                    
                    if (selectedFilter == 'SMK' && feature.properties.jenjang_id == 5) {
                        var markerSMK = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                            icon: icon,
                            draggable: false
                        }).bindPopup(feature.properties.map_popup_content);
                        markers.addLayer(markerSMK);
                    } 
                    
                    if (selectedFilter == 'semua') { // Jika filter tidak dipilih, menampilkan semua penanda
                        var markerSEMUA = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                            icon: icon,
                            draggable: false
                        }).bindPopup(feature.properties.map_popup_content);
                        markers.addLayer(markerSEMUA);
                    } 

                    if (selectedFilter == null) { // menampilkan semua penanda
                        var markerNULL = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                            icon: icon,
                            draggable: false
                        }).bindPopup(feature.properties.map_popup_content);
                        markers.addLayer(markerNULL);
                    }
                });

                map.addLayer(markers);
            })
            .catch(function(error) {
                console.log(error);
            });
    }

    // Menjalankan fungsi filterMarkers() saat halaman pertama kali dimuat
    filterMarkers(selectedFilter);
});

    // var addressPoints = {!! json_encode($addressPoints) !!};
    
    // for (var i = 0; i < addressPoints.length; i++) {
    //     var a = addressPoints[i];
    //     var title = "Marker " + i; // Sesuaikan dengan judul marker yang sesuai
    //     var icon = mySchool; // Ganti dengan ikon yang sesuai
    //     var marker = L.marker(new L.LatLng(a.latitude, a.longitude), {
    //         title: title,
    //         icon: icon
    //     }).bindPopup(a.mapPopupContent); // Menggunakan a.mapPopupContent sebagai konten popup
    //     markers.addLayer(marker);
    // }
    
    // // Tambahkan cluster map
    // var cluster = L.markerClusterGroup();
    // cluster.addLayer(markers);
    // map.addLayer(cluster);

    // ada yg hilang disini (authorization)
    @can('create', new App\Outlet)

    var coordinates = [];
    @foreach($data as $row)
        var lat = {{ $row->latitude }};
        var lng = {{ $row->longitude }};
        var latlng = L.latLng(lat, lng);
        coordinates.push(latlng);
    @endforeach
    
    var theMarker;

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);

        if (theMarker != undefined) {
            map.removeLayer(theMarker);
        };

        var popupContent = `
            <div class="p-2">
                <div class="row">
                    <div class="cell merged">Latitude</div>
                </div>
                <div class="row mb-3">
                    <input type="text" class="form-control" name="latitude" value="${latitude}">
                </div>
                <div class="row">
                    <div class="cell merged">Longitude</div>
                </div>
                <div class="row">
                    <input type="text" class="form-control" name="longitude" value="${longitude}">
                </div>
            </div>
        `;

        popupContent += '<br><a class="btn btn-primary" style="color:white;" href="{{ route('outlets.create') }}?latitude=' + latitude + '&longitude=' + longitude + '">Tambah Data Lokasi</a>';


        // console.log(type);
        
        theMarker = L.marker([latitude, longitude],{icon: myPoint, draggable:true}).addTo(map);
        theMarker.bindPopup(popupContent)
        .openPopup();
    });
    // ada yg hilang disini (authorization)
    @endcan

</script>

@endpush
