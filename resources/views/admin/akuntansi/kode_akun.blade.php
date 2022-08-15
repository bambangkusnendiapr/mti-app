@extends('layouts.admin.master')

@section('akuntansi-menu','menu-open')

@section('akuntansi-active','active')

@section('siklus-menu','menu-open')

@section('siklus-active','active')

@section('kode-akun','active')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Kode Akun</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-target="#modal-tambah"  data-toggle="modal" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Kode Akun</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Akuntansi</a></li>
              <li class="breadcrumb-item active">Kode Akun</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped text-nowrap" width="100%">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Akun</th>
                      <th>Nama Akun</th>
                      <th>Saldo Awal</th>
                      <th>Normal</th>
                      <th>Kelompok</th>
                      <th>Cash Flow</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($kode_akun as $ka)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $ka->kode_akun }}</td>
                      <td>{{ $ka->nama_akun }}</td>
                      <td>{{ number_format($ka->saldo_awal,0,',','.') }}</td>
                      <td>{{ $ka->normal }}</td>
                      <td>{{ $ka->kelompok }}</td>
                      <td>{{ $ka->cash_flow }}</td>
                      <td class="text-center">
                        <a href="" data-target="#modal-edit{{ $ka->id}}" data-toggle="modal" class="btn btn-link btn-xs">
                          <i class="fas fa-edit"></i>
                        </a>
                        <button data-target="#modal-hapus{{ $ka->id}}" data-toggle="modal" class="btn btn-link btn-xs">
                          <i class="fas fa-trash"></i>

                        </button>
                      </td>
                    </tr>
                    @endforeach

                    </tbody>
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
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="my-modal-title">Tambah Kode Akun</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('kode-akun.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="kode_akun">Kode Akun</label>
                        <input type="text" class="form-control" id="kode_akun" placeholder="Kode Akun" name="kode_akun" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_akun">Nama Akun</label>
                        <input type="text" class="form-control" id="nama_akun" placeholder="Nama Akun" name="nama_akun" required>
                      </div>
                      <div class="form-group">
                        <label for="saldo_awal">Saldo Awal</label>
                        <input type="text" class="form-control uang" id="saldo_awal" placeholder="Saldo Awal" name="saldo_awal" value="0">
                      </div>
                      <div class="form-group">
                        <label for="normal">Normal</label>
                        <select id="normal" class="form-control select2bs4" name="normal" required>
                            <option selected disabled>--- Pilih Normal ---</option>
                            <option value="DEBET">DEBET</option>
                            <option value="KREDIT">KREDIT</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kelompok">Kelompok</label>
                        <select id="kelompok" class="form-control select2bs4" name="kelompok" required>
                            <option selected disabled>--- Pilih Kelompok ---</option>
                            <option value="NERACA">NERACA</option>
                            <option value="LABA RUGI">LABA RUGI</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="cashflow">Cash Flow</label>
                        <select id="cashflow" class="form-control select2bs4" name="cashflow" required>
                            <option value="YA">Ya</option>
                            <option value="TIDAK">Tidak</option>
                        </select>
                      </div>
                    <button class="btn btn-primary float-right" type="submit">Tambah</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($kode_akun as $ka)
    <div id="modal-edit{{$ka->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="my-modal-title">Edit Kode Akun</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{route('kode-akun.update',$ka->id)}}" method="post">
                    @csrf @method('PUT')
                    <div class="form-group">
                        <label for="kode_akun">Kode Akun</label>
                        <input type="text" class="form-control" id="kode_akun" placeholder="Kode Akun" name="kode_akun" value="{{ $ka->kode_akun }}" required>
                      </div>
                      <div class="form-group">
                        <label for="nama_akun">Nama Akun</label>
                        <input type="text" class="form-control" id="nama_akun" placeholder="Nama Akun" name="nama_akun" value="{{ $ka->nama_akun }}" required>
                      </div>
                      <div class="form-group">
                        <label for="saldo_awal">Saldo Awal</label>
                        <input type="text" class="form-control uang" id="saldo_awal" placeholder="Saldo Awal" name="saldo_awal" value="{{ $ka->saldo_awal }}">
                      </div>
                      <div class="form-group">
                        <label for="normal">Normal</label>
                        <select id="normal" class="form-control select2bs4" name="normal" required>
                            <option selected disabled>--- Pilih Normal ---</option>
                            <option value="DEBET" @if($ka->normal == "DEBET") selected @endif>DEBET</option>
                            <option value="KREDIT" @if($ka->normal == "KREDIT") selected @endif>KREDIT</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="kelompok">Kelompok</label>
                        <select id="kelompok" class="form-control select2bs4" name="kelompok" required>
                            <option selected disabled>--- Pilih Kelompok ---</option>
                            <option value="NERACA" @if($ka->kelompok == "NERACA") selected @endif>NERACA</option>
                            <option value="LABA RUGI" @if($ka->kelompok == "LABA RUGI") selected @endif>LABA RUGI</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="cashflow">Cash Flow</label>
                        <select id="cashflow" class="form-control select2bs4" name="cashflow" required>
                            <option value="YA" @if($ka->cash_flow == "YA") selected @endif>Ya</option>
                            <option value="TIDAK" @if($ka->cash_flow == "TIDAK") selected @endif>Tidak</option>
                        </select>
                      </div>
                    <button class="btn btn-primary float-right" type="submit">Simpan</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


@foreach ($kode_akun as $ka)
<div class="modal fade" id="modal-hapus{{$ka->id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('kode-akun.destroy',$ka->id) }}" method="post">
                @csrf @method('Delete')
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Peringatan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body text-center text=danger">
                <h3>Apakah anda yakin ingin menghapus Data ?</h3>
            </div>

            <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger float-right">YA! Hapus Data</button>
                </form>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    <!-- /.modal -->
@endforeach


@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

   <!-- Select2 -->
   <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
   <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- page script -->

<script type="text/javascript">
    $(document).ready(function(){
      $('.date').mask('00/00/0000');
      $('.uang').mask('000.000.000.000', {reverse: true});
      $('.time').mask('00:00:00');
      $('.date_time').mask('00/00/0000 00:00:00');
     });
</script>

<script>
  $(function () {
    $("#example1").DataTable({
        "scrollX":true,
        "stateSave":true,
        // "lengthMenu": [[100, 200, -1], [100, 200, "All"]]
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
  });
</script>
@endpush

@endsection
