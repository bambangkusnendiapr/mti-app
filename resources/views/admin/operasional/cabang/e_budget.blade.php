@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('po','active')

@section('content')

 {{-- Content Header (Page header) --}}
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 mb-2">
          <h1>Edit Budgeting</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item"><a href="#">Manage PO</a></li>
            <li class="breadcrumb-item"><a href="#">Budgeting</a></li>
            <li class="breadcrumb-item active">Edit Budgeting</li>
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
            <h3 class="card-title">Edit Budgeting</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">

            <form action="{{route('budget.update',$budget->budget_id)}}" method="POST">@csrf @method('PUT')

              <input id="po" type="hidden" name="po" value="{{$budget->po_id}}">

              <div class="form-group">
                  <label for="jenis">Pilih Jenis Kendaraan</label>
                  <select class="form-control select2bs4" name="jenis" id="jenis">
                    <option selected disabled>--Pilih Jenis Kendaraan--</option>
                    @foreach ($jenis as $j)
                    <option value="{{$j->jenis_kendaraan_id}}"{{$j->jenis_kendaraan_id == $budget->jenis_kendaraan_id ? "selected" : ""}}>{{$j->jenis_kendaraan_nama}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                  <label for="nopol">Pilih Nomor polisi</label>
                  <select class="form-control select2bs4" name="nopol" id="nopol">
                    <option selected disabled>-- Pilih Nomor Polisi --</option>
                    @foreach ($kendaraan as $k)
                    <option value="{{$k->kendaraan_id}}"{{$k->kendaraan_id == $budget->kendaraan_id ? "selected" : ""}}>{{$k->kendaraan_nopol}}</option>
                    @endforeach
                  </select>
              </div>

              <div class="form-group">
                <label for="driver">Pilih Driver</label>
                <select class="form-control select2bs4" name="driver" id="driver">
                  <option selected disabled>-- Pilih Driver --</option>
                  @foreach ($driver as $d)
                  <option value="{{$d->driver_id}}"{{$d->driver_id == $budget->driver_id ? "selected" : "" }}>{{$d->driver_nama}}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                  <label for="inputName">Catatan</label>
                  <input type="text" id="inputName" class="form-control" name="cat" value="{{$budget->budget_catatan}}">
              </div>

          </div>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>
      
    <div class="row">
      <div class="col-12">
        <a href="{{route('budget.show',$budget->po_id)}}" class="btn btn-secondary">Batal</a>
        <input type="submit" value="Edit Budgeting" class="btn btn-success float-right">
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

  <script>
    $(document).ready(function(){
        
      $('#jenis').on('change', function(e){
        var id = e.target.value;
        $.get('{{url('/nopol/get')}}/'+id, function(data){
          $('#nopol').empty();
          $('#nopol').append('<option disabled selected>-- Pilih Nomor Polisi --</option>');
          $.each(data, function(index, val){
            $('#nopol').append('<option value='+val.kendaraan_id+'>'+val.kendaraan_nopol+'</option>');
          });
        });
      });

    });
  </script>

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

@endpush
@endsection
