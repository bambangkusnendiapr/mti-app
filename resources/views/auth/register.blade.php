<!DOCTYPE html>

@extends('layouts.login.master')

@section('daftar', 'active')

@section('konten')

{{-- Content Header (Page header) --}}
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Form Pendaftaran Panti Asuhan</h1>
        </div>
        </div>
    </div>{{-- /.container-fluid --}}
</section>

{{-- =============================================== --}}

{{-- Main content --}}
<section class="content">

<form method="POST" action="{{ route('panti.store') }}">
@csrf

<div class="container-fluid">

<div class="row">
    <div class="col-md-6">
        {{-- Email & Password Card --}}
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Email & Password</h3>
            </div>

            <div class="card-body">
                
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password*</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm">Konfirmasi Password*</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

            </div>
            {{-- /.card-body --}}

        </div>
        {{-- /.Email & Password Card --}}
    </div>

    <div class="col-md-6">
        {{-- Data Panti --}}
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Data Panti</h3>
            </div>

            <div class="card-body">

                <div class="form-group">
                    <label for="panti">Nama Panti*</label>
                    <input id="panti" type="text" class="form-control{{ $errors->has('panti') ? ' is-invalid' : '' }}" name="panti" value="{{ old('panti') }}" required>
                    @if ($errors->has('panti'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('panti') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="ketua">Nama Ketua*</label>
                    <input id="ketua" type="text" class="form-control{{ $errors->has('ketua') ? ' is-invalid' : '' }}" name="ketua" value="{{ old('ketua') }}" required>
                    @if ($errors->has('ketua'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('ketua') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="kategori">Kategori Panti*</label>
                    <select name="kategori" id="kategori" class="form-control{{ $errors->has('kategori') ? ' is-invalid' : '' }}" required>
                    <option disabled selected>Pilih Kategori</option>
                    @foreach($kategori as $r)
                    <option value="{{$r->kategori_id}}">{{$r->kategori_nama}}</option>
                    @endforeach
                    </select>
                    @if ($errors->has('kategori'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('kategori') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            {{-- /.card-body --}}

        </div>
        {{-- /. Data Panti Card --}}
    </div>
</div>
{{-- /.row --}}

<div class="row">
    <div class="col-md-12">
        {{-- Alamat Panti --}}
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title">Alamat Panti</h3>
            </div>

            <div class="card-body row">
                
                {{-- Kiri --}}
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="provinsi">Provinsi*</label>
                        <select name="provinsi" id="provinsi" class="form-control{{ $errors->has('provinsi') ? ' is-invalid' : '' }}" required>
                            <option disabled selected>Pilih Provinsi</option>
                            @foreach($province as $p)
                            <option value="{{$p->id}}">{{$p->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('provinsi'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('provinsi') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kota">Kota / Kabupaten*</label>
                        <select name="kota" id="kota" class="form-control{{ $errors->has('kota') ? ' is-invalid' : '' }}" required>
                            {{-- <option disabled selected>Pilih Kota</option> --}}
                        </select>
                        @if ($errors->has('kota'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kota') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kecamatan">Kecamatan*</label>
                        <select name="kecamatan" id="kecamatan" class="form-control{{ $errors->has('kecamatan') ? ' is-invalid' : '' }}" required>
                            {{-- <option disabled selected>Pilih Kecamatan</option> --}}
                        </select>
                        @if ($errors->has('kecamatan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kecamatan') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="kelurahan">Kelurahan / Desa*</label>
                        <select name="kelurahan" id="kelurahan" class="form-control{{ $errors->has('kelurahan') ? ' is-invalid' : '' }}" required>
                            {{-- <option disabled selected>Pilih Kelurahan</option> --}}
                        </select>
                        @if ($errors->has('kelurahan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kelurahan') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                {{-- /. Kiri --}}

                {{-- Kanan --}}
                <div class="col-md-6">

                    <div class="form-group pb-2">
                        <label for="alamat">Alamat Panti*</label>
                        <textarea id="alamat" rows="4" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ old('alamat') }}" required></textarea>
                        @if ($errors->has('alamat'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('alamat') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="row">
                    
                        <div class="col-md-6 form-group">
                            <label for="rt">RT*</label>
                            <input id="rt" type="text" class="form-control{{ $errors->has('rt') ? ' is-invalid' : '' }}" name="rt" value="{{ old('rt') }}" required>
                            @if ($errors->has('rt'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rt') }}</strong>
                                </span>
                            @endif
                        </div>

                    
                        <div class="col-md-6 form-group">
                            <label for="rw">RW*</label>
                            <input id="rw" type="text" class="form-control{{ $errors->has('rw') ? ' is-invalid' : '' }}" name="rw" value="{{ old('rw') }}" required>
                            @if ($errors->has('rw'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rw') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="kodepos">Kode Pos</label>
                        <input id="kodepos" type="text" class="form-control{{ $errors->has('kodepos') ? ' is-invalid' : '' }}" name="kodepos" value="{{ old('kodepos') }}">
                        @if ($errors->has('kodepos'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('kodepos') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                {{-- /. Kanan --}}

            </div>
            {{-- /.card-body --}}

        </div>
        {{-- /. Alamat Panti Card --}}
    </div>
</div>
{{-- /. row --}}

<div class="row">
    <div class="col-md-12">
        {{-- Kebutuhan Pendaftaran --}}
        <div class="card card-outline card-danger">
            <div class="card-header">
                <h3 class="card-title">Kebutuhan Pendaftaran</h3>
            </div>

            <div class="card-body row">
                
                {{-- Kiri --}}
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="telp">No. Telpon*</label>
                        <input id="telp" type="text" class="form-control{{ $errors->has('telp') ? ' is-invalid' : '' }}" name="telp" value="{{ old('telp') }}" required>
                        @if ($errors->has('telp'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('telp') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="npwp">NPWP</label>
                        <input id="npwp" type="text" class="form-control{{ $errors->has('npwp') ? ' is-invalid' : '' }}" name="npwp" value="{{ old('npwp') }}">
                        @if ($errors->has('npwp'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('npwp') }}</strong>
                            </span>
                        @endif
                    </div>

                </div>
                {{-- /. Kiri --}}

                {{-- Kanan --}}
                <div class="col-md-6">

                    <div class="form-group">
                        <label for="izin">No. Izin Operasional*</label>
                        <input id="izin" type="text" class="form-control{{ $errors->has('izin') ? ' is-invalid' : '' }}" name="izin" value="{{ old('izin') }}" required>
                        @if ($errors->has('izin'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('izin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group py-4">
                        <button name="btn" type="submit" class="col-md-4 btn btn-primary text-center">
                            DAFTAR
                        </button>
                    </div>

                </div>
                {{-- /. Kanan --}}

            </div>
            {{-- /.card-body --}}

        </div>
        {{-- /. Kebutuhan Pendaftaran Card --}}
    </div>
</div>
{{-- /.row --}}

</div>
{{-- /. Container Fluid --}}

</form>

</section>
{{-- /.content --}}


{{-- =============================================== --}}

    @push('scripts')
        {{-- Select2 --}}
        <script src="{{asset('plugins/select/js/select2.min.js')}}"></script>
        <script>
            $('select').each(function () {
                $(this).select2({
                theme: 'bootstrap4',
                width: 'style',
                placeholder: $(this).attr('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
                });
            });
        </script>

        {{-- Indonesia --}}
        <script>
        $(document).ready(function(){
            
            $('#provinsi').on('change', function(e){
            var id = e.target.value;
            $.get('{{url('/provinces/get')}}/'+id, function(data){
                $('#kota').empty();
                $('#kota').append('<option disabled selected>Pilih Kota</option>');
                $('#kecamatan').empty();
                $('#kelurahan').empty();
                $.each(data, function(index, val){
                $('#kota').append('<option value='+val.id+'>'+val.name+'</option>');
                });
            });
            });

            $('#kota').on('change', function(e){
            var id = e.target.value;
            $.get('{{url('/cities/get')}}/'+id, function(data){
                $('#kecamatan').empty();
                $('#kecamatan').append('<option disabled selected>Pilih Kecamatan</option>');
                $('#kelurahan').empty();
                $.each(data, function(index, val){
                $('#kecamatan').append('<option value='+val.id+'>'+val.name+'</option>');
                });
            });
            });

            $('#kecamatan').on('change', function(e){
            var id = e.target.value;
            $.get('{{url('/districts/get')}}/'+id, function(data){
                $('#kelurahan').empty();
                $('#kelurahan').append('<option disabled selected>Pilih Kelurahan</option>');
                $.each(data, function(index, val){
                $('#kelurahan').append('<option value='+val.id+'>'+val.name+'</option>');
                });
            });
            });

        });
        </script>

    @endpush

    @push('css')
        {{-- Select2 --}}
        <link href="{{asset('plugins/select/css/select2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('plugins/select/css/select2-bootstrap4.css')}}" rel="stylesheet" />
    @endpush

@endsection
