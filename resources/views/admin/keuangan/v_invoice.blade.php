@extends('layouts.admin.master')

@section('menu-keuangan','menu-open')

@section('keuangan','active')

@section('invoice','active')

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Manage Invoice</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{route('invoice.create')}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Invoice</a>

          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
              <li class="breadcrumb-item active">Manage Invoice</li>
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
              {{-- <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="/tambahklien" class="btn btn-primary float-right"><span class="fa fa-plus"></span>Tambah Klien</a>
              </div> --}}
              {{-- /.card-header --}}
              <div class="card-body">
                <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Invoice</th>
                    <th>Tanggal Invoice</th>
                    <th>Detail</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($invoice as $r)
                  <tr>
                    <td class="text-right">{{$loop->iteration}}</td>
                    <td>{{$r->invoice_kode}}</td>
                    <td>{{$r->invoice_tanggal}}</td>
                    <td class="text-center">
                      <a href="{{ route('invoice.show',$r->invoice_id) }}" class="btn btn-xs btn-link text-info" title="Detail Invoice"><span class="fa fa-copy" ></span></a>
                    </td>
                    <td class="text-center">
                      <a href="{{route('invoice.cetak',$r->invoice_id)}}" class="btn btn-xs btn-link text-success" target="_blank" title="Print"><span class="fa fa-print" ></span></a>
                      <a href="{{route('invoice.edit',$r->invoice_id)}}" class="btn btn-xs btn-link text-warning"  title="Edit"><span class="fa fa-edit" ></span></a>
                      <a href="#" data-target="#modal-hapus{{$r->invoice_id}}" data-toggle="modal" class="btn btn-xs btn-link text-danger" title="Hapus"><span class="fa fa-trash"></span></a>
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
  
  @foreach($invoice as $r)
    <div class="modal fade" id="modal-hapus{{$r->invoice_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('invoice.destroy',$r->invoice_id)}}" method="post">@csrf @method('DELETE')
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus Invoice dengan kode kontrak<u><strong>{{$r->kontrak->kontrak_kode}}</strong></u> ?</h3>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">YA! Hapus Data</button>
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
