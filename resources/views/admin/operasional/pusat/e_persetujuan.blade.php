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
          <h1>Persetujuan Budget</h1>
        </div>
        <div class="col-sm-6">
          {{-- <a href="#" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah PO</a> --}}

        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item active">Persetujuan Budget</li>
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
              <form action="{{route('persetujuanbudget.update',$budget->budget_id)}}" method="post">
                @csrf @method('PUT')
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tarif">Tarif</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-success" id="tarif">Rp</span>
                        </div>
                        <input id="tarif" class="form-control bg-white" type="text" name="tarif" value="{{$budget->bstore->max('budgetstore_klien_tarif')}}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="tarifed">&nbsp;</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="tarifed">+/-</span>
                        </div>
                        <input id="tarifed" class="form-control" type="number" name="tarifed" value="{{ $budget->budget_tarif - $budget->bstore->max('budgetstore_klien_tarif')}}">
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="uj">Uang Jalan</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-success" id="uj">Rp</span>
                        </div>
                        <input id="uj" class="form-control bg-white" type="text" name="uj" value="{{$budget->bstore->max('budgetstore_mti_uang_jalan')}}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="ujed">&nbsp;</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="ujed">+/-</span>
                        </div>
                        <input id="ujed" class="form-control" type="number" name="ujed" value="{{$budget->budget_uang_jalan - $budget->bstore->max('budgetstore_mti_uang_jalan')}}">
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">

                  @php
                    if($budget->budget_mdi != null){
                    
                      $mdi          = 0;
                      $jstore       = $budget->bstore->count();
                      $mdi_tambahan = $jstore - $budget->po->po_mdi_ke;
                      
                      if($jstore > $budget->po->po_mdi_ke){
                        $mdi = $budget->po->po_mdi_dasar + ($mdi_tambahan * $budget->po->po_mdi_tambahan);
                      }

                    }else{
                      $mdi = $budget->budget_mdi;
                    }

                    if($budget->budget_mdk != null){
                    
                      $mdk          = 0;
                      $jstore       = $budget->bstore->count();
                      $mdk_tambahan = $jstore - $budget->po->po_mdk_ke;
                      
                      if($jstore > $budget->po->po_mdk_ke){
                        $mdk = $budget->po->po_mdk_dasar + ($mdk_tambahan * $budget->po->po_mdk_tambahan);
                      }

                    }else{
                      $mdk = $budget->budget_mdk;
                    }

                  @endphp

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mdk">MDK</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-success" id="mdk">Rp</span>
                        </div>
                        <input id="mdk" class="form-control bg-white" type="text" name="mdk" value="{{$mdk}}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mdked">&nbsp;</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="mdked">+/-</span>
                        </div>
                        <input id="mdked" class="form-control" type="number" name="mdked" value="{{$budget->budget_mdk - $mdk}}">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mdi">MDI</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text bg-success" id="mdi">Rp</span>
                        </div>
                        <input id="mdi" class="form-control bg-white" type="text" name="mdi" value="{{$mdi}}" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mdied">&nbsp;</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="mdied">+/-</span>
                        </div>
                        <input id="mdied" class="form-control" type="number" name="mdied" value="{{$budget->budget_mdi - $mdi}}">
                      </div>
                    </div>
                  </div>

                </div>

                <input type="submit" value="Setujui" class="btn btn-primary float-right ">
                <input type="Reset" value="Batal" class="btn btn-danger float-left ">

              </form>
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
@endpush

@endsection
