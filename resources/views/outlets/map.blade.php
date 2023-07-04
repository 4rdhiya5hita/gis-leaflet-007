@extends('layouts.app')

@section('content')
<!-- <div class="card"> -->
    <div class="card-body" id="mapid"></div>
<!-- </div> -->
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css" integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ==" crossorigin="" />
	<script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js" integrity="sha512-WXoSHqw/t26DszhdMhOXOkI7qCiv5QWXhH9R7CgvgZMHz1ImlkVQ3uNsiQKu5wwbbxtPzFXd1hK4tzno2VqhpA==" crossorigin=""></script>
	
	<link rel="stylesheet" href="{{ secure_asset('/leaflet/dist/MarkerCluster.css') }}" />
	<link rel="stylesheet" href="{{ secure_asset('/leaflet/dist/MarkerCluster.Default.css') }}" />
	<script src="{{ secure_asset('/leaflet/dist/leaflet.markercluster-src.js') }}"></script>
	<!-- <script src="realworld.388.js"></script> -->
<script src="{{ secure_asset('js/app.js') }}"></script>

<style>
    #mapid { padding: 20px; margin-top: 20px; height: 530px; width: 100%; border: 5px solid white; border-radius: 10px; }
</style>
@endsection
@push('scripts')
<!-- Make sure you put this AFTER Leaflet's CSS -->
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>

<script>    
    var map = L.map('mapid').setView([-8.678791949849, 115.22091865539], 14);
    var baseUrl = "{{ url('/map_sekolah_cluster') }}";

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // marker png
    var mySchool = L.icon({
        iconUrl: 'img/marker-school.png',
        iconSize: [45, 45],
    }); 

    var myPoint = L.icon({
        iconUrl: 'img/marker-black.png',
        iconSize: [45, 45],
    });

    var markers = L.markerClusterGroup();
    
    axios.get('{{ route('api.outlets.index') }}')
    .then(function (response) {
        console.log(response.data);

        response.data.features.forEach(function(feature) {
            var marker = L.marker(L.latLng(feature.geometry.coordinates[1], feature.geometry.coordinates[0]), {
                icon: mySchool,
                draggable: false
            }).bindPopup(feature.properties.map_popup_content);
            markers.addLayer(marker);
        });

        map.addLayer(markers);
    })
    .catch(function (error) {
        console.log(error);
    });
   
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
