@extends('layouts.app')

@section('title', __('outlet.create'))

@section('content')
<!-- <p style="background-image: url('/img/background.png'); width:1200px; height:680px"> -->
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height:625px; padding-top:80px;">
  
<div class="container">
    <div class="card justify-content-center">
        <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">{{ __('outlet.create') }}</div>
        <form method="POST" action="{{ route('outlets.store') }}" accept-charset="UTF-8">
            {{ csrf_field() }}
            <div class="card-body">
                <div class="form-group">
                    <label for="name" class="control-label">{{ __('outlet.name') }}</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                    {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label for="address" class="control-label">{{ __('outlet.address') }}</label>
                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>
                    {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <div class="form-group">
                    <label for="type" class="control-label">{{ __('outlet.type') }}</label>                    
                    <select id="type" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type', request('type')) }}" required>
                        <option value="house">house</option>
                        <option value="store">store</option>
                        <option value="school">school</option>
                    </select>
                    {!! $errors->first('type', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>

                <!-- <div id="divElement" style="display:none;">Data Tambahan Sekolah -->
                    <div class="form-group">
                        <label for="akreditas" class="control-label">{{ __('outlet.akreditas') }}</label>
                        <input id="akreditas" type="text" class="form-control{{ $errors->has('akreditas') ? ' is-invalid' : '' }}" name="akreditas" value="{{ old('akreditas') }}" >
                    </div>
                    <div class="form-group">
                        <label for="jumlah_siswa" class="control-label">{{ __('outlet.jumlah_siswa') }}</label>
                        <input id="jumlah_siswa" type="text" class="form-control{{ $errors->has('jumlah_siswa') ? ' is-invalid' : '' }}" name="jumlah_siswa" value="{{ old('jumlah_siswa') }}" >
                    </div>
                    <div class="form-group">
                        <label for="jenjang" class="control-label">{{ __('outlet.jenjang') }}</label>
                        <select id="jenjang" type="text" class="form-control{{ $errors->has('jenjang') ? ' is-invalid' : '' }}" name="jenjang" value="{{ old('jenjang', request('jenjang')) }}" >
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                        </select>
                    </div>
                <!-- </div> -->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="latitude" class="control-label">{{ __('outlet.latitude') }}</label>
                            <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                            {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="longitude" class="control-label">{{ __('outlet.longitude') }}</label>
                            <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', request('longitude')) }}" required>
                            {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                </div>
                <!-- <div id="mapid"></div> -->
            </div>
            <div class="card-footer">
                <button type="submit" value="{{ __('outlet.create') }}" class="btn btn-success">Simpan Data</button>
                <a href="{{ route('outlet_map.index') }}" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>
                <!-- <a href="{{ route('outlets.index') }}" class="btn btn-link">{{ __('app.back_to_map') }}</a> -->
            </div>
        </form>
    </div>
</div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 300px; }

		.hidden {
			display: none;
		}
        #myCollapsible {
			transition: height 0.5s, opacity 0.5s;
		}
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script>
    // $(document).ready(function() {
    //     // Set initial visibility of the div element based on the selected value
    //     var selectedValue = $('#type').val();
    //     if (selectedValue === 'school') {
    //         $('#divElement').show();
    //     } else {
    //         $('#divElement').hide();
    //     }

    //     // Add event listener for dropdown menu change
    //     $('#type').on('change', function() {
    //         // Get the selected value
    //         var selectedValue = $(this).val();

    //         // Toggle visibility of the div element based on the selected value
    //         if (selectedValue === 'school') {
    //             $('#divElement').show();
    //         } else {
    //             $('#divElement').hide();
    //         }
    //     });
    // });

    var mapCenter = [{{ request('latitude', config('leaflet.map_center_latitude')) }}, {{ request('longitude', config('leaflet.map_center_longitude')) }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.zoom_level') }});

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker(mapCenter).addTo(map);
    function updateMarker(lat, lng) {
        marker
        .setLatLng([lat, lng])
        .bindPopup("Your location :  " + marker.getLatLng().toString())
        .openPopup();
        return false;
    };

    map.on('click', function(e) {
        let latitude = e.latlng.lat.toString().substring(0, 15);
        let longitude = e.latlng.lng.toString().substring(0, 15);
        $('#latitude').val(latitude);
        $('#longitude').val(longitude);
        updateMarker(latitude, longitude);
    });

    var updateMarkerByInputs = function() {
        return updateMarker( $('#latitude').val() , $('#longitude').val());
    }
    $('#latitude').on('input', updateMarkerByInputs);
    $('#longitude').on('input', updateMarkerByInputs);
</script>
@endpush
