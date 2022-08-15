@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('sj','active')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Detail</h1>
          </div>
          <div class="col-sm-6">

          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Operasional</a></li>
              <li class="breadcrumb-item">Manage Surat Jalan</li>
              <li class="breadcrumb-item active">Detail Surat Jalan</li>
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
                  <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label>Nama Driver <label>
                            </div>
                            <div class="col-md-7">
                                <span>Dadang</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-5">
                                <label>Jenis Kendaraan <label>
                            </div>
                            <div class="col-md-7">
                                <span>CDD</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-5">
                                <label>No Polisi <label>
                            </div>
                            <div class="col-md-7">
                                <span>B 777 LUK</span>
                            </div>
                        </div>
                    </div>
                  </div>
              </div>
          </div>
          <div class="col-12">
            <div class="card">
              {{-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="/tambahklien" class="btn btn-primary float-right"><span class="fa fa-plus"></span>Tambah Klien</a>
              </div> --}}
              <!-- /.card-header -->
              <div class="card-body">
                  <div class="row mb-2">
                      <div class="col-md-12 text-right">

                          <a href="#" data-target="#modal-tambah" data-toggle="modal" class="btn btn-primary btn-sm"><span class="fa fa-plus">&nbsp;</span>Tambah Store</a>
                      </div>

                  </div>

                  <table id="example1" class="table table-striped table-lg text-nowrap" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Store</th>
                      <th>Penerima</th>
                      <th>Jabatan</th>
                      <th>Keterangan</th>
                      <th>Detail Barang</th>
                      <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td class="text-right">1</td>
                      <td>KCN</td>
                      <td>Penerima 1</td>
                      <td>Jabatan  1</td>
                      <td>keterangan</td>
                      <td align="center"> <a href="{{ route('sj.barang') }}" class="btn btn-xs btn-link text-danger"><span class="fa fa-box"></span></a>
                      </td>
                      <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Button group">

                              <a href="{{ route('sj.cetak') }}" class="btn btn-xs btn-link text-success"><span class="fa fa-print"></span></a>
                              <a href="#" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                              <a href="#" data-target="#modal-hapus" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
                          </div>
                      </td>
                    </tr>

                  </table>
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


    <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="po">KD PO</label>
                        <select id="po" class="form-control select2bs4" name="">
                            <option disabled selected>--Pilih KD PO--</option>
                            <option>PO001</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="my-select">Jenis Kendaraan</label>
                        <select id="my-select" class="form-control select2bs4" name="">
                            <option disabled selected>--Pilih Jenis Kendaraan--</option>
                            <option>CDD</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="store">Store</label>
                        <select id="store" class="form-control select2bs4" name="">
                            <option disabled selected>--pilih store--</option>
                            <option>BDG</option>
                            <option>KCN</option>
                        </select>
                    </div>
                    <button class="btn btn-primary float-right" type="button">Tambah</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Peringatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center text=danger">
              <h3>Apakah anda yakin ingin menghapus Surat Jalan <u><strong>SJ001</strong></u> ?</h3>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-danger">YA! Hapus Data</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@push('js')
 <!-- Select2 -->
 <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })



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
  });
</script>
@endpush

@endsection
