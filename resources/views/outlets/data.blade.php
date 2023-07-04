@extends('layouts.app')

@section('title', __('outlet.list'))

@section('styles')
<script src="https://kit.fontawesome.com/32f82e1dca.js" crossorigin="anonymous"></script>
<style>
    .table-flow {
        margin-top: 20px;
        margin-bottom: 20px;
        max-height: 150px;
        /* Atur tinggi maksimal sesuai kebutuhan */
        border-bottom: solid black 0.5px;
        overflow: auto;
    }
</style>
@endsection

@section('content')
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height:100%; padding:10px;">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card" style="padding: 10px;">
                <div class="form-group">
                    <label class="control-label">{{ __('outlet.search') }}</label>
                    <select id="sekolah_data" class="form-control">
                        @foreach($sekolah as $val)
                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>        
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <table id="siswa-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <td>Pilih Tahun</td>
                            <td id='tahun-table'>
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
                            @if( Auth::check() )
                            <td><b>Action</b></td>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($siswa as $val)
                        <tr>
                            <td>{{ $val->kelas->kelas }}</td>
                            <td>{{ $val->jumlah_perempuan }}</td>
                            <td>{{ $val->jumlah_laki }}</td>
                            <td><b>{{ $val->jumlah_laki + $val->jumlah_perempuan }}</b></td>
                            @if( Auth::check() )
                            <td class="button_group">
                                <a class="btn btn-warning" href="{{ route('siswa.edit', [$outlet, $val->id]) }}">
                                    <i class=" fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        <tr>
                            <td><b>{{ __('outlet.jumlah_siswa') }}</b></td>
                            <td id="total-siswa"><b>{{ $total_siswa }}</b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table id="guru-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <td><b>Nama</b></td>
                            <td><b>Jabatan</b></td>
                            <td><b>NIP</b></td>
                            <td><b>Email</b></td>
                            <td><b>Jenis Kelamin</b></td>
                            <td><b>Status Guru</b></td>
                            <td><b>Golongan</b></td>
                            <td><b>Sertifikasi</b></td>
                            <td><b>Masa Jabatan Awal</b></td>
                            <td><b>Masa Jabatan Akhir</b></td>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guru as $val)
                        <tr>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->jabatan }}</td>
                            <td>{{ $val->nip }}</td>
                            <td>{{ $val->email }}</td>
                            <td>{{ $val->jenis_kelamin }}</td>
                            <td>{{ $val->status }}</td>
                            <td>{{ $val->golongan }}</td>
                            <td>{{ $val->sertifikasi }}</td>
                            <td>{{ $val->masa_jabatan_awal }}</td>
                            <td>{{ $val->masa_jabatan_akhir }}</td>
                            @if( Auth::check() )
                            <td class="button_group">
                                <a class="btn btn-warning" href="{{ route('guru.edit', [$outlet, $val->id]) }}">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach($guru as $val)
<div class="modal fade" id="detail-{{ $val->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel"><b>Detail Guru</b></h3>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-sm">
                    <tr>
                        <td><b>Nama Guru</b></td>
                        <td>{{ $val->name }}</td>
                    </tr>
                    <tr>
                        <td><b>Jabatan</b></td>
                        <td>{{ $val->jabatan }}</td>
                    </tr>
                    <tr>
                        <td><b>NIP</b></td>
                        <td>{{ $val->nip }}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>{{ $val->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Jenis Kelamin</b></td>
                        <td>{{ $val->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <td><b>Status</b></td>
                        <td>{{ $val->status }}</td>
                    </tr>
                    <tr>
                        <td><b>Golongan</b></td>
                        <td>{{ $val->golongan }}</td>
                    </tr>
                    <tr>
                        <td><b>Sertifikasi</b></td>
                        <td>{{ $val->sertifikasi }}</td>
                    </tr>
                    <tr>
                        <td><b>Masa Jabatan Awal</b></td>
                        <td>{{ $val->masa_jabatan_awal }}</td>
                    </tr>
                    <tr>
                        <td><b>Masa Jabatan Akhir</b></td>
                        <td>{{ $val->masa_jabatan_akhir }}</td>
                    </tr>
                    <tr>
                        <td><b>Status Keaktifan Guru</b></td>
                        <td>{{ $val->status_aktif }}</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#sekolah_data').on('change', function() {
            var sekolah_data = $(this).val();
            console.log(sekolah_data);

            $.ajax({
                url: 'data/{{ $outlet->id }}/' + sekolah_data,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var html_siswa = '';
                    var html_guru = '';
                    var html_tahun = '';
                    var total_siswa = 0;
                    var isAuthenticated = data.is_authenticated;
                    var siswa = data.siswa;
                    var guru = data.guru;
                    var tahun_value = data.tahun_value;

                    // console.log(data);
                    // console.log(siswa);
                    // console.log(guru);

                    for (var i = 0; i < siswa.length; i++) {
                        html_siswa += '<tr>';
                        html_siswa += '<td>' + siswa[i].kelas.kelas + '</td>';
                        html_siswa += '<td>' + siswa[i].jumlah_perempuan + '</td>';
                        html_siswa += '<td>' + siswa[i].jumlah_laki + '</td>';
                        html_siswa += '<td><b>' + (parseInt(siswa[i].jumlah_laki) + parseInt(siswa[i].jumlah_perempuan)) + '</b></td>';

                        if (isAuthenticated) { // Checking if the user is authenticated
                            html_siswa += '<td class="button_group">';
                            html_siswa += '<a class="btn btn-warning" href="/siswa_edit/{{ $outlet->id }}/' + siswa[i].id + '">';
                            html_siswa += '<i class="fa-solid fa-pen-to-square"></i>';
                            html_siswa += '</a>';
                            html_siswa += '</td>';
                        }
                        html_siswa += '</tr>';
                        
                        var total = parseInt(siswa[i].jumlah_laki) + parseInt(siswa[i].jumlah_perempuan);
                        total_siswa += total;
                    }

                    $('#total-siswa').text(total_siswa);
                    html_siswa += '</tr>';
                    html_siswa += '<tr>'
                    html_siswa += '<td><b>Jumlah Siswa</b></td>'
                    html_siswa += '<td id="total-siswa"><b>'+ total_siswa +'</b></td>'
                    html_siswa += '</tr>'

                    for (var i = 0; i < guru.length; i++) {
                        html_guru += '<tr>';
                        html_guru += '<td>' + guru[i].name + '</td>';
                        html_guru += '<td>' + guru[i].jabatan_id + '</td>';
                        html_guru += '<td>' + guru[i].nip + '</td>';
                        html_guru += '<td>' + guru[i].email + '</td>';
                        html_guru += '<td>' + guru[i].jenis_kelamin + '</td>';
                        html_guru += '<td>' + guru[i].status + '</td>';
                        html_guru += '<td>' + guru[i].golongan + '</td>';
                        html_guru += '<td>' + guru[i].sertifikasi + '</td>';
                        html_guru += '<td>' + guru[i].masa_jabatan_awal + '</td>';
                        html_guru += '<td>' + guru[i].masa_jabatan_akhir + '</td>';                     

                        if (isAuthenticated) { // Checking if the user is authenticated
                            html_guru += '<td class="button_group">';
                            html_guru += '<a class="btn btn-warning" href="/guru_edit/{{ $outlet->id }}/' + guru[i].id + '">';
                            html_guru += '<i class="fa-solid fa-pen-to-square"></i>';
                            html_guru += '</a>';
                            html_guru += '</td>';
                        }
                        html_guru += '</tr>';
                    }

                    html_tahun += '<select id="tahun" class="form-control form-control-lg">'
                    for (var i = 0; i < tahun_value.length; i++) {
                    html_tahun += '<option value="' + tahun_value[i] + '">' + tahun_value[i] + '</option>'
                    }
                    html_tahun += '</select>'
                    
                    $('#tahun-table select').html(html_tahun);
                    $('#siswa-table tbody').html(html_siswa);
                    $('#guru-table tbody').html(html_guru);
                },

            });
        });
    });

    // $('#tahun').on('change', function() {
    //     tahun_value = $(this).val();
    //     console.log(tahun_value);
    // });

    $('#sekolah_data').on('change', function() {
        sekolah_value = $(this).val();
        console.log(sekolah_value);
    });

    $(document).ready(function() {
        $('#tahun').on('change', function() {
            var tahun = $(this).val();
            console.log(sekolah_value)
            $.ajax({
                url: '/siswa/' + sekolah_value + '/' + tahun,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var html = '';
                    var total_siswa = 0;
                    var isAuthenticated = data.is_authenticated;
                    var siswa = data.siswa;
                    console.log(tahun)

                    for (var i = 0; i < siswa.length; i++) {
                        html += '<tr>';
                        html += '<td>' + siswa[i].kelas.kelas + '</td>';
                        html += '<td>' + siswa[i].jumlah_perempuan + '</td>';
                        html += '<td>' + siswa[i].jumlah_laki + '</td>';
                        html += '<td><b>' + (parseInt(siswa[i].jumlah_laki) + parseInt(siswa[i].jumlah_perempuan)) + '</b></td>';

                        if (isAuthenticated) { // Checking if the user is authenticated
                            html += '<td class="button_group">';
                            html += '<a class="btn btn-warning" href="/siswa_edit/{{ $outlet->id }}/' + siswa[i].id + '">';
                            html += '<i class="fa-solid fa-pen-to-square"></i>';
                            html += '</a>';
                            html += '</td>';
                        }

                        var total = parseInt(siswa[i].jumlah_laki) + parseInt(siswa[i].jumlah_perempuan);
                        total_siswa += total;
                    }

                    html += '</tr>';
                    html += '<tr>'
                    html += '<td><b>Jumlah Siswa</b></td>'
                    html += '<td id="total-siswa"><b>'+ total_siswa +'</b></td>'
                    html += '</tr>'
                    
                    $('#total-siswa').text(total_siswa);
                    $('#siswa-table tbody').html(html);
                },

            });
        });
    });
</script>
@endpush