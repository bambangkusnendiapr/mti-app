@extends('layouts.admin.master')

@section('other-open', 'menu-open')

@section('other-active', 'active')

@section('payroll', 'active')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Periode</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Periode</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item active">Payroll</li>
                <li class="breadcrumb-item active"><a href="#">Periode</a></li>
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
              <div class="card-body">
                <table id="example1" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th >
                    <th>Payroll Karyawan</th >
                    <th></th>
                  </tr>
                  </thead>
                  @foreach ($periode as $p)
                  <tbody>
                  <tr>
                    <td class="text-right">{{ $loop->iteration }}</td>
                    <td>{{ $p->periode_tanggal }}</td>
                    <td>{{ $p->periode_keterangan }}</td>
                    <td class="text-center"><a href="{{route('payroll-karyawan.show',$p->periode_id)}}" class="btn btn-xs btn-link"><span class="fa fa-eye"></span></a></td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Button group">
                            <a href="#" data-target="#modal-edit{{$p->periode_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                            <a href="#" data-target="#modal-hapus{{$p->periode_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
                        </div>
                    </td>
                  </tr>
                  </tbody>
                  @endforeach
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

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Tambah Periode</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="{{route('payroll-periode.store')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" id="tgl" class="form-control" name="tanggal">
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea id="ket" class="form-control" name="ket"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Tambah</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    @foreach ($periode as $p)
      <div class="modal fade" id="modal-edit{{$p->periode_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Periode</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{route('payroll-periode.update',$p->periode_id)}}" method="POST">
                @method('PUT')
                <div class="form-group">
                    <label for="tgl">Tanggal</label>
                    <input type="date" id="tgl" class="form-control" name="tgl" value="{{ $p->periode_tanggal }}">
                </div>
                <div class="form-group">
                    <label for="ket">Keterangan</label>
                    <textarea id="ket" class="form-control" name="ket">{{ $p->periode_keterangan }}</textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    @endforeach


    @foreach ($periode as $p)
    <div class="modal fade" id="modal-hapus{{$p->periode_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
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
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-danger" onclick="confirm('Data akan dihapus secara permanent, Lanjutkan?')">YA! Hapus Data</button>
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
  {{-- Sweetalert --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush

@push('js')

<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
        "scrollX":true,

    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
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
