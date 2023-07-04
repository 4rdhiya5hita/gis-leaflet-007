@extends('layouts.app')

@section('title', __('outlet.create'))

@section('content')
<!-- <p style="background-image: url('/img/background.png'); width:1200px; height:680px"> -->
<div style="background-image: url('/img/bg-peta.jpg'); background-size: cover; height: fit-content;">
    <div class="container" style="display: flex;justify-content: center;">
        <div class="col-md-6 mb-3">
            <div class="card justify-content-center">
                <div class="card-header bg-primary font-weight-bold" style="color: white; font-size:large;">Tambah Siswa</div>
                <form method="POST" action="{{ route('siswa.store', $outlet) }}" enctype="multipart/form-data" accept-charset="UTF-8">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="school" class="control-label">Sekolah</label>
                            <input id="school" type="text" class="form-control{{ $errors->has('school') ? ' is-invalid' : '' }}" name="school" value="{{ $school->name }}" required disabled>
                            {!! $errors->first('school', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="tahun" class="control-label">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control">
                            @for($i = 2020; $i < 2030; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                            </select>
                            {!! $errors->first('tahun', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="kelas" class="control-label">Kelas</label>
                            <select class="form-control" placeholder="Name" name="kelas" id="kelas" required>
                                @foreach($kelas as $val)
                                    <option value="{{ $val->id }}">{{ $val->kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jumlah_laki" class="control-label">Jumlah Laki</label>
                            <input id="jumlah_laki" type="number" class="form-control{{ $errors->has('jumlah_laki') ? ' is-invalid' : '' }}" name="jumlah_laki" value="{{ old('jumlah_laki') }}" required>
                            {!! $errors->first('jumlah_laki', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                        <div class="form-group">
                            <label for="jumlah_perempuan" class="control-label">Jumlah Perempuan</label>
                            <input id="jumlah_perempuan" type="number" class="form-control{{ $errors->has('jumlah_perempuan') ? ' is-invalid' : '' }}" name="jumlah_perempuan" value="{{ old('jumlah_perempuan') }}" required>
                            {!! $errors->first('jumlah_perempuan', '<span class="invalid-feedback" role="alert">:message</span>') !!}
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tahun').on('change', function() {
            var tahun = $(this).val();

            var kelas = {!! json_encode($kelas) !!};
            var siswa = {!! json_encode($siswa) !!};
            var tahun_siswa = {!! json_encode($tahun_siswa) !!};
            var check = '';
            var kelas_per_jenjang = [];
            var kelas_terisi = [];
            var kelas_kosong = [];

                          
            if (tahun == tahun_siswa) {                   

                siswa.forEach(function(siswaItem) {
                    kelas_terisi.push(siswaItem.kelas);
                });
                kelas.forEach(function(kelasItem) {
                    kelas_per_jenjang.push(kelasItem.kelas);
                });

                // Menghapus elemen yang sudah ada di array1 dari array2
                var kelas_kosong = kelas_per_jenjang.filter(function(value) {
                    return !kelas_terisi.includes(value);
                });

                var selectKelas = document.getElementById('kelas');
                // Hapus semua opsi yang ada sebelumnya
                selectKelas.innerHTML = '';

                // Tambahkan opsi dari kelas_kosong
                kelas_kosong.forEach(function(kelas) {
                    var option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    selectKelas.appendChild(option);
                });

            } else {
                kelas.forEach(function(kelasItem) {
                    kelas_kosong.push(kelasItem.kelas);
                });

                var selectKelas = document.getElementById('kelas');
                // Hapus semua opsi yang ada sebelumnya
                selectKelas.innerHTML = '';

                // Tambahkan opsi dari kelas_kosong
                kelas_kosong.forEach(function(kelas) {
                    var option = document.createElement('option');
                    option.value = kelas;
                    option.text = kelas;
                    selectKelas.appendChild(option);
                });
            }

            console.log(kelas_terisi);
            console.log(kelas_kosong);
        });
    });

</script>
@endpush