@extends('layouts.admin.master')

@section('akuntansi-menu','menu-open')

@section('akuntansi-active','active')

@section('siklus-menu','menu-open')

@section('siklus-active','active')

@section('laporan','active')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 mb-2">
                <h1>Laporan</h1>
            </div>
            <div class="col-sm-6">
                {{-- <a href="#" data-target="#modal-tambah"  data-toggle="modal" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Posting</a> --}}
            </div>
            <div class="col-sm-12">
                <ol class="breadcrumb float-sm-left">
                    <li class="breadcrumb-item"><a href="#">Akuntansi</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button type="button"  class="btn btn-md btn-success" data-target="#modal-bb" data-toggle="modal">Buku Besar</button>
                        <button type="button"  class="btn btn-md btn-success" data-target="#modal-lr" data-toggle="modal">Laba Rugi</button>
                        <button type="button"  class="btn btn-md btn-success" data-target="#modal-neraca" data-toggle="modal">Neraca</button>
                        <button type="button"  class="btn btn-md btn-success" data-target="#modal-cf" data-toggle="modal">Cash Flow</button>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        <!-- /.col -->
        </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->

<div id="modal-bb" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Buku Besar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <form action="{{route('buku-besar.view')}}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="tgl1">Tanggal</label>
                        <div class="row">
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>
                            </div>
                            <div class="col-2 text-center">
                                S/D
                            </div>
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Buku Besar ?')">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-lr" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Laba Rugi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <form action="{{route('laba-rugi.view')}}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="tgl1">Tanggal</label>
                        <div class="row">
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>
                            </div>
                            <div class="col-2 text-center">
                                S/D
                            </div>
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Laba Rugi ?')">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-neraca" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Neraca</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <form action="{{route('neraca.view')}}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="tgl1">Tanggal</label>
                        <div class="row">
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>
                            </div>
                            <div class="col-2 text-center">
                                S/D
                            </div>
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Neraca ?')">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-cf" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title">Cash Flow</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <div class="modal-body">
                <form action="{{route('cash-flow.view')}}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label for="tgl1">Tanggal</label>
                        <div class="row">
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>
                            </div>
                            <div class="col-2 text-center">
                                S/D
                            </div>
                            <div class="col-5">
                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Cash Flow ?')">Cetak</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('js')

<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- page script -->
<script>
    function sync()
    {
      var kredit = document.getElementById('kredit');
      var debit = document.getElementById('debit');
      kredit.value = debit.value;
    }
</script>
<script>
  $(function () {
    $("#example1").DataTable({
        "scrollX":true,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    var $debit = $("#debit");

    $("#kredit").keyup(function() {
        $debit.val( this.value );
    });
    var $kredit = $("#kredit");

    $("#debit").keyup(function() {
        $kredit.val( this.value );
    });


  });

</script>
@endpush

@endsection
