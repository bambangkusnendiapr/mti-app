@extends('layouts.admin.master')

@section('pemasaran-open','menu-open')

@section('pemasaran-active','active')

@section('kontrak-active','active')

@section('content')

 {{-- Content Header (Page header) --}}
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 mb-2">
          <h1>Tambah Store</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{route('kontrak.index')}}">Pemasaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('kontrak.show',$kontrak->kontrak_id)}}">Manage Kontrak</a></li>
            <li class="breadcrumb-item"><a href="#">Kontrak {{$kontrak->kontrak_klien_nama}}</a></li>
            <li class="breadcrumb-item active">Tambah Store</li>
          </ol>
        </div>
      </div>
    </div>{{-- /.container-fluid --}}
  </section>

  {{-- Main content --}}
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah Store</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{route('store.simpan')}}" method="POST">@csrf

              <input type="hidden" name="kontrak" value="{{$kontrak->kontrak_id}}">

              <div class="form-group">
                  <label for="nama">Store Name</label>
                  <input type="text" id="nama" class="form-control" name="nama" required>
              </div>

              <div class="form-group">
                  <label for="kode">Store Code</label>
                  <input type="text" id="kode" class="form-control" name="kode" required>
              </div>

              <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <input type="text" id="alamat" class="form-control" name="alamat">
              </div>

              <div class="form-group">
                  <label for="provinsi">Provinsi</label>
                  <select id="provinsi" class="form-control select2bs4" name="provinsi" required>
                    <option disabled selected>-- Pilih Provinsi --</option>
                    @foreach ($provinsi as $p)
                      <option value="{{$p->id}}">{{$p->name}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label for="kota">Kota</label>
                  <select id="kota" class="form-control select2bs4" name="kota" required>
                  </select>
              </div>

              <div class="form-group">
                  <label for="region">Region</label>
                  <input id="region" class="form-control" type="text" name="region">
              </div>

              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input id="keterangan" class="form-control" type="text" name="keterangan">
            </div>

            </div>
          </div>
          {{-- /.card-body --}}
        </div>
        {{-- /.card --}}
      </div>
    <div class="row">
      <div class="col-12">
        <a href="{{route('kontrak.show',$kontrak->kontrak_id)}}" class="btn btn-secondary">Batal</a>
        <input type="submit" value="Tambah Store" class="btn btn-success float-right">
      </div>
    </div>
    </form>
  </section>
  {{-- /.content --}}

@push('css')
  {{-- Select2 --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('js')


  {{-- Select2 --}}
  <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  })
  </script>

  {{-- Indonesia --}}
  <script>
    $(document).ready(function(){
        
      $('#provinsi').on('change', function(e){
        var id = e.target.value;
        $.get('{{url('/provinces/get')}}/'+id, function(data){
          $('#kota').empty();
          $('#kota').append('<option disabled selected>-- Pilih Kota --</option>');
          $('#kecamatan').empty();
          $('#kelurahan').empty();
          $.each(data, function(index, val){
            $('#kota').append('<option value='+val.id+'>'+val.name+'</option>');
          });
        });
      });

    });
  </script>

@endpush
@endsection
