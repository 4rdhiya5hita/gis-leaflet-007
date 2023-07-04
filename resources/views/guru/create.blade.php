@extends('layouts.app')

@section('title', __('outlet.create'))

@section('content')
<!-- <p style="background-image: url('/img/background.png'); width:1200px; height:680px"> -->
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height: fit-content;">  
    <div class="container" style="display: flex;justify-content: center;">
        <div class="col-md-10 mb-3">
            <div class="card justify-content-center">
                <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">Tambah Guru</div>
                <form method="POST" action="{{ route('guru.store', $outlet) }}" enctype="multipart/form-data" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="school" class="control-label">Sekolah</label>
                                    <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" name="school" value="{{ $school->name }}" required disabled>
                                    {!! $errors->first('school', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="jabatan" class="control-label">Jabatan</label>
                                    <select id="jabatan" type="text" class="form-control{{ $errors->has('jabatan') ? ' is-invalid' : '' }}" name="jabatan" value="{{ old('jabatan', request('jabatan')) }}" >
                                        @foreach($jabatans as $jabatan)
                                            <option value="{{ $jabatan->id }}">{{ $jabatan->jabatan }}</option>
                                        @endforeach
                                            <option value="6">Guru</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="control-label">Nama</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                                    {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="nip" class="control-label">NIP</label>
                                    <input id="nip" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ old('nip') }}" required>
                                    {!! $errors->first('nip', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                </div>

                                <!-- <div id="divElement" style="display:none;">Data Tambahan Sekolah -->
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" type="text" class="form-control{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" name="jenis_kelamin" value="{{ old('jenis_kelamin') }}" >
                                        <option value="L">L</option>
                                        <option value="P">P</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="control-label">Status</label>
                                    <select id="status" type="text" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ old('status') }}" >
                                        <option value="Honor">Honor</option>
                                        <option value="PNS">PNS</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sertifikasi" class="control-label">Sertifikasi</label>
                                    <select id="sertifikasi" type="text" class="form-control{{ $errors->has('sertifikasi') ? ' is-invalid' : '' }}" name="sertifikasi" value="{{ old('sertifikasi') }}" >
                                        <option value="sertifikasi">Sertifikasi</option>
                                        <option value="belum sertifikasi">Belum Sertifikasi</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="golongan" class="control-label">Golongan</label>
                                    <select id="golongan" type="text" class="form-control{{ $errors->has('golongan') ? ' is-invalid' : '' }}" name="golongan" value="{{ old('golongan') }}" >
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status_aktif" class="control-label">Status Aktif</label>
                                    <select id="status_aktif" type="text" class="form-control{{ $errors->has('status_aktif') ? ' is-invalid' : '' }}" name="status_aktif" value="{{ old('status_aktif') }}" >
                                        <option value="aktif">aktif</option>
                                        <option value="tidak aktif">tidak aktif</option>
                                        <option value="pensiun">pensiun</option>
                                        <option value="berhenti">berhenti</option>
                                        <option value="pindah">pindah</option>
                                    </select>
                                </div>
                                <!-- </div> -->

                                <div class="form-group">
                                    <label for="masa_jabatan_awal" class="control-label">Masa Jabatan Awal</label>
                                    <input id="masa_jabatan_awal" type="date" class="form-control{{ $errors->has('masa_jabatan_awal') ? ' is-invalid' : '' }}" name="masa_jabatan_awal" value="{{ old('masa_jabatan_awal') }}" required>
                                    {!! $errors->first('masa_jabatan_awal', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="masa_jabatan_akhir" class="control-label">Masa Jabatan Akhir</label>
                                    <input id="masa_jabatan_akhir" type="date" class="form-control{{ $errors->has('masa_jabatan_akhir') ? ' is-invalid' : '' }}" name="masa_jabatan_akhir" value="{{ old('masa_jabatan_akhir') }}" required>
                                    {!! $errors->first('masa_jabatan_akhir', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" value="{{ __('outlet.create') }}" class="btn btn-success">Simpan Data</button>
                        <a href="{{ route('outlets.show', $outlet) }}" class="btn btn-danger">{{ __('app.cancel') }}</a>
                        <a href="{{ route('outlet_map.index') }}" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>
                        <!-- <a href="{{ route('outlets.index') }}" class="btn btn-link">{{ __('app.back_to_map') }}</a> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection