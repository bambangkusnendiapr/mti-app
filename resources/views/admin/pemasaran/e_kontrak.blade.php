@extends('layouts.admin.master')

@section('pemasaran-open','menu-open')

@section('pemasaran-active','active')

@section('kontrak-active','active')

@section('content')

 {{-- Content Header (Page header) --}}
 <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12 mb-2">
          <h1>Manage Kontrak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="#">Pemasaran</a></li>
            <li class="breadcrumb-item"><a href="#">Manage Kontrak</a></li>
            <li class="breadcrumb-item active">Edit Kontrak {{$kontrak->kontrak_kode}}</li>
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
            <h3 class="card-title">Edit Kontrak</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
          </div>
          <form action="{{route('kontrak.update',$kontrak->kontrak_id)}}" method="POST">

          <div class="card-body">
            
            @csrf @method('PUT')

            <div class="form-group">
              <label for="username">Username*</label>
              <input type="text" id="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $kontrak->krani->email }}" disabled>
              @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label for="nama_klien">Nama Klien</label>
              <input type="text" id="nama_klien" class="form-control{{ $errors->has('nama_klien') ? ' is-invalid' : '' }}" name="nama_klien" value="{{ $kontrak->kontrak_klien_nama }}" required>
              @if ($errors->has('nama_klien'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nama_klien') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label for="alamat_klien">Alamat Klien</label>
              <input type="text" id="alamat_klien" class="form-control{{ $errors->has('alamat_klien') ? ' is-invalid' : '' }}" name="alamat_klien" value="{{ $kontrak->kontrak_klien_alamat }}">
              @if ($errors->has('alamat_klien'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat_klien') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label>Mulai Kontrak:</label>
              <input type="date" id="mulai" class="form-control{{ $errors->has('mulai') ? ' is-invalid' : '' }}" name="mulai" value="{{ $kontrak->kontrak_mulai }}"/>
              @if ($errors->has('mulai'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('mulai') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label>Selesai Kontrak:</label>
              <input type="date" id="selesai" class="form-control{{ $errors->has('selesai') ? ' is-invalid' : '' }}" name="selesai" value="{{ $kontrak->kontrak_selesai }}"/>
              @if ($errors->has('selesai'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('selesai') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group">
              <label for="mdi_ke">MDI-Ke</label>
              <input type="text" id="mdi_ke" class="form-control{{ $errors->has('mdi_ke') ? ' is-invalid' : '' }}" name="mdi_ke" value="{{ $kontrak->kontrak_mdi_ke }}">
              @if ($errors->has('mdi_ke'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mdi_ke') }}</strong>
                </span>
              @endif
            </div>

            {{-- <div class="form-group">
              <label for="mdi_dasar">MDI-Dasar</label>
              <input type="text" id="mdi_dasar" class="form-control{{ $errors->has('mdi_dasar') ? ' is-invalid' : '' }}" name="mdi_dasar" value="{{ $kontrak->kontrak_mdi_dasar }}">
              @if ($errors->has('mdi_dasar'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mdi_dasar') }}</strong>
                </span>
              @endif
            </div> --}}

            <div class="form-group">
              <label for="mdi_tambahan">MDI-Tambahan</label>
              <input type="text" id="mdi_tambahan" class="form-control{{ $errors->has('mdi_tambahan') ? ' is-invalid' : '' }} uang" name="mdi_tambahan" value="{{ $kontrak->kontrak_mdi_tambahan }}">
              @if ($errors->has('mdi_tambahan'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mdi_tambahan') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label for="mdk_ke">MDK-Ke</label>
              <input type="text" id="mdk_ke" class="form-control{{ $errors->has('mdk_ke') ? ' is-invalid' : '' }}" name="mdk_ke" value="{{ $kontrak->kontrak_mdk_ke }}">
              @if ($errors->has('mdk_ke'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mdk_ke') }}</strong>
                </span>
              @endif
            </div>

            {{-- <div class="form-group">
              <label for="mdk_dasar">MDK-Dasar</label>
              <input type="text" id="mdk_dasar" class="form-control{{ $errors->has('mdk_dasar') ? ' is-invalid' : '' }}" name="mdk_dasar" value="{{ $kontrak->kontrak_mdk_dasar }}">
              @if ($errors->has('mdk_dasar'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mdk_dasar') }}</strong>
                </span>
              @endif
            </div> --}}

            <div class="form-group">
              <label for="mdk_tambahan">MDK</label>
              <input type="text" id="mdk_tambahan" class="form-control{{ $errors->has('mdk_tambahan') ? ' is-invalid' : '' }} uang" name="mdk_tambahan" value="{{ $kontrak->kontrak_mdk_tambahan }}">
              @if ($errors->has('mdk_tambahan'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('mdk_tambahan') }}</strong>
                </span>
              @endif
            </div>

            <div class="form-group">
              <label for="pajak">Pajak</label>
              <input type="text" id="pajak" class="form-control{{ $errors->has('pajak') ? ' is-invalid' : '' }}" name="pajak" value="{{ $kontrak->kontrak_pajak }}">
              @if ($errors->has('pajak'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('pajak') }}</strong>
                </span>
              @endif
            </div>

          </div>
          {{-- /.card-body --}}

          <div class="card-footer">
            <div class="row">
                <div class="col-12">
                  <a href="{{route('kontrak.index')}}" class="btn btn-secondary">Batal</a>
                  <input type="submit" value="Tambah Kontrak" class="btn btn-success float-right">
                </div>
              </div>
          </div>

          </form>

        </div>
        {{-- /.card --}}

      </div>
      {{-- col-md-12 --}}

    </div>
    {{-- row --}}

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
      
      $('.select2').select2()

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
