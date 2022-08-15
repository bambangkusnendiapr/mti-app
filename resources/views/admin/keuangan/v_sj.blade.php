@extends('layouts.admin.master')

@section('menu-keuangan','menu-open')

@section('keuangan','active')

@section('reconcile','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Manage Surat Jalan</h1>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
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
                  <th>Tarif</th>
                  <th>MDK</th>
                  <th>Additional</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sj as $r)
                <tr>
                  <td class="text-right">{{$loop->iteration}}</td>
                  <td>{{$r->budget->po->po_kode}}</td>
                  <td>{{$r->budget->jenis->jenis_kendaraan_nama}}</td>
                  <td>
                    @if($r->reconcile != null)
                      <s class="text-danger">Rp {{number_format($r->surat_jalan_tarif,0,',','.')}}</s> 
                      <span class="text-success">Rp {{number_format($r->reconcile->reconcile_tarif,0,',','.')}}</span>
                    @else
                      Rp {{number_format($r->surat_jalan_tarif,0,',','.')}}
                    @endif
                  </td>
                  <td>
                    @if($r->reconcile != null)
                      <s class="text-danger">Rp {{number_format($r->surat_jalan_mdk,0,',','.')}}</s> 
                      <span class="text-success">Rp {{number_format($r->reconcile->reconcile_mdk,0,',','.')}}</span>
                    @else
                      Rp {{number_format($r->surat_jalan_mdk,0,',','.')}}
                    @endif  
                  </td>
                  <td>
                    @if($r->reconcile != null)
                      <span class="text-success">Rp {{number_format($r->reconcile->reconcile_add,0,',','.')}}</span>
                    @endif
                  </td>
                  <td class="row text-right">
                    <div class="btn-group">
                      @if($r->surat_jalan_status == 1)
                        <a href="{{route('suratjalan.terima',$r->surat_jalan_id)}}" class="btn btn-xs btn-link text-primary" title="Terima Surat Jalan"><span class="fas fa-hands"></span></a>
                      @elseif($r->surat_jalan_status == 2)
                        <a href="#" data-target="#sj-edit{{$r->surat_jalan_id}}" data-toggle="modal" class="btn btn-xs btn-link text-primary" title="Terima Surat Jalan"><span class="fas fa-file"></span> Reconcile</a>
                      @else
                        <a href="#" class="btn btn-xs btn-link text-success" title="Selesai di Reconcile"><span class="fas fa-check"></span> Selesai</a>
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

  @foreach ($sj as $r)
    <div class="modal fade" id="sj-edit{{$r->surat_jalan_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('suratjalan.update',$r->surat_jalan_id)}}" method="POST">
          <div class="modal-header bg-info">
            <h4 class="modal-title">Edit Surat Jalan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              @csrf @method('PUT')
              <div class="form-group">
                <label for="tarif">Tarif</label>
                <input type="text" id="tarif" class="form-control uang" name="tarif" value="{{$r->surat_jalan_tarif}}">
              </div>
              <div class="form-group">
                <label for="mdk">Multidrop Klien</label>
                <input type="text" id="mdk" class="form-control uang" name="mdk" value="{{$r->surat_jalan_mdk}}" required>
              </div>
              <div class="form-group">
                <label for="add">Additional</label>
                <input type="text" id="add" class="form-control uang" name="add" value="{{$r->driver_add}}">
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
