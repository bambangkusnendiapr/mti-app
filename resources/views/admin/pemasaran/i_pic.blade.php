@extends('layouts.admin.master')

@section('pemasaran-open','menu-open')

@section('pemasaran-active','active')

@section('kontrak-active','active')

@section('content')

 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 mb-2">
          <h1>Tambah PIC</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Pemasaran</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Kontrak</a></li>
            <li class="breadcrumb-item"><a href="#">Kontrak LSI CIKARANG</a></li>
            <li class="breadcrumb-item active">Tambah PIC</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah PIC</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="#" method="POST">@csrf
                <div class="form-group">
                    <label for="inputName">Nama</label>
                    <input type="text" id="inputName" class="form-control" name="user">
                </div>

                <div class="form-group">
                    <label for="inputName">Jabatan</label>
                    <input type="text" id="inputName" class="form-control" name="klien">
                </div>

                <div class="form-group">
                    <label for="inputName">Keterangan</label>
                    <input type="text" id="inputName" class="form-control" name="klien">
                </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    <div class="row">
      <div class="col-12">
        <a href="{{route('klien.index')}}" class="btn btn-secondary">Batal</a>
        <input type="submit" value="Tambah PIC" class="btn btn-success float-right">
      </div>
    </div>
    </form>
  </section>
  <!-- /.content -->

@push('css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
@endpush

@push('js')


  <!-- Select2 -->
  <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
  <!-- date-range-picker -->
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

@endpush
@endsection
