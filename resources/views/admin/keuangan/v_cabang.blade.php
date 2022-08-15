@extends('layouts.admin.master')

@section('menu-keuangan','menu-open')

@section('keuangan','active')

@section('keuangan-cabang','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Keuangan Cabang</h1>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
            <li class="breadcrumb-item active">Keuangan Cabang</li>
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
            <div class="card-header">
              <b>Total : Rp {{number_format($pengeluaran->sum('pengeluaran_nominal'),0,',','.')}}</b>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="{{ route('keuangan.cabang') }}">
                    <div class="input-group">
                      <select name="search" required class="form-control">
                        <option value="">--Pilih Kontrak--</option>
                        @foreach($kontrak as $k)
                        <option value="{{ $k->kontrak_id }}" {{ request('search') == $k->kontrak_id ? 'selected':'' }}>{{ $k->kontrak_klien_nama }}</option>
                        @endforeach
                      </select>
                      <!-- <input type="text" class="" name="search" value="{{ request('search') }}" placeholder="Cari Uraian / Keterangan"> -->
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat">Cari</button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>

              <br>

              <table id="example1" class="table table-striped" width="100%" cellspacing="0">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Keterangan</th>
                  <th>Nominal</th>
                  <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pengeluaran as $r)
                <tr>
                  <td class="text-right">{{$loop->iteration}}</td>
                  <td>{{$r->pengeluaran_ket}}</td>
                  <td>Rp {{number_format($r->pengeluaran_nominal,0,',','.')}}</td>
                  <td>{{$r->pengeluaran_tgl}}</td>
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