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
                                <button id="toggleButtonGuru" class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="toggleCollapse()">
                                    Data Guru
                                </button>
                                <button id="toggleButtonSiswa" class="btn btn-primary mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" onclick="toggleCollapse()">
                                    Data Siswa
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm" style="margin: 0;">
                                <tbody>
                                    <tr>
                                        <td>{{ __('outlet.name') }}</td>
                                        <td>{{ $outlet->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.address') }}</td>
                                        <td>{{ $outlet->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.akreditas') }}</td>
                                        <td>{{ $outlet->akreditas }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.jenjang') }}</td>
                                        <td>{{ $jenjang->jenjang }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.jumlah_siswa') }}</td>
                                        <td>#</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.jumlah_guru') }}</td>
                                        <td>#</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.latitude') }}</td>
                                        <td>{{ $outlet->latitude }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('outlet.longitude') }}</td>
                                        <td>{{ $outlet->longitude }}</td>
                                    </tr>
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
                                                        @if(count($guru) == 0)
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Sekolah ini belum memiliki Data Guru </b></td>
                                                            </tr>
                                                        </thead>
                                                        @else
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Status </b></td>
                                                                <td class="text-center"><b> Jumlah </b></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countPNS = count($guru->where('status', 'PNS'));
                                                            $countHonor = count($guru->where('status', 'Honor'));
                                                            @endphp
                                                            <tr>
                                                                <td><b>Total</b></td>
                                                                <td class="text-center">{{ $countPNS + $countHonor }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>PNS</td>
                                                                <td class="text-center">{{ $countPNS }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Honor</td>
                                                                <td class="text-center">{{ $countHonor }}</td>
                                                            </tr>
                                                        </tbody>
                                                        @endif
                                                    </table>
                                                </div>
                                                <div id="menu1" class="tab-pane fade">
                                                    <table class="table table-sm" border="1" bordercolor="#CCCCCC">
                                                        @if(count($guru) == 0)
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Sekolah ini belum memiliki Data Guru </b></td>
                                                            </tr>
                                                        </thead>
                                                        @else
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b>I</b></td>
                                                                <td class="text-center"><b>II</b></td>
                                                                <td class="text-center"><b>III</b></td>
                                                                <td class="text-center"><b>IV</b></td>
                                                                <td class="text-center"><b>Jumlah</b></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countGol_I = count($guru->where('golongan', 'I'));
                                                            $countGol_II = count($guru->where('golongan', 'II'));
                                                            $countGol_III = count($guru->where('golongan', 'III'));
                                                            $countGol_IV = count($guru->where('golongan', 'IV'));
                                                            @endphp
                                                            <tr class="text-center">
                                                                <td>{{ $countGol_I }}</td>
                                                                <td>{{ $countGol_II }}</td>
                                                                <td>{{ $countGol_III }}</td>
                                                                <td>{{ $countGol_IV }}</td>
                                                                <td><b>{{ $countGol_I + $countGol_II + $countGol_III + $countGol_IV }}</b</td>
                                                            </tr>
                                                        </tbody>
                                                        @endif
                                                    </table>
                                                </div>

                                                <div id="menu2" class="tab-pane fade">
                                                    <table class="table table-sm" border="1" bordercolor="#CCCCCC">
                                                        @if(count($guru) == 0)
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Sekolah ini belum memiliki Data Guru </b></td>
                                                            </tr>
                                                        </thead>
                                                        @else
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Sertifikasi </b></td>
                                                                <td class="text-center"><b> Belum Sertifikasi </b></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countSertifikasi = count($guru->where('sertifikasi', 'sertifikasi'));
                                                            $countBelumSertifikasi = count($guru->where('sertifikasi', 'belum sertifikasi'));
                                                            @endphp
                                                            <tr>
                                                                <td><b>Total</b></td>
                                                                <td class="text-center">{{ $countSertifikasi + $countBelumSertifikasi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Sertifikasi</td>
                                                                <td class="text-center">{{ $countSertifikasi }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Belum Sertifikasi</td>
                                                                <td class="text-center">{{ $countBelumSertifikasi }}</td>
                                                            </tr>
                                                        </tbody>
                                                        @endif
                                                    </table>
                                                </div>

                                                <div id="menu3" class="tab-pane fade">
                                                    <table class="table table-sm" border="1" bordercolor="#CCCCCC">
                                                        @if(count($guru) == 0)
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Sekolah ini belum memiliki Data Guru </b></td>
                                                            </tr>
                                                        </thead>
                                                        @else
                                                        <thead>
                                                            <tr>
                                                                <td class="text-center"><b> Perempuan </b></td>
                                                                <td class="text-center"><b> Laki-laki </b></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                            $countPerempuan = count($guru->where('jenis_kelamin', 'P'));
                                                            $countLaki = count($guru->where('jenis_kelamin', 'L'));
                                                            @endphp
                                                            <tr>
                                                                <td><b>Total</b></td>
                                                                <td class="text-center">{{ $countPerempuan+$countLaki }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Perempuan</td>
                                                                <td class="text-center">{{ $countPerempuan }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Laki-laki</td>
                                                                <td class="text-center">{{ $countLaki }}</td>
                                                            </tr>
                                                        </tbody>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="divSiswa" class="container collapse">
                                            <h1>Data Siswa</h1>
                                            <table id="siswa-table" class="table table-sm" style="margin: 0;">
                                                @if(count($cek) == 0)
                                                <thead>
                                                    <tr>
                                                        <td class="text-center"><b> Sekolah ini belum memiliki Data Siswa </b></td>
                                                    </tr>
                                                </thead>
                                                @else
                                                <thead>
                                                    <tr>
                                                        <td>Pilih Tahun</td>
                                                        <td>
                                                            <select id="tahun" class="form-control form-control-lg">
                                                                @foreach($tahun as $val)
                                                                <option value="{{ $val }}">{{ $val }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b> Kelas </b></td>
                                                        <td><b> Jumlah Perempuan </b></td>
                                                        <td><b> Jumlah Laki-laki </b></td>
                                                        <td><b> Total </b></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($siswa as $val)
                                                    <tr>
                                                        <td>{{ $val->kelas->kelas }}</td>
                                                        <td>{{ $val->jumlah_perempuan }}</td>
                                                        <td>{{ $val->jumlah_laki }}</td>
                                                        <td><b>{{ $val->jumlah_laki + $val->jumlah_perempuan }}</b></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                @endif
                                            </table>
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
                            <a href="#" id="#" class="btn btn-primary" disabled>{{ __('outlet.edit') }}</a>
                            <!-- <a href="{{ route('outlets.edit', $outlet) }}" id="edit-outlet-{{ $outlet->id }}" class="btn btn-primary" disabled>{{ __('outlet.edit') }}</a> -->
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
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />

    <style>
        #mapid {
            height: 200px;
        }

        #button {
            width: 100%;
        }
    </style>
    @endsection
    @push('scripts')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script>
        $(document).ready(function() {
            $("#toggleButtonGuru").click(function() {
                $("#divGuru").collapse('toggle');
            });
        });

        $(document).ready(function() {
            $("#toggleButtonSiswa").click(function() {
                $("#divSiswa").collapse('toggle');
            });
        });
    </script>

    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>

    <script>
        var map = L.map('mapid').setView([{{ $outlet->latitude }}, {{ $outlet->longitude }}], {{ config('leaflet.detail_zoom_level') }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([{{ $outlet->latitude }}, {{ $outlet->longitude }}]).addTo(map)
            .bindPopup('{!! $outlet->map_popup_content !!}');
    </script>

    <script>
        $(document).ready(function() {
            $('#tahun').on('change', function() {
                var tahun = $(this).val();
                $.ajax({
                    url: '/siswa/{{ $outlet->id }}/' + tahun,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        var html = '';
                        for (var i = 0; i < data.length; i++) {
                            html += '<tr>';
                            html += '<td>' + data[i].kelas.kelas + '</td>';
                            html += '<td>' + data[i].jumlah_perempuan + '</td>';
                            html += '<td>' + data[i].jumlah_laki + '</td>';
                            html += '<td><b>' + (parseInt(data[i].jumlah_laki) + parseInt(data[i].jumlah_perempuan)) + '</b></td>';
                            html += '<tr>';
                        }
                        $('#siswa-table tbody').html(html);
                    },
                });
            });
        });
    </script>
    @endpush