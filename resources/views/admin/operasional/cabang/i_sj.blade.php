@extends('layouts.admin.master')

@section('content')

 <!-- Content Header (Page header) -->
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 mb-2">
          <h1>Manage Surat Jalan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Surat Jalan</a></li>
            <li class="breadcrumb-item active">Tambah Surat Jalan</li>
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
            <h3 class="card-title">Tambah Surat Jalan</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
        <div class="card-body">
            <form action="#" method="POST">@csrf
                <div class="form-group">
                    <label for="date">Tanggal SJ</label>
                    <input id="date" class="form-control" type="date" name="">
                </div>

                <div class="form-group">
                    <label for="kdkontrak">LSI CIKARANG</label>
                    <select id="kdkontrak" class="form-control" name="">
                        <option>LSI CIKARANG</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="po">KD PO</label>
                    <select id="po" class="form-control" name="">
                        <option>LSI CIKARANG</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="po">No Budget</label>
                    <select id="po" class="form-control" name="">
                        <option>LSI CIKARANG</option>
                    </select>
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
        <input type="submit" value="Tambah Surat Jalan" class="btn btn-success float-right">
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
