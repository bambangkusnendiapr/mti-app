@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('sj','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Manage Surat Jalan</h1>
        </div>
        {{-- <div class="col-sm-6">
          <a href="{{route('sj.create')}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Surat Jalan</a>
        </div> --}}
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item active">Manage Surat Jalan</li>
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
              <table id="example1" class="table table-striped" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>No</th>
                  <th>KD PO</th>
                  <th>Jenis Kendaraan</th>
                  <th>No Polisi</th>
                  <th>Nama Driver</th>
                  <th>Barang</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sj as $r)
                <tr>
                  <td class="text-right">{{$loop->iteration}}</td>
                  <td>{{$r->budget->po->po_kode}}</td>
                  <td>{{$r->budget->jenis->jenis_kendaraan_nama}}</td>
                  <td>{{$r->budget->kendaraan->kendaraan_nopol}}</td>
                  <td>{{$r->budget->driver->driver_nama}}</td>
                  <td>
                    <a href="{{route('sjbarang.show',$r->surat_jalan_id)}}" data-target="" data-toggle="" class="btn btn-xs btn-link text-dark" title="Detail"><span class="fa fa-boxes" ></span></a>
                  </td>
                  <td class="row text-right">
                    <div class="btn-group">
                      <a href="{{route('sj.cetak',$r->surat_jalan_id)}}" class="btn btn-xs btn-link text-primary" title="Cetak Surat Jalan"><span class="fas fa-print"></span></a>
                      @if($r->surat_jalan_status == null)
                        <a href="{{route('sj.terima',$r->surat_jalan_id)}}" class="btn btn-xs btn-link text-info" title="Kirim Surat Jalan" onclick="return confirm('Setelah terkirim data akan dikunci, lanjutkan?')"><span class="fas fa-paper-plane"></span></a>
                      @else
                        <a href="#" class="btn btn-xs btn-link text-success" title="Surat Jalan Telah di Kirim"><span class="fas fa-check"></span></a>
                      @endif
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
      {{-- /.modal-content --}}
    </div>
    {{-- /.modal-dialog --}}
  </div>
  {{-- /.modal --}}

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
