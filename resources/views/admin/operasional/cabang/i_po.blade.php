@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('po','active')

@section('content')

 {{-- Content Header (Page header) --}}
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 mb-2">
          <h1>Manage PO</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item"><a href="#">Manage PO</a></li>
            <li class="breadcrumb-item active">Tambah PO</li>
          </ol>
        </div>
      </div>
    </div>{{-- /.container-fluid --}}
  </section>

  {{-- Main content --}}
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Tambah PO</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">
            <form action="{{route('po.store')}}" method="POST">@csrf

              <input type="hidden" name="kontrak" value="{{$kontrak->kontrak_id}}">
                
                <div class="form-group">
                  <label for="inputStatus">Pilih PIC</label>
                  <select class="form-control select2bs4" name="pic">
                    <option selected disabled>-- Pilih PIC --</option>
                    @foreach ($pic as $p)
                    <option value="{{$p->pic_id}}">{{$p->pic_nama}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="tgl_po">Tgl PO</label>
                  <input type="date" id="tgl_po" class="form-control" name="tgl_po">
                </div>

                <div class="form-group">
                  <label for="kd_po">KD PO</label>
                  <input type="text" id="kd_po" class="form-control" name="kd_po">
                </div>

                <div class="form-group">
                  <label for="mdi_ke">MDI-Ke</label>
                  <input type="text" id="mdi_ke" class="form-control" name="mdi_ke" value="{{$kontrak->kontrak_mdi_ke}}">
                </div>

                {{-- <div class="form-group">
                  <label for="mdi_dasar">MDI-Dasar</label>
                  <input type="hidden" id="mdi_dasar" class="form-control" name="mdi_dasar" value="{{$kontrak->kontrak_mdi_dasar}}">
                </div> --}}
                
                <div class="form-group">
                  <label for="mdi_tambahan">MDI</label>
                  <input type="text" id="mdi_tambah" class="form-control uang" name="mdi_tambahan" value="{{$kontrak->kontrak_mdi_tambahan}}">
                </div>

                {{-- MDI --}}
                <div class="form-group">
                  <input type="hidden" id="mdk_ke" class="form-control" name="mdk_ke" value="{{$kontrak->kontrak_mdk_ke}}">
                  <input type="hidden" id="mdk_dasar" class="form-control" name="mdk_dasar" value="{{$kontrak->kontrak_mdk_dasar}}">
                  <input type="hidden" id="mdk_tambahan" class="form-control" name="mdk_tambahan" value="{{$kontrak->kontrak_mdk_tambahan}}">
                </div>
                {{-- /MDI --}}

                <div class="form-group">
                  <label for="inputName">Catatan</label>
                  <input type="text" id="inputName" class="form-control" name="cat">
                </div>

            </div>
          </div>
          {{-- /.card-body --}}
        </div>
        {{-- /.card --}}
      </div>
      <div class="row">
        <div class="col-12">
          <a href="{{route('po.index')}}" class="btn btn-secondary">Batal</a>
          <input type="submit" value="Tambah PO" class="btn btn-success float-right">
        </div>
      </div>
      </form>
  </section>
  {{-- /.content --}}

@push('css')
  {{-- Select2 --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push('js')

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
