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
            <h1>Koreksi</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-target="#modal-tambah"  data-toggle="modal" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Koreksi</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Operasional</a></li>
              <li class="breadcrumb-item"><a href="{{route('po.index')}}">Manage PO</a></li>
              <li class="breadcrumb-item"><a href="{{route('budget.show',$budget->po->po_id)}}">Budgeting</a></li>
              <li class="breadcrumb-item active">Koreksi</li>
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
                <h3 class="card-title">Uang Jalan : Rp {{number_format($budget->bstore->max('budgetstore_mti_uang_jalan'),0,',','.')}}</h3>
              </div>
              {{-- /.card-header --}}
              <div class="card-body">

                <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th width="25px">No</th>
                    <th>Nama</th>
                    {{-- <th>Tarif</th> --}}
                    <th>Uang Jalan</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($kpo as $r)
                  <tr>
                    <td class="text-right" width="25px">{{$loop->iteration}}</td>
                    <td>{{$r->koreksi->koreksi_nama}}</td>
                    {{-- <td>{{$r->koreksi_po_tarif}}</td> --}}
                    <td>{{$r->koreksi_po_uang_jalan}}</td>

                    <td class="text-center">

                      <a href="#" data-target="#modal-edit{{$r->koreksi_po_id}}" data-toggle="modal" class="btn btn-xs btn-link"  title="Edit"><span class="fa fa-edit" ></span></a>
                      <a href="#" data-target="#modal-hapus{{$r->koreksi_po_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>

                    </td>
                  </tr>
                  @endforeach
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

          <form action="{{route('koreksipo.store')}}" method="post">@csrf

          <div class="modal-header bg-primary">
              <h5 class="modal-title" id="my-modal-title">Tambah Koreksi</h5>
              <button class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <input type="hidden" name="budget" value="{{$budget->budget_id}}">

            <input type="hidden" name="po" value="{{$budget->po->po_id}}">

            <input type="hidden" name="kontrak" value="{{$budget->po->kontrak->kontrak_id}}">

            <div class="form-group">
              <label for="koreksi">Nama Koreksi</label>
              <select id="koreksi" class="form-control koreksi" name="koreksi">
                <option disabled selected>-- Pilih Koreksi --</option>
                @foreach($koreksi as $k)
                  <option value="{{$k->koreksi_id}}">{{$k->koreksi_nama}}</option>
                @endforeach
              </select>
            </div>

            {{-- <div class="form-group"> --}}
              {{-- <label for="tarif">Tarif</label> --}}
              <input id="tarif" class="form-control tarif" type="hidden" name="tarif">
            {{-- </div> --}}

            <div class="form-group">
              <label for="uang_jalan">Uang Jalan</label>
              <input id="uang_jalan" class="form-control uang_jalan" type="text" name="uang_jalan">
            </div>

            <button class="btn btn-primary float-right" type="submit">Tambah</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>

          </div>

          </form>

        </div>
      </div>
    </div>

    @foreach($kpo as $r)
    <div id="modal-edit{{$r->koreksi_po_id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">

          <form action="{{route('koreksipo.update',$r->koreksi_po_id)}}" method="post">@csrf @method('PUT')

          <div class="modal-header bg-primary">
              <h5 class="modal-title" id="my-modal-title">Edit Koreksi PO</h5>
              <button class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <input type="hidden" name="budget" value="{{$budget->budget_id}}">

            <input type="hidden" name="po" value="{{$budget->po->po_id}}">

            <input type="hidden" name="kontrak" value="{{$budget->po->kontrak->kontrak_id}}">

            <div class="form-group">
              <label for="koreksi">Nama Koreksi</label>
              <select id="koreksi" class="form-control koreksi" name="koreksi">
                <option disabled selected>-- Pilih Koreksi --</option>
                @foreach($koreksi as $k)
                  <option value="{{$k->koreksi_id}}" {{$k->koreksi_id == $r->koreksi_id ? "selected" : "" }} >{{$k->koreksi_nama}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="tarif">Tarif</label>
              <input id="tarif" class="form-control tarif" type="text" name="tarif" value="{{$r->koreksi_po_tarif}}">
            </div>

            <div class="form-group">
              <label for="uang_jalan">Uang Jalan</label>
              <input id="uang_jalan" class="form-control uang_jalan" type="text" name="uang_jalan" value="{{$r->koreksi_po_uang_jalan}}">
            </div>

            <button class="btn btn-primary float-right" type="submit">Edit</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>

          </div>

          </form>

        </div>
      </div>
    </div>
    @endforeach

  @foreach($kpo as $r)
    <div class="modal fade" id="modal-hapus{{$r->koreksi_po_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('koreksipo.destroy',$r->koreksi_po_id)}}" method="post">@csrf @method('DELETE')
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus Data ini?</h3>
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

  <script>
    $(document).ready(function(){
    
      $('.koreksi').on('change', function(e){
        var id = e.target.value;
        $.get('{{url('/koreksi/get')}}/'+id, function(data){
          $('.tarif').empty();
          $('.uang_jalan').empty();
          $('.tarif').val(data.koreksi_tarif);
          $('.uang_jalan').val(data.koreksi_uang_jalan);
        });
      });

    });
  </script>

@endpush

@endsection
