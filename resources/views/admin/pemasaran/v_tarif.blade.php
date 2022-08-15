@extends('layouts.admin.master')

@section('pemasaran-open','menu-open')

@section('pemasaran-active','active')

@section('kontrak-active','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Daftar Tarif {{$store->store_nama}}</h1>
        </div>
        <div class="col-sm-6">
          <form method="post" action="{{route('tarif.create')}}">
            @csrf
            <input type="hidden" name="store" value="{{$store->store_id}}">
            <a href="#" data-target="#importExcel" data-toggle="modal" class="btn btn-success float-right btn-sm"><span class="fas fa-file-excel"></span> Import Excel</a>
            <button class="btn btn-primary btn-sm float-right mr-2" type="submit"><span class="fa fa-plus">&nbsp;</span>Tambah Tarif</button>
          </form>
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{route('kontrak.index')}}">Pemasaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('kontrak.index')}}">Kontrak</a></li>
            <li class="breadcrumb-item"><a href="{{route('kontrak.show',$store->kontrak->kontrak_id)}}">{{$store->kontrak->kontrak_klien_nama}}</a></li>
            <li class="breadcrumb-item active">Daftar Tarif {{$store->store_nama}}</li>
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
              <table id="example1" class="table table-striped table-lg text-nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Mobil</th>
                  <th>Tarif Klien</th>
                  <!--<th>Bongkar Muat Klien</th>-->
                  <!--<th>Biaya Lain Klien</th>-->
                  <th>Uang Jalan</th>
                  <!--<th>Bongkar Muat</th>-->
                  <!--<th>Ritase</th>-->
                  <!--<th>Biaya Lain MTI</th>-->
                  <th>Ket</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @php $no=1; @endphp
                @foreach ($tarif as $t)  
                <tr>
                  <td class="text-right">{{$no++}}</td>
                  <td>{{$t->jenis->jenis_kendaraan_nama}}</td>
                  <td>Rp {{number_format($t->tarif_klien,0,',','.')}}</td>
                  <!--<td>Rp {{number_format($t->tarif_klien_bongkar_muat,0,',','.')}}</td>-->
                  <!--<td>Rp {{number_format($t->tarif_klien_lain,0,',','.')}}</td>-->
                  <td>Rp {{number_format($t->tarif_mti_uang_jalan,0,',','.')}}</td>
                  <!--<td>Rp {{number_format($t->tarif_mti_bongkar_muat,0,',','.')}}</td>-->
                  <!--<td>Rp {{number_format($t->tarif_mti_ritase,0,',','.')}}</td>-->
                  <!--<td>Rp {{number_format($t->tarif_mti_lain,0,',','.')}}</td>-->
                  <td>{{$t->tarif_keterangan}}</td>
                  <td class="text-center">
                      <div class="btn-group" role="group" aria-label="Button group">
                          <a href="{{route('tarif.edit',$t->tarif_id)}}" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                          <a href="#" data-target="#modal-hapus{{$t->tarif_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
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

  @foreach($tarif as $t)
    <div class="modal fade" id="modal-hapus{{$t->tarif_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="{{route('tarif.destroy',$t->tarif_id)}}">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus Tarif ini ?</h3>
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

  <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{route('tarif.import')}}" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
          </div>
          <div class="modal-body">

            {{ csrf_field() }}

            <label>Pilih file excel</label>
            <div class="form-group">
              <input type="file" name="file" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Import</button>
          </div>
        </div>
      </form>
    </div>
  </div>

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
          "scrollX": true
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false,

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

        @if ($errors->has('file'))
        Toast.fire({
            icon: 'error',
            title: "{{ $errors->first('file') }}"
        })
        @endif

    });
  </script>
@endpush

@endsection
