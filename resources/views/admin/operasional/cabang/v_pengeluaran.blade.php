@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('pengeluaran','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Manage Pengeluaran</h1>
        </div>
        <div class="col-sm-6">
          <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Pengeluaran</a>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item active">Manage Pengeluaran</li>
          </ol>
        </div>
      </div>
    </div>{{-- /.container-fluid --}}
  </section>

  {{-- Main content --}}
  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">

              <div class="col-3">
                Total : Rp {{number_format($pengeluaran->sum('pengeluaran_nominal'),0,',','.')}}
              </div>
              
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row">

        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <table id="example1" class="table table-striped" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Keterangan</th>
                  <th>Nominal</th>
                  <th>Tanggal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pengeluaran as $r)
                <tr>
                  <td class="text-right">{{$loop->iteration}}</td>
                  <td>{{$r->pengeluaran_ket}}</td>
                  <td>Rp {{number_format($r->pengeluaran_nominal,0,',','.')}}</td>
                  <td>{{$r->pengeluaran_tgl}}</td>
                  <td class="row text-right">
                    <div class="btn-group" role="group" aria-label="Button group">
                      <a href="#" data-target="#modal-edit{{$r->pengeluaran_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                      <a href="#" data-target="#modal-hapus{{$r->pengeluaran_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
                  </div>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            {{-- /.card-body --}}
          </div>
          {{-- /.card --}}
        </div>
        {{-- /.col --}}
      </div>
      {{-- /.row --}}
    </div>
    {{-- /.container-fluid --}}
  </section>
  {{-- /.content --}}

  <div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('pengeluaran.store')}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Pengeluaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf
            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" class="form-control" name="keterangan">
            </div>
            <div class="form-group">
                <label for="nominal">Nominal</label>
                <input type="text" id="nominal" class="form-control uang" name="nominal" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" class="form-control" name="tanggal">
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Tambah</button>
        </div>
      </form>
      </div>
      {{-- /.modal-content --}}
    </div>
    {{-- /.modal-dialog --}}
  </div>
  {{-- /.modal --}}
  
  @foreach ($pengeluaran as $r)
    <div class="modal fade" id="modal-edit{{$r->pengeluaran_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('pengeluaran.update',$r->pengeluaran_id)}}" method="POST">
          <div class="modal-header bg-info">
            <h4 class="modal-title">Edit Pengeluaran</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf @method('PUT')
              <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" class="form-control" name="keterangan" value="{{$r->pengeluaran_ket}}">
              </div>
              <div class="form-group">
                  <label for="nominal">Nominal</label>
                  <input type="text" id="nominal" class="form-control uang" name="nominal" value="{{$r->pengeluaran_nominal}}" required>
              </div>

              <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" id="tanggal" class="form-control" name="tanggal" value="{{$r->pengeluaran_tgl}}">
              </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
        </div>
        {{-- /.modal-content --}}
      </div>
      {{-- /.modal-dialog --}}
    </div>
    {{-- /.modal --}}
  @endforeach

  @foreach ($pengeluaran as $r)

  <div class="modal fade" id="modal-hapus{{$r->pengeluaran_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="post" action="{{route('pengeluaran.destroy',$r->pengeluaran_id)}}">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus Pengeluaran ?</h3>
          </div>
            <div class="modal-footer justify-content-between">
              @csrf @method('DELETE')
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-danger" onclick="confirm('Data akan dihapus secara permanent, Lanjutkan?')">YA! Hapus Data</button>
            </div>
          </form>
        </div>
        {{-- /.modal-content --}}
      </div>
      {{-- /.modal-dialog --}}
    </div>
    {{-- /.modal --}}

  @endforeach

@push('css')
  {{-- DataTables --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  {{-- Sweetalert --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush

@push('js')

{{-- DataTables --}}
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

{{-- page script --}}
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
  });
</script>

{{-- Input mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.uang').mask('000.000.000.000', {reverse: true});
   });
</script>

{{-- Sweetalert --}}
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  $(function(){

      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });

      @if ($message = Session::get('success'))
      Toast.fire({
          icon: 'success',
          title: '{{$message}}'
      })
      @endif

      @if ($message = Session::get('warning'))
      Toast.fire({
          icon: 'warning',
          title: '{{$message}}'
      })
      @endif

      @if ($message = Session::get('error'))
      Toast.fire({
          icon: 'error',
          title: '{{$message}}'
      })
      @endif

  });
</script>
@endpush

@endsection
