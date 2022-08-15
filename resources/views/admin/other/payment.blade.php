@extends('layouts.admin.master')

@section('other-open', 'menu-open')

@section('other-active', 'active')

@section('purchasing', 'active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Payment</h1>
        </div>
        <div class="col-sm-6">
          <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Payment</a>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Other</a></li>
              <li class="breadcrumb-item"><a href="{{route('purchasing.index')}}">Purchasing</a></li>
              <li class="breadcrumb-item active">Payment {{$purchasing->partner->partner_nama}}</li>
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
              <table id="example1" class="table table-striped text-nowrap table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Uraian</th>
                  <th>Satuan</th>
                  <th>Banyak</th>
                  <th>Harga Satuan</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($payment as $r)
                <tr>
                  <td class="text-center">{{$loop->iteration}}</td>
                  <td>{{$r->payment_partner_tgl}}</td>
                  <td>{{$r->payment_partner_uraian}}</td>
                  <td>{{$r->payment_partner_satuan}}</td>
                  <td>{{$r->payment_partner_banyak}}</td>
                  <td>Rp {{number_format($r->payment_partner_harga_satuan,0,',','.')}}</td>
                  <td>Rp {{number_format($r->payment_partner_jumlah,0,',','.')}}</td>
                  <td>{{$r->payment_partner_keterangan}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Button group">
                      <a href="#" data-target="#modal-edit{{$r->payment_partner_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                      <a href="#" data-target="#modal-hapus{{$r->payment_partner_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
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
      <form action="{{route('purchasing.payment.store')}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Payment</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf
          <input type="hidden" name="purchasing" value="{{$purchasing->purchasing_id}}">
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" class="form-control" name="tanggal">
          </div>
          <div class="form-group">
            <label for="uraian">Uraian</label>
            <textarea name="uraian" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" id="satuan" class="form-control" name="satuan">
          </div>
          <div class="form-group">
            <label for="banyak">Banyak</label>
            <input type="text" id="banyak" class="form-control uang" name="banyak">
          </div>
          <div class="form-group">
            <label for="harga">Harga Satuan</label>
            <input type="text" id="harga" class="form-control uang" name="harga" required>
          </div>
          <div class="form-group">
            <label for="ket">Keterangan</label>
            <textarea name="ket" class="form-control"></textarea>
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

  @foreach($payment as $r)
  <div class="modal fade" id="modal-edit{{$r->payment_partner_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('purchasing.payment.update',$r->payment_partner_id)}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Edit Purchasing</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @csrf @method('PUT')
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" id="tanggal" class="form-control" name="tanggal" value="{{$r->payment_partner_tgl}}">
          </div>
          <div class="form-group">
            <label for="uraian">Uraian</label>
            <textarea name="uraian" class="form-control">{{$r->payment_partner_uraian}}</textarea>
          </div>
          <div class="form-group">
            <label for="satuan">Satuan</label>
            <input type="text" id="satuan" class="form-control" name="satuan" value="{{$r->payment_partner_satuan}}">
          </div>
          <div class="form-group">
            <label for="banyak">Banyak</label>
            <input type="text" id="banyak" class="form-control uang" name="banyak" value="{{$r->payment_partner_banyak}}">
          </div>
          <div class="form-group">
            <label for="harga">Harga Satuan</label>
            <input type="text" id="harga" class="form-control uang" name="harga" value="{{$r->payment_partner_harga_satuan}}" required>
          </div>
          <div class="form-group">
            <label for="ket">Keterangan</label>
            <textarea name="ket" class="form-control">{{$r->payment_partner_keterangan}}</textarea>
          </div>
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
    <div class="modal fade" id="modal-hapus{{$r->payment_partner_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="{{route('purchasing.payment.destroy',$r->payment_partner_id)}}">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus data Payment ?</h3>
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

  <script>
    $(function () {
      $("#example1").DataTable({
          "scrollX":true,
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

          @if ($errors->has('nopol'))
          Toast.fire({
              icon: 'error',
              title: " {{$errors->first('nopol')}}"
          })
          @endif

      });
  </script>
  {{-- Input mask --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.uang').mask('000.000.000.000', {reverse: true});
    });
  </script>
@endpush

@endsection
