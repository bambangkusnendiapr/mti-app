@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('po','active')

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Manage PO</h1>
          </div>
          <div class="col-sm-6">
            <a href="{{route('po.create')}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah PO</a>

          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Operasional</a></li>
              <li class="breadcrumb-item active">Manage PO</li>
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
                    <th>KD PO</th>
                    <th>Nama PIC</th>
                    <th>Tanggal PO</th>
                    <th>Budgeting</th>
                    {{-- <th>Koreksi</th> --}}
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($po as $p)
                  <tr>
                    <td class="text-right">{{$loop->iteration}}</td>
                    <td>{{$p->po_kode}}</td>
                    <td>{{$p->pic->pic_nama}}</td>
                    <td>{{$p->po_tanggal}}</td>

                    <td class="text-center">
                        <a href="#" data-target="#modal-detail{{$p->po_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Detail"><span class="fa fa-eye"></span></a>
                        <a href="{{ route('budget.show',$p->po_id) }}" data-target="" data-toggle="" class="btn btn-xs btn-link" title="Budget"><span class="fa fa-plus"></span></a>
                    </td>

                    {{-- <td class="text-center">
                      <a href="{{route('koreksipo.show',$p->po_id)}}" data-target="" data-toggle="" class="btn btn-xs btn-link" title="Koreksi"><span class="fa fa-calculator"></span></a>
                    </td> --}}

                    <td class="text-center">

                        <a href="{{route('po.edit',$p->po_id)}}" class="btn btn-xs btn-link"  title="Edit"><span class="fa fa-edit"></span></a>
                        <a href="#" data-target="#modal-hapus{{$p->po_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>

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

  @foreach($po as $p)
    <div class="modal fade" id="modal-hapus{{$p->po_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="{{route('po.destroy',$p->po_id)}}">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Peringatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center text=danger">
              <h3>Apakah anda yakin ingin menghapus PO <u><strong>{{$p->po_kode}}</strong></u> ?</h3>
            </div>
            <div class="modal-footer justify-content-between">@csrf @method('DELETE')
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

    @foreach($po as $p)
      <div class="modal fade" id="modal-detail{{$p->po_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Detail Kendaraan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center p-0">
              <table class="table table-striped nowrap">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Kendaraan</th>
                        <th>Nopol</th>
                        <th>Store</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no=1; @endphp
                    @foreach($p->budget as $b)
                    <tr>
                        <td>{{$no++}}</td>
                        <td>{{$b->jenis->jenis_kendaraan_nama}}</td>
                        <td>{{$b->kendaraan->kendaraan_nopol}}</td>
                        <td>
                          @foreach($b->bstore as $bs)
                            <p>{{$bs->store->store_kode}}</p>
                          @endforeach
                        </td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>
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
