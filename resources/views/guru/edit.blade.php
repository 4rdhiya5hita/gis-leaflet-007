@extends('layouts.app')

@section('title', __('outlet.edit'))

@section('content')
<!-- <p style="background-image: url('/img/background.png'); width:1200px; height:680px"> -->
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height: fit-content;">
    <div class="container" style="display: flex;justify-content: center;">
        <div class="col-md-6">
            <div class="card justify-content-center">
                <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">Edit Guru</div>
                <form method="POST" action="{{ route('guru.update', [$outlet, $guru->id]) }}" enctype="multipart/form-data" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="school" class="control-label">Sekolah</label>
                            <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" name="school" value="{{ $school->name }}" required disabled>
                            {!! $errors->first('school', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="jabatan" class="control-label">Jabatan</label>
                            <select class="form-control" placeholder="Name" name="jabatan" id="jabatan" required>
                                @foreach($jabatans as $jabatan)
                                    <option value="{{ $jabatan->id }}" {{ $guru->jabatan_id === $jabatan->id ? 'selected' : '' }}>{{ $jabatan->jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name" class="control-label">Nama</label>
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $guru->name }}" required>
                            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="nip" class="control-label">NIP</label>
                            <input id="nip" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ $guru->nip }}" required>
                            {!! $errors->first('nip', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">Email</label>
                            <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $guru->email }}" required>
                            {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>

                        <!-- <div id="divElement" style="display:none;">Data Tambahan Sekolah -->
                        <div class="form-group">
                            <label for="jenis_kelamin" class="control-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="form-control" class="form-control">
                                @if($guru->jenis_kelamin == 'L')
                                <option value="{{ $guru->jenis_kelamin }}">{{ $guru->jenis_kelamin }}</option>
                                <option value="P">P</option>
                                @else
                                <option value="{{ $guru->jenis_kelamin }}">{{ $guru->jenis_kelamin }}</option>
                                <option value="L">L</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status" class="control-label">Status</label>
                            <select name="status" id="form-control" class="form-control">
                                @if($guru->status == 'Honor')
                                <option value="{{ $guru->status }}">{{ $guru->status }}</option>
                                <option value="PNS">PNS</option>
                                @else
                                <option value="{{ $guru->status }}">{{ $guru->status }}</option>
                                <option value="Honor">Honor</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sertifikasi" class="control-label">Sertifikasi</label>
                            <select name="sertifikasi" id="form-control" class="form-control">
                                @if($guru->sertifikasi == 'sertifikasi')
                                <option value="{{ $guru->sertifikasi }}">{{ $guru->sertifikasi }}</option>
                                <option value="belum sertifikasi">belum sertifikasi</option>
                                @else
                                <option value="{{ $guru->sertifikasi }}">{{ $guru->sertifikasi }}</option>
                                <option value="sertifikasi">sertifikasi</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="golongan" class="control-label">Golongan</label>
                            <select name="golongan" id="form-control" class="form-control">
                                @for($i = 0; $i < count($golongan); $i++)
                                    <option value="{{ $golongan[$i] }}" {{ $guru->golongan === $golongan[$i] ? 'selected' : '' }}>{{ $golongan[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_aktif" class="control-label">Status Aktif</label>
                            <select name="status_aktif" id="form-control" class="form-control">
                                @for($i = 0; $i < count($status_aktif); $i++)
                                    <option value="{{ $status_aktif[$i] }}" {{ $guru->status_aktif === $status_aktif[$i] ? 'selected' : '' }}>{{ $status_aktif[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="card-footer">
                        <button type="submit" value="{{ __('outlet.create') }}" class="btn btn-success">Simpan Data</button>
                        <a href="{{ route('outlets.show', $outlet) }}" class="btn btn-warning">{{ __('app.cancel') }}</a>
                        <a href="" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>
                    </div>
                </form>
                <div class="card-footer">
                    <form action="{{ route('guru.delete', [$outlet, $guru->id]) }}" method="POST" accept-charset="UTF-8" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru?')">
                    @csrf
                        <button type="submit" class="btn btn-danger">{{ __('app.delete') }}</button>
                    </form>
                    <!-- <a href="{{ route('outlets.index') }}" class="btn btn-link">{{ __('app.back_to_map') }}</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection