@extends('layouts.app')

@section('title', __('outlet.edit'))

@section('content')
<!-- <p style="background-image: url('/img/background.png'); width:1200px; height:680px"> -->
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height: fit-content;">
    <div class="container" style="display: flex;justify-content: center;">
        <div class="col-md-6">
            <div class="card justify-content-center">
                <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">Edit Siswa</div>
                <form method="POST" action="{{ route('siswa.update', [$outlet, $siswa->id]) }}" enctype="multipart/form-data" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="school" class="control-label">Sekolah</label>
                            <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" name="school" value="{{ $school->name }}" required disabled>
                            {!! $errors->first('school', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="tahun" class="control-label">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control" required disabled>
                                <option value="{{ $siswa->tahun }}">{{ $siswa->tahun }}</option>
                            </select>
                            {!! $errors->first('tahun', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="control-label">Kelas</label>
                            <select class="form-control" placeholder="Name" name="kelas" id="kelas" required disabled>
                                <option value="{{ $siswa->kelas_id }}">{{ $siswa->kelas_id }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_laki" class="control-label">Jumlah Laki</label>
                            <input id="jumlah_laki" type="number" class="form-control{{ $errors->has('jumlah_laki') ? ' is-invalid' : '' }}" name="jumlah_laki" value="{{ $siswa->jumlah_laki }}" required>
                            {!! $errors->first('jumlah_laki', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="jumlah_perempuan" class="control-label">Jumlah Perempuan</label>
                            <input id="jumlah_perempuan" type="number" class="form-control{{ $errors->has('jumlah_perempuan') ? ' is-invalid' : '' }}" name="jumlah_perempuan" value="{{ $siswa->jumlah_perempuan }}" required>
                            {!! $errors->first('jumlah_perempuan', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" value="{{ __('outlet.create') }}" class="btn btn-success">Simpan Data</button>
                        <a href="{{ route('outlets.show', $outlet) }}" class="btn btn-warning">{{ __('app.cancel') }}</a>
                        <a href="" class="btn btn-outline-primary">{{ __('app.back_to_map') }}</a>
                    </div>
                </form>
                <div class="card-footer">
                    <form action="{{ route('siswa.delete', [$outlet, $siswa->id]) }}" method="POST" accept-charset="UTF-8" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data siswa?')">
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