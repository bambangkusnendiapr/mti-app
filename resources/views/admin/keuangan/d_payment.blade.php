@extends('layouts.admin.master')

@section('menu-keuangan','menu-open')

@section('keuangan','active')

@section('payment','active')

@section('menu-payment','menu-open')

@if($invoice->invoice_status == 1)              
  @section('lunas','active')
@else
  @section('belumlunas','active')
@endif

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Manage Detail Payment</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Detail Payment</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
              <li class="breadcrumb-item">Manage Payment</li>
              <li class="breadcrumb-item active">Detail Payment</li>
            </ol>
          </div>
        </div>
      </div>{{-- /.container-fluid --}}
    </section>

    {{-- Main content --}}
    <section class="content">
      <div class="container-fluid">

        @php
          $total = 0;
          foreach($invoice->detail as $i){
            $total += $i->reconcile->reconcile_klien_total;
          }
        @endphp
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row">

                <div class="col-3">
                  Total : Rp {{number_format($total,0,',','.')}}
                </div>

                <div class="col-3">
                  Sisa : Rp {{number_format($total - $payment->sum('payment_bayar'),0,',','.')}}
                </div>

                <div class="col-3">
                  Jumlah Cicilan : {{$payment->count()}}
                </div>

                <div class="col-3">
                  @if($payment->sum('payment_bayar') <= $total && $invoice->invoice_status != 1)
                    <a href="#" class="btn btn-xs btn-link text-danger"><i class="fas fa-times"></i> Belum Lunas</a>
                  @endif
                  @if($payment->sum('payment_bayar') >= $total && $invoice->invoice_status != 1)
                    <a href="{{route('payment.belum.lunas',$invoice->invoice_id)}}" class="btn btn-xs btn-link text-warning"><i class="fas fa-exclamation"></i> Tekan Jika Sudah Lunas</a>
                  @endif
                  @if($invoice->invoice_status == 1)
                    <a href="#" class="btn btn-xs btn-link text-success"><i class="fas fa-check"></i> Lunas</a>
                  @endif
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
                <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Jumlah Bayar</th>
                    <th>Tanggal Bayar</th>
                    @if($invoice->invoice_status != 1)
                    <th></th>
                    @endif
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($payment as $r)
                  <tr>
                    <td class="text-right">{{$loop->iteration}}</td>
                    <td>Rp {{number_format($r->payment_bayar,0,',','.')}}</td>
                    <td>{{$r->payment_tanggal}}</td>
                    @if($invoice->invoice_status != 1)
                    <td class="text-center">
                      <a href="#" data-target="#modal-edit{{$r->payment_id}}" data-toggle="modal" class="btn btn-xs btn-link"  title="Edit"><span class="fa fa-edit" ></span></a>
                      <a href="#" data-target="#modal-hapus{{$r->payment_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
                    </td>
                    @endif
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
      <form action="{{route('payment.belum.store')}}" method="POST"> @csrf
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Detail Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-group">
              <label for="payment">Bayar</label>
              <input type="text" name="payment" class="form-control uang" id="payment" required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal">
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

  @foreach($payment as $d)
  <div class="modal fade" id="modal-edit{{$r->payment_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('payment.belum.update',$r->payment_id)}}" method="POST"> @csrf @method('PUT')
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Edit Detail Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <div class="form-group">
              <label for="payment">Bayar</label>
              <input type="text" name="payment" class="form-control uang" id="payment" value="{{$r->payment_bayar}}">
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" id="tanggal" value="{{$r->payment_tanggal}}">
          </div>
          <input type="hidden" name="invoice" value="{{$invoice->invoice_id}}">
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Edit</button>
        </div>
      </form>
      </div>
      {{-- /.modal-content --}}
    </div>
    {{-- /.modal-dialog --}}
  </div>
  {{-- /.modal --}}
  @endforeach
  
  @foreach($payment as $r)
    <div class="modal fade" id="modal-hapus{{$r->payment_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('payment.delete',$r->payment_id)}}" method="post">@csrf @method('DELETE')
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus detail Invoice ? {{$r->payment_id}}</h3>
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
