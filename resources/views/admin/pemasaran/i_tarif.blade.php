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
          <h1>Tambah Tarif</h1>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{route('kontrak.index')}}">Pemasaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('kontrak.index')}}">Kontrak</a></li>
            <li class="breadcrumb-item"><a href="{{route('kontrak.show',$store->kontrak->kontrak_id)}}">{{$store->kontrak->kontrak_klien_nama}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('tarif.show',$store->store_id)}}">Daftar Tarif {{$store->store_nama}}</a></li>
            <li class="breadcrumb-item active">Tambah Tarif</li>
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
            <h3 class="card-title">Tambah Tarif</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{route('tarif.store')}}" method="POST">@csrf

                <input type="hidden" name="store" value="{{$store->store_id}}">

                <div class="form-group">
                    <label for="jkend">Jenis Kendaraan</label>
                    <select id="jkend" class="form-control select2bs4" name="jkend">
                        <option disabled selected>--Pilih Jenis Kendaraan--</option>
                        @foreach ($jenis as $j)
                        <option value="{{$j->jenis_kendaraan_id}}">{{$j->jenis_kendaraan_nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="tarif">Tarif Klien</label>
                    <input type="text" id="tarif" class="form-control uang" name="tarif">
                </div>

                {{-- <div class="form-group">
                    <label for="mklk">Multidrop Klien Luar Kota</label>
                    <input type="text" id="mklk" class="form-control" name="mklk">
                </div>

                <div class="form-group">
                    <label for="mkdk">Multidrop Klien Dalam Kota</label>
                    <input type="text" id="mkdk" class="form-control" name="mkdk">
                </div> --}}

                {{-- <div class="form-group">
                    <label for="bbmc">Biaya Bongkar Muat Client</label>
                    <input type="text" id="bbmc" class="form-control" name="bbmc">
                </div>

                <div class="form-group">
                    <label for="blk">Biaya Lain Klien</label>
                    <input type="text" id="blk" class="form-control" name="blk">
                </div> --}}

                <div class="form-group">
                    <label for="uj">Uang Jalan</label>
                    <input type="text" id="uj" class="form-control uang" name="uj">
                </div>

                {{-- <div class="form-group">
                    <label for="mmlk">Multidrop MTI Luar Kota</label>
                    <input type="text" id="mmlk" class="form-control" name="mmlk">
                </div>

                <div class="form-group">
                    <label for="mmdk">Multidrop MTI Dalam Kota</label>
                    <input type="text" id="mmdk" class="form-control" name="mmdk">
                </div> --}}

                {{-- <div class="form-group">
                    <label for="bbmm">Biaya Bongkar Muat MTI</label>
                    <input type="text" id="bbmm" class="form-control" name="bbmm">
                </div>

                <div class="form-group">
                    <label for="ritase">Biaya Ritase</label>
                    <input type="text" id="ritase" class="form-control" name="ritase">
                </div>

                <div class="form-group">
                    <label for="blm">Biaya Lain MTI</label>
                    <input type="text" id="blm" class="form-control" name="blm">
                </div> --}}

                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <input type="text" id="ket" class="form-control" name="ket">
                </div>

            </div>
          </div>
          {{-- /.card-body --}}
        </div>
        {{-- /.card --}}
      </div>
    <div class="row">
      <div class="col-12">
        <a href="{{route('tarif.show',$store->store_id)}}" class="btn btn-secondary">Batal</a>
        <input type="submit" value="Tambah Tarif" class="btn btn-success float-right">
      </div>
    </div>
    </form>
  </section>
  {{-- /.content --}}

@push('css')
  {{-- Select2 --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  {{-- daterange picker --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endpush

@push('js')


  {{-- Select2 --}}
  <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
  {{-- date-range-picker --}}
  <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Date range picker
    $('#mulai').datetimepicker({
        format: 'L'
    });

    $('#selesai').datetimepicker({
        format: 'L'
    });
  })
  </script>

  {{-- Input mask --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.date').mask('00/00/0000');
      $('.uang').mask('000.000.000.000', {reverse: true});
      $('.time').mask('00:00:00');
      $('.date_time').mask('00/00/0000 00:00:00');
     });
  </script>

@endpush
@endsection
