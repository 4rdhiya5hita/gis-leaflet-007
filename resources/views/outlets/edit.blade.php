@extends('layouts.app')

@section('title', __('outlet.edit'))

@section('content')
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height:675px; padding-top:10px;">

<div class="col-md">   
        <div class="container" style="display:flex; justify-content: center">
            @if (request('action') == 'delete' && $outlet)
                <div class="col-md-5">
                    <div class="card">
                    <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">{{ __('outlet.delete') }}</div>
                        <div class="card-body">
                            <label class="control-label text-primary">{{ __('outlet.name') }}</label>
                            <p>{{ $outlet->name }}</p>
                            <label class="control-label text-primary">{{ __('outlet.address') }}</label>
                            <p>{{ $outlet->address }}</p>
                            <label class="control-label text-primary">{{ __('outlet.type') }}</label>
                            <p>{{ $outlet->type }}</p>
                            @if ($outlet->type == 'school')
                                <label class="control-label text-primary">{{ __('outlet.akreditas') }}</label>
                                <p>{{ $school->akreditas }}</p>
                                <label class="control-label text-primary">{{ __('outlet.jumlah_siswa') }}</label>
                                <p>{{ $school->jumlah_siswa }}</p>
                                <label class="control-label text-primary">{{ __('outlet.jenjang') }}</label>
                                <p>{{ $school->jenjang }}</p>
                            @endif
                            <label class="control-label text-primary">{{ __('outlet.latitude') }}</label>
                            <p>{{ $outlet->latitude }}</p>
                            <label class="control-label text-primary">{{ __('outlet.longitude') }}</label>
                            <p>{{ $outlet->longitude }}</p>
                            {!! $errors->first('outlet_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <hr style="margin:0">
                        <div class="card-body text-danger">{{ __('outlet.delete_confirm') }}</div>
                        <div class="card-footer">
                            <form method="POST" action="{{ route('outlets.destroy', $outlet) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                                {{ csrf_field() }} {{ method_field('delete') }}
                                <input name="outlet_id" type="hidden" value="{{ $outlet->id }}">
                                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                            </form>
                            <a href="{{ route('outlets.edit', $outlet) }}" class="btn btn-outline-secondary">{{ __('app.cancel') }}</a>
                            <a href="{{ route('outlet_map.index') }}" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>
                        </div>
                    </div>
                </div>
            @else
            <div class="row">
                <div class="card">
                    <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">{{ __('outlet.edit') }}</div>
                    <form method="POST" action="{{ route('outlets.update', $outlet, $school) }}" accept-charset="UTF-8">
                        <div class="row">
                            {{ csrf_field() }} {{ method_field('patch') }}
                            <div class="col" style="width:100%; display:block;">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="control-label">{{ __('outlet.name') }}</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $outlet->name) }}" required>
                                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="control-label">{{ __('outlet.address') }}</label>
                                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address', $outlet->address) }}" required>
                                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="latitude" class="control-label">{{ __('outlet.latitude') }}</label>
                                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $outlet->latitude) }}" required>
                                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="longitude" class="control-label">{{ __('outlet.longitude') }}</label>
                                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $outlet->longitude) }}" required>
                                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type" class="control-label">{{ __('outlet.type') }}</label>                    
                                        <select id="type_selected" type="text" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" required>
                                            @foreach ($type as $key => $value)
                                                <option value="{{ $key }}" {{ ($key == $outlet->type) ? 'selected' : '' }}>
                                                    {{ $value }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('type', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                            </div>
                            
                            <div id="divElement" class="col">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="akreditas" class="control-label">{{ __('outlet.akreditas') }}</label>
                                        <input id="akreditas" type="text" class="form-control{{ $errors->has('akreditas') ? ' is-invalid' : '' }}" name="akreditas" placeholder="none" value="{{ $school->akreditas }}" required>
                                        {!! $errors->first('akreditas', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="jumlah_siswa" class="control-label">{{ __('outlet.jumlah_siswa') }}</label>
                                        <input id="jumlah_siswa" type="text" class="form-control{{ $errors->has('jumlah_siswa') ? ' is-invalid' : '' }}" name="jumlah_siswa" placeholder="none" value="{{ $school->jumlah_siswa }}" required>
                                        {!! $errors->first('jumlah_siswa', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="jenjang" class="control-label">{{ __('outlet.jenjang') }}</label>
                                        <input id="jenjang" type="text" class="form-control{{ $errors->has('jenjang') ? ' is-invalid' : '' }}" name="jenjang" placeholder="none" value="{{ $school->jenjang }}" required>
                                        {!! $errors->first('jenjang', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div id="mapid"></div>
                        <div class="card-footer">
                            <input type="submit" value="{{ __('outlet.update') }}" class="btn btn-warning">
                            <a href="{{ route('outlets.show', $outlet) }}" class="btn btn-outline-secondary">{{ __('app.detail') }}</a>
                            <a href="{{ route('outlet_map.index') }}" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>                            
                            <a href="{{ route('outlets.edit', [$outlet, 'action' => 'delete']) }}" id="del-outlet-{{ $outlet->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endif
@endsection

@section('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
    integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
    crossorigin=""/>

<style>
    #mapid { height: 150px; }
</style>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
    integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
    crossorigin=""></script>
<script>

    $(document).ready(function() {
        // Set initial visibility of the div element based on the selected value
        var selectedValue = $('#type_selected').val();
        // console.log(selectedValue);
        if (selectedValue === 'school') {
            $('#divElement').show();
        } else {
            $('#divElement').hide();
        }

        // Add event listener for dropdown menu change
        $('#type_selected').on('change', function() {
            
            var selectedValue = $(this).val();
            // console.log(selectedValue);
        
            // Toggle visibility of the div element based on the selected value
            if (selectedValue === 'school') {
                $('#divElement').show();
            } else {
                $('#divElement').hide();
            }
        });
    });


    var mapCenter = [{{ $outlet->latitude }}, {{ $outlet->longitude }}];
    var map = L.map('mapid').setView(mapCenter, {{ config('leaflet.detail_zoom_level') }});

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
