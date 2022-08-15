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
            <h1>Manage Kontrak</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{route('kontrak.create')}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah kontrak</a>

          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Pemasaran</a></li>
              <li class="breadcrumb-item active">Manage Kontrak</li>
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
                <table id="example1" class="table table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Kontrak</th>
                    <th>Nama Klien</th>
                    <th>Mulai Kontrak</th>
                    <th>Selesai Kontrak</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach($kontrak as $r)
                  <tr>
                    <td class="text-right">{{$no++}}</td>
                    <td>{{$r->kontrak_kode}}</td>
                    <td>{{$r->kontrak_klien_nama}}</td>
                    <td>{{$r->kontrak_mulai}}</td>
                    <td>{{$r->kontrak_selesai}}</td>
                    <td class="text-right">
                        <div class="btn-group" role="group" aria-label="Button group">

                            <a href="{{route('kontrak.show',$r->kontrak_id)}}" class="btn btn-sm btn-link"><span class="fa fa-eye" title="view"></span></a>

                            <a href="{{route('kontrak.edit',$r->kontrak_id)}}" class="btn btn-sm btn-link" title="edit"><span class="fa fa-edit"></span></a>
                            <a href="#" data-target="#modal-hapus{{$r->kontrak_id}}" data-toggle="modal" class="btn btn-sm btn-link" title="hapus"><span class="fa fa-trash"></span></a>
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



  @foreach($kontrak as $r)
    <div class="modal fade" id="modal-hapus{{$r->kontrak_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="{{route('kontrak.destroy',$r->kontrak_id)}}">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus kontrak <u><strong>{{$r->kontrak_kode}}</strong></u> ?</h3>
          </div>
          <div class="modal-footer justify-content-between">
            @csrf @method('DELETE')
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
        "responsive": true,
        "autoWidth": false,
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

      //Datepicker
      $('#reservation').datetimepicker({
          format: 'L'
      });
      $('#reservationdate').datetimepicker({
          format: 'L'
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
