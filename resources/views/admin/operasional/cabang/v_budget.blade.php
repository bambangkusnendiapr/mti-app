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
          <h1>Budgeting</h1>
        </div>
        <div class="col-sm-6">
          <a href="{{route('budget.create',$po->po_id)}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Budgeting</a>

        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item">Manage PO</li>
            <li class="breadcrumb-item active">Budgeting</li>
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

            <div class="card-body">


              <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th width="25px">No</th>
                  <th>Jenis Kendaraan</th>
                  <th>Nopol</th>
                  <th>Driver</th>
                  <th>Store</th>
                  <th>Koreksi</th>
                  <th>Total Standar</th>
                  <th>Total MDI</th>
                  <th>Total Koreksi</th>
                  <th>Ajukan</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($budget as $b)
                @php
                if($b->budget_mdi == null){
                  $mdi          = 0;
                  $jstore       = $b->bstore->count();
                  $mdi_tambahan = $jstore - $b->po->po_mdi_ke;
                  
                  if($jstore >= $b->po->po_mdi_ke){
                    $mdi = $b->po->po_mdi_dasar + ($mdi_tambahan * $b->po->po_mdi_tambahan);
                  }

                }else{
                  $mdi = $b->budget_mdi;
                }
                @endphp
                <tr>
                  <td class="text-right" width="25px">{{$loop->iteration}}</td>
                  <td>{{$b->jenis->jenis_kendaraan_nama}}</td>
                  <td>{{$b->kendaraan->kendaraan_nopol}}</td>
                  <td>{{$b->driver->driver_nama}}</td>
                  <td class="text-center">
                    @if($b->budget_status != 1)
                      <a href="#" data-target="#modal-store-view{{$b->budget_id}}" data-toggle="modal" class="btn btn-xs btn-link text-info"  title="View"><span class="fa fa-eye" ></span></a>
                      <a href="{{$b->budget_id}}" data-target="#modal-store-create" data-toggle="modal" class="btn btn-xs btn-link text-info create" data-value="{{$b->budget_id}}" title="Store"><span class="fa fa-plus" ></span></a>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($b->budget_status != 1)
                      <a href="{{route('koreksipo.show',$b->budget_id)}}" data-target="" data-toggle="" class="btn btn-xs btn-link" title="Koreksi"><span class="fa fa-calculator"></span></a>
                    @endif
                  </td>
                  <td>Rp {{number_format($b->bstore->max('budgetstore_mti_uang_jalan'),0,',','.')}}</td>
                  <td>Rp {{number_format($mdi,0,',','.')}}</td>
                  <td>Rp {{number_format($b->koreksi->sum('koreksi_po_uang_jalan'),0,',','.')}}</td>
                  <td class="text-center">
                    @if($b->budget_status == null)
                      <a href="#" data-target="#modal-md{{$b->budget_id}}" data-toggle="modal" class="btn btn-xs btn-link text-success"  title="View"><span class="fa fa-check"></span></a>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($b->budget_status == null)
                      <a href="{{route('budget.edit',$b->budget_id)}}" class="btn btn-xs btn-link"  title="Edit"><span class="fa fa-edit" ></span></a>
                      <a href="#" data-target="#modal-hapus{{$b->budget_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
                    @endif
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

  @foreach($budget as $r)
  <div class="modal fade" id="modal-hapus{{$r->budget_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('budget.destroy',$r->budget_id)}}" method="post"></form>
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center text=danger">
          <h3>Apakah anda yakin ingin menghapus data Budget ?</h3>
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

  {{-- BudgetStore --}}
  <div class="modal fade" id="modal-store-create">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Store</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{route('budgetstore.store')}}" method="post"> @csrf
            <div class="form-group">
                
              <div class="row">
                <div class="form-group col-md-12">
                  <label for="store">Store Name</label>
                  <select id="store" class="form-control select2bs4 store" name="store">
                    <option disabled selected>-- Pilih Store --</option>
                    @foreach ($store as $s)
                      <option value="{{$s->store_id}}">{{$s->store_kode}} - {{$s->store_nama}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row">

                <input type="hidden" name="budget_id" value="" id="budget_id" class="budget_id"/>

                <div class="col-md-6">
                  <div class="form-group" id="uang_jalan">
                    <input id="uang_jalan" class="form-control-plaintext uang_jalan" type="hidden" name="uang_jalan" value="" >
                  </div>
                </div>

                  <input class="form-control" type="hidden" name="tamkur" placeholder="" id="tamkur" value="">

              </div>
              
              <div class="form-group mt-2">
                <input type="submit" value="Simpan" class="btn btn-primary float-right">
                <input type="button" value="Batal" data-dismiss="modal" class="btn btn-danger float-left">
              </div>
              
            </form>

            </div>
        </div>
      </div>
      {{-- /.modal-content --}}
    </div>
    {{-- /.modal-dialog --}}
  </div>
  {{-- /.modal --}}
  
  @foreach($budget as $b)
  <div class="modal fade" id="modal-store-view{{$b->budget_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">List Store</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center p-0">
          <table class="table nowrap table-striped">

            <thead>
              <tr>
                <th style="width: 50px">No</th>
                <th>Kode Store</th>
                <th>Uang Jalan</th>
              </tr>
            </thead>
            <tbody>
            @foreach($b->bstore as $bs)
              <tr>
                <td style="width: 50px">{{$loop->iteration}}</td>
                <td>{{$bs->store->store_nama}}</td>
                <td>Rp {{number_format($bs->budgetstore_mti_uang_jalan,0,',','.')}}</td>
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

  @foreach($budget as $b)
  <div class="modal fade" id="modal-md{{$b->budget_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{route('budget.pengajuan',$b->budget_id)}}" method="post">@csrf @method('PUT')
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Uang Jalan dan Multidrop</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <div class="col-md-12">
            <label for="">Uang Jalan</label>
            <div class="form-group" id="buj">
              @if($b->budget_uang_jalan != null)
                <input id="buj" class="form-control" type="text" value="Rp {{number_format($b->budget_uang_jalan,0,',','.')}}" readonly/>
                <input id="buj" class="form-control" type="hidden" name="buj" value="{{$b->budget_uang_jalan}}" readonly/>
              @else
                <input id="buj" class="form-control" type="text" value="Rp {{number_format($b->bstore->max('budgetstore_mti_uang_jalan'),0,',','.')}}" readonly/>
                <input id="buj" class="form-control" type="hidden" name="buj" value="{{$b->bstore->max('budgetstore_mti_uang_jalan')}}" readonly/>
              @endif
            </div>
          </div>

          <input id="kt" type="hidden" name="kt" value="{{$b->bstore->max('budgetstore_klien_tarif')}}" readonly>
          
          @php
            if($b->budget_mdi == null){
            
              $mdi          = 0;
              $jstore       = $b->bstore->count();
              $mdi_tambahan = $jstore - $b->po->po_mdi_ke;
              
              if($jstore >= $b->po->po_mdi_ke){
                $mdi = $b->po->po_mdi_dasar + ($mdi_tambahan * $b->po->po_mdi_tambahan);
              }

            }else{
              $mdi = $b->budget_mdi;
            }

            if($b->budget_mdk == null){
            
              $mdk          = 0;
              $jstore       = $b->bstore->count();
              $mdk_tambahan = $jstore - $b->po->po_mdk_ke;
              
              if($jstore >= $b->po->po_mdk_ke){
                $mdk = $b->po->po_mdk_dasar + ($mdk_tambahan * $b->po->po_mdk_tambahan);
              }

            }else{
              $mdk = $b->budget_mdk;
            }

          @endphp

          <input id="mdk" type="hidden" name="mdk" value="{{$mdk}}" readonly>

          <div class="col-md-12">
            <label for="">Multidrop</label>
            <div class="form-group" id="mdi">
              <input id="mdi" class="form-control" type="text" value="Rp {{number_format($mdi,0,',','.')}}" readonly>
              <input id="mdi" class="form-control" type="hidden" name="mdi" value="{{$mdi}}" readonly>
            </div>
          </div>

          <div class="col-md-12">
            <label for="">Koreksi</label>
            <div class="form-group" id="mdi">
              <input id="mdi" class="form-control" type="text" name="koreksi" value="Rp {{number_format($b->koreksi->sum('koreksi_po_uang_jalan'),0,',','.')}}" readonly>
            </div>
          </div>

          <div class="form-group mt-2 mb-5">
            <input type="submit" value="Ajukan" class="btn btn-primary float-right">
            <input type="button" value="Batal" data-dismiss="modal" class="btn btn-danger float-left">
          </div>

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
  {{-- Select2 --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  {{-- Sweetalert --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  
@endpush

@push('js')

  {{-- DataTables --}}
  <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
  {{-- Select2 --}}
  <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
  
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
    </script>

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

        @if (session('error'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        })
        @endif

    });
  </script>

  <script>
    $(document).ready(function(){
        
      $('.create').on('click', function(){

        var id = $(this).attr("href");
        $('.budget_id').val('');
        $('.uang_jalan').val('');
        $('.budget_id').val(id);

        $('.store').on('change',function(e){
          var store = e.target.value;
          var id    = $(".budget_id").val();
      
          $.get('{{url('/tarif/get/')}}/'+id+'/'+store, function(data){
            $('.budget_id').val(id);
            $('.uang_jalan').val(data.tarif_mti_uang_jalan);
          });

        });
        
      });

    });
  </script>

@endpush

@endsection
