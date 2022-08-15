@extends('layouts.admin.master')

@section('master-open', 'menu-open')

@section('master-active', 'active')

@section('kendaraan-active', 'active')

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Master Kendaraan</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Kendaraan</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item active">Master Kendaraan</li>
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
                <table id="example1" class="table table-striped text-nowrap table-bordered" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nopol</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Merk</th>
                    <th>Harga</th>
                    <th>Jangka Waktu</th>
                    <th>Jangka Waktu Sisa</th>
                    <th>Angsuran</th>
                    <th>Partner</th>
                    <th>Keterangan</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no=1; @endphp
                  @foreach($kendaraan as $r)
                  <tr>
                    <td class="text-right">{{$loop->iteration}}</td>
                    <td>
                      @if($r->kendaraan_plat == "Hitam")
                        <span class="bg-dark">{{$r->kendaraan_nopol}}</span>
                      @else
                        <span class="bg-warning">{{$r->kendaraan_nopol}}</span>
                      @endif
                      </td>
                    <td>{{$r->kendaraan_nama}}</td>
                    <td>{{$r->jenis->jenis_kendaraan_nama}}</td>
                    <td>{{$r->kendaraan_merk}}</td>
                    <td>Rp {{number_format($r->kendaraan_harga,0,',','.')}}</td>
                    <td>{{$r->kendaraan_jangka_waktu}}</td>
                    <td>{{$r->kendaraan_jangka_sisa}}</td>
                    <td>Rp {{number_format($r->kendaraan_angsuran,0,',','.')}}</td>
                    <td>{{$r->partner->partner_nama}}</td>
                    <td>{{$r->kendaraan_keterangan}}</td>
                    <td class="text-center">
                      <div class="btn-group" role="group" aria-label="Button group">
                          <a href="#" data-target="#modal-edit{{$r->kendaraan_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                          <a href="#" data-target="#modal-hapus{{$r->kendaraan_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
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

    <div class="modal fade" id="modal-tambah">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('kendaraan.store')}}" method="POST">
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Tambah Kendaraan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf
            <div class="form-group">
              <label for="nopol">Nopol</label>
              <input type="text" id="nopol" class="form-control" name="nopol" required>
            </div>
            <div class="form-group">
              <label for="warna">Warna Plat</label>
              <select class="form-control select2bs4" name="warna" required>
                <option selected disabled>--Pilih Warna Plat--</option>
                <option value="Hitam" class="bg-dark">Hitam</option>
                <option value="Kuning" class="bg-warning">Kuning</option>
              </select>
            </div>
            <div class="form-group">
              <label for="jenis">Jenis Kendaraan</label>
              <select class="form-control select2bs4" name="jenis" required>
                <option selected disabled>--Pilih Jenis Kendaraan--</option>
                @foreach ($jenis as $j)
                <option value="{{$j->jenis_kendaraan_id}}">{{$j->jenis_kendaraan_nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Nama Kendaraan</label>
              <input type="text" id="nama" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
              <label for="merk">Merk Kendaraan</label>
              <input type="text" id="merk" class="form-control" name="merk">
            </div>
            <div class="form-group">
              <label for="harga">Harga Kendaraan</label>
              <input type="text" id="harga" class="form-control uang" name="harga">
            </div>
            <div class="form-group">
              <label for="waktu">Jangka Waktu</label>
              <input type="text" id="waktu" class="form-control" name="waktu">
            </div>
            <div class="form-group">
              <label for="sisa">Jangka Waktu Sisa</label>
              <input type="text" id="sisa" class="form-control" name="sisa">
            </div>
            <div class="form-group">
              <label for="angsuran">Angsuran Kendaraan</label>
              <input type="text" id="angsuran" class="form-control uang" name="angsuran">
            </div>
            <div class="form-group">
              <label for="partner">Partner</label>
              <select class="form-control select2bs4" name="partner" required>
                <option selected disabled>--Pilih Partner--</option>
                @foreach ($partner as $p)
                <option value="{{$p->partner_id}}">{{$p->partner_nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea name="keterangan" class="form-control"></textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Tambah</button>
          </div>
        </form>
        </div>
        {{-- /.modal-content --}}
      </div>
      {{-- /.modal-dialog --}}
    </div>
    {{-- /.modal --}}

  @foreach($kendaraan as $r)
    <div class="modal fade" id="modal-edit{{$r->kendaraan_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form action="{{route('kendaraan.update',$r->kendaraan_id)}}" method="POST">
          <div class="modal-header bg-info">
            <h4 class="modal-title">Edit Kendaraan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            @csrf @method('PUT')
            <div class="form-group">
                <label for="nopol">Nopol</label>
                <input type="text" id="nopol" class="form-control" name="nopol" value="{{$r->kendaraan_nopol}}" required>
            </div>
            <div class="form-group">
                <label for="warna">Warna Plat</label>
                <select class="form-control select2bs4" name="warna" required>
                  <option disabled>--Pilih Warna Plat--</option>
                  <option value="Hitam" class="bg-dark" {{ "Hitam" == $r->kendaraan_plat ? 'selected' : '' }}>Hitam</option>
                  <option value="Kuning" class="bg-warning" {{ "Kuning" == $r->kendaraan_plat ? 'selected' : '' }}>Kuning</option>
                </select>
            </div>
            <div class="form-group">
              <label for="jenis">Jenis Kendaraan</label>
              <select class="form-control select2bs4" name="jenis" required>
                <option selected disabled>--Pilih Jenis Kendaraan--</option>
                @foreach ($jenis as $j)
                <option value="{{$j->jenis_kendaraan_id}}" {{ $j->jenis_kendaraan_id == $r->jenis_kendaraan_id ? 'selected' : '' }}>{{$j->jenis_kendaraan_nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Nama Kendaraan</label>
              <input type="text" id="nama" class="form-control" name="nama" value="{{$r->kendaraan_nama}}" required>
            </div>
            <div class="form-group">
              <label for="merk">Merk Kendaraan</label>
              <input type="text" id="merk" class="form-control" name="merk" value="{{$r->kendaraan_merk}}">
            </div>
            <div class="form-group">
              <label for="harga">Harga Kendaraan</label>
              <input type="text" id="harga" class="form-control uang" name="harga" value="{{$r->kendaraan_harga}}">
            </div>
            <div class="form-group">
              <label for="waktu">Jangka Waktu</label>
              <input type="text" id="waktu" class="form-control" name="waktu" value="{{$r->kendaraan_jangka_waktu}}">
            </div>
            <div class="form-group">
              <label for="sisa">Jangka Waktu Sisa</label>
              <input type="text" id="sisa" class="form-control" name="sisa" value="{{$r->kendaraan_jangka_sisa}}">
            </div>
            <div class="form-group">
              <label for="angsuran">Angsuran Kendaraan</label>
              <input type="text" id="angsuran" class="form-control uang" name="angsuran" value="{{$r->kendaraan_angsuran}}">
            </div>
            <div class="form-group">
              <label for="partner">Partner</label>
              <select class="form-control select2bs4" name="partner" required>
                <option selected disabled>--Pilih Partner--</option>
                @foreach ($partner as $p)
                <option value="{{$p->partner_id}}" {{$p->partner_id == $r->partner_id ? "selected" : "" }}>{{$p->partner_nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="keterangan">Keterangan</label>
              <textarea name="keterangan" class="form-control">{{$r->kendaraan_keterangan}}</textarea>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
        </div>
        {{-- /.modal-content --}}
      </div>
      {{-- /.modal-dialog --}}
    </div>
    {{-- /.modal --}}
  @endforeach

  @foreach($kendaraan as $r)
    <div class="modal fade" id="modal-hapus{{$r->kendaraan_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
        <form method="post" action="{{route('kendaraan.destroy',$r->kendaraan_id)}}">
          <div class="modal-header bg-danger">
            <h4 class="modal-title">Peringatan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center text=danger">
            <h3>Apakah anda yakin ingin menghapus kendaraan dengan nopol <u><strong>{{$r->kendaraan_nopol}}</strong></u> ?</h3>
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

  <script>
    $(function () {
      $("#example1").DataTable({
          "scrollX":true,
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

          @if ($errors->has('nopol'))
          Toast.fire({
              icon: 'error',
              title: " {{$errors->first('nopol')}}"
          })
          @endif

      });
  </script>
  {{-- Input mask --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.uang').mask('000.000.000.000', {reverse: true});
    });
  </script>
@endpush

@endsection
