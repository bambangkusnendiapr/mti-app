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
            <h1>Barang</h1>
          </div>
          <div class="col-sm-6">

          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Operasional</a></li>
              <li class="breadcrumb-item">Manage Surat Jalan</li>
              <li class="breadcrumb-item active">Detail Barang</li>
            </ol>
          </div>
        </div>
      </div>{{-- /.container-fluid --}}
    </section>

    {{-- Main content --}}
    <section class="content">
      <div class="container-fluid">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"> <strong>Store :</strong>
                @foreach($sj->budget->bstore as $r)
                    {{$r->store->store_kode}},
                  @endforeach
              </h3>
              <a href="#" data-target="#modal-tambah"  data-toggle="modal" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Barang</a>
            </div>
            {{-- /.card-header --}}
            <div class="card-body">

              <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th width="25px">No</th>
                  <th>Banyaknya</th>
                  <th>Nama Barang</th>
                  <th>Berat</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($barang as $r)    
                <tr>
                  <td class="text-right" width="25px">{{$loop->iteration}}</td>
                  <td>{{$r->sj_barang_banyak}}</td>
                  <td>{{$r->sj_barang_nama}}</td>
                  <td>{{$r->sj_barang_berat}}</td>
                  
                  <td class="text-center">
                    
                    <a href="#" data-target="#modal-edit{{$r->sj_barang_id}}" data-toggle="" class="btn btn-xs btn-link"  title="Edit"><span class="fa fa-edit" ></span></a>
                    <a href="#" data-target="#modal-hapus{{$r->sj_barang_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
                    
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



  <div id="modal-tambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{route('sjbarang.store')}}" method="post">@csrf
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="surat_jalan" value="{{$sj->surat_jalan_id}}">
          <div class="form-group">
              <label for="banyak">Banyak</label>
              <input id="banyak" class="form-control" type="number" name="banyak">
          </div>
          <div class="form-group">
            <label for="nama">Nama Barang</label>
            <input id="nama" class="form-control" type="text" name="nama">
          </div>
          <div class="form-group">
            <label for="berat">Berat Barang</label>
            <input id="berat" class="form-control" type="text" name="berat">
          </div>
            <button class="btn btn-primary float-right" type="submit">Tambah</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  @foreach ($barang as $r)
  <div id="modal-edit{{$r->sj_barang_id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{route('sjbarang.update',$r->sj_barang_id)}}" method="post">@csrf @method('PUT')
        <div class="modal-header">
          <h4 class="modal-title">Edit Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
              <label for="banyak">Banyak</label>
              <input id="banyak" class="form-control" type="number" name="banyak" value="{{$r->sj_barang_banyak}}">
          </div>
          <div class="form-group">
            <label for="nama">Nama Barang</label>
            <input id="nama" class="form-control" type="text" name="nama" value="{{$r->sj_barang_nama}}">
          </div>
          <div class="form-group">
            <label for="berat">Berat Barang</label>
            <input id="berat" class="form-control" type="text" name="berat" value="{{$r->sj_barang_berat}}">
          </div>
            <button class="btn btn-primary float-right" type="submit">Ubah</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  @endforeach
  
  @foreach ($barang as $r)
  <div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('sjbarang.destroy',$r->sj_barang_id)}}" method="post">@csrf @method('DELETE')
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center text=danger">
          <h3>Apakah anda yakin ingin menghapus Barang <u><strong>{{$r->sj_barang_nama}}</strong></u> ?</h3>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">YA! Hapus Data</button>
        </div>
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
