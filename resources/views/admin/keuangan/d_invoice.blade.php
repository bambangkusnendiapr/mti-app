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
            <h1>Manage Detail Invoice</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Detail Invoice</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">keuangan</a></li>
              <li class="breadcrumb-item">Manage Invoice</li>
              <li class="breadcrumb-item active">Detail Invoice</li>
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
                <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Surat Jalan</th>
                    <th>Tarif</th>
                    <th>MDK</th>
                    <th>Additional</th>
                    <th>Total</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($idetail as $r)
                  <tr>
                    <td class="text-right">{{$loop->iteration}}</td>
                    <td>{{$r->reconcile->reconcile_sj}}</td>
                    <td>Rp {{number_format($r->reconcile->reconcile_tarif,0,',','.')}}</td>
                    <td>Rp {{number_format($r->reconcile->reconcile_mdk,0,',','.')}}</td>
                    <td>Rp {{number_format($r->reconcile->reconcile_add,0,',','.')}}</td>
                    <td>Rp {{number_format($r->reconcile->reconcile_klien_total,0,',','.')}}</td>
                    <td class="text-center">
                      <a href="#" data-target="#modal-edit{{$r->reconcile->reconcile_id}}" data-toggle="modal" class="btn btn-xs btn-link"  title="Edit"><span class="fa fa-edit" ></span></a>
                      <a href="#" data-target="#modal-hapus{{$r->invoice_detail_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
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
      <form action="{{route('invoice.detail.store')}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-group">
              <label for="ktp">Reconcile</label>
              <select name="reconcile" id="reconcile" class="form-control" required>
                <option disabled selected>-- Pilih Reconcile --</option>
                @foreach($reconcile as $r)
                  <option value="{{$r->reconcile_id}}">{{$r->reconcile_id}} | {{$r->sj->budget->po->po_kode}} | {{$r->sj->budget->jenis->jenis_kendaraan_nama}} </option>
                @endforeach
              </select>
          </div>
          <input type="hidden" name="invoice" value="{{$invoice->invoice_id}}">
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

  @foreach($idetail as $d)
  <div class="modal fade" id="modal-edit{{$d->reconcile_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('reconcile.update',$d->reconcile_id)}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Edit Detail</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf @method('PUT')
          <div class="form-group">
            <label for="sj">Surat Jalan</label>
            <input type="text" class="form-control" name="sj" value="{{$d->reconcile->reconcile_sj}}">
          </div>
          <div class="form-group">
            <label for="tarif">Tarif</label>
            <input type="text" class="form-control uang" name="tarif" value="{{$d->reconcile->reconcile_tarif}}">
          </div>
          <div class="form-group">
            <label for="mdk">MDK</label>
            <input type="text" class="form-control uang" name="mdk" value="{{$d->reconcile->reconcile_mdk}}">
          </div>
          <div class="form-group">
            <label for="add">Additional</label>
            <input type="text" class="form-control uang" name="add" value="{{$d->reconcile->reconcile_add}}">
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
  @endforeach
  
  @foreach($idetail as $r)
    <div class="modal fade" id="modal-hapus{{$r->invoice_detail_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('invoice.detail.destroy',$r->invoice_detail_id)}}" method="post">@csrf @method('DELETE')
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus detail Invoice <u><strong>{{$r->invoice_detail_id}}</strong></u> ?</h3>
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

{{-- Input mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.date').mask('00/00/0000');
    $('.uang').mask('000.000.000.000', {reverse: true});
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
  });
</script>

@endpush

@endsection
