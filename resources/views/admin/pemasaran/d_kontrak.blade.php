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
          <h1>Kontrak {{$kontrak->kontrak_klien_nama}}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-left">
            <li class="breadcrumb-item"><a href="{{route('kontrak.index')}}">Pemasaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('kontrak.show',$kontrak->kontrak_id)}}">Manage Kontrak</a></li>
            <li class="breadcrumb-item active">Kontrak {{$kontrak->kontrak_klien_nama}}</li>
          </ol>
        </div>
      </div>
    </div>{{-- /.container-fluid --}}
  </section>

  {{-- Main content --}}
  <section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary collapsed-card">
                <div class="card-header">

                    <h3 class="card-title">Detail Kontrak</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">


                    <div class="form-group">
                        <label for="inputName">Kode Kontrak</label>
                        <input type="text" id="inputName" class="form-control-plaintext" name="kd" value="{{$kontrak->kontrak_kode}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Nama Klien</label>
                        <input type="text" id="inputName" class="form-control-plaintext" name="nama" value="{{$kontrak->kontrak_klien_nama}}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="inputName">Periode Kontrak</label>
                        <input type="text" id="inputName" class="form-control-plaintext" name="nama" value="{{\Carbon\Carbon::parse($kontrak->kontrak_selesai)->format('d-m-Y')}}" readonly>
                    </div>

                    <label for="">PIC List</label>
                    <table id="example3" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama PIC</th>
                        <th>Jabatan</th>
                        <th>Keterangan</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($pic as $p)
                      <tr>
                        <td class="text-right" width="25px">{{$loop->iteration}}</td>
                        <td>{{$p->pic_nama}}</td>
                        <td>{{$p->jabatan->jabatan_nama}}</td>
                        <td>{{$p->pic_keterangan}}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Button group">
                                <a href="#" data-target="#pic-edit{{$p->pic_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;&nbsp;
                                <a href="#" data-target="#pic-hapus{{$p->pic_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>

                    <a href="#" data-target="#pic-tambah" data-toggle="modal" class="btn btn-primary btn-sm float-left mt-2"><span class="fa fa-plus">&nbsp;</span>Tambah PIC</a>
                    
                    <br/><br/><br/><br/>

                    <div class="form-group">
                      <label for="">Koreksi List</label>
                    </div>
                    
                    <table id="example4" class="table  table-striped text-nowrap" cellspacing="0" width="100%">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Koreksi Nama</th>
                        <th>Koreksi Tarif</th>
                        <th>Koreksi Uang Jalan</th>
                        <th></th>
                      </tr>
                      </thead>
                      <tbody>
                      @php $no=1; @endphp
                      @foreach($koreksi as $k)
                      <tr>
                        <td class="text-right" width="25px">{{$no++}}</td>
                        <td>{{$k->koreksi_nama}}</td>
                        <td>Rp {{number_format($k->koreksi_tarif,0,',','.')}}</td>
                        <td>Rp {{number_format($k->koreksi_uang_jalan,0,',','.')}}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Button group">
                                <a href="#" data-target="#koreksi-edit{{$k->koreksi_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;&nbsp;
                                <a href="#" data-target="#koreksi-hapus{{$k->koreksi_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                    <a href="#" data-target="#koreksi-tambah" data-toggle="modal" class="btn btn-primary btn-sm float-left mt-2"><span class="fa fa-plus">&nbsp;</span>Tambah Koreksi</a>
                    
                </div>
                {{-- /.card-body --}}

            </div>
            {{-- /.card --}}
        </div>

        <div class="col-md-6">
            <div class="card card-dark collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">User ID</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-plus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">User ID</label>
                        <input type="text" id="inputName" class="form-control-plaintext" name="nama" value="{{$kontrak->krani->email}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Password</label>
                        <input type="text" id="inputName" class="form-control-plaintext" name="nama" value="{{$kontrak->krani->password_show}}" readonly>
                    </div>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>

      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Manage Store</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
            </div>
          </div>
          <div class="card-body">

            <table id="example1" class="table  table-striped text-nowrap" cellspacing="0" width="100%">
              <thead>
              <tr>
                <th>No</th>
                <th>ID</th>
                <th>Store Name</th>
                <th>Store Code</th>
                <th>Alamat</th>
                <th>Provinsi</th>
                <th>Kota</th>
                <th>Region</th>
                <th>Keterangan</th>
                <th>Tarif</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
              @php $no=1; @endphp
              @foreach($store as $s)
              <tr>
                <td class="text-right" width="25px">{{$no++}}</td>
                <td>{{$s->store_id}}</td>
                <td>{{$s->store_nama}}</td>
                <td>{{$s->store_kode}}</td>
                <td>{{$s->store_alamat}}</td>
                <td>{{$s->provinsi->name}}</td>
                <td>{{$s->kota->name}}</td>
                <td>{{$s->store_region}}</td>
                <td>{{$s->store_keterangan}}</td>
                <td class="text-center">
                  <a href="{{route('tarif.show',$s->store_id)}}" data-target="" data-toggle="" class="btn btn-xs btn-link" title="Tarif"><span class="fa fa-truck"></span></a>&nbsp;&nbsp;&nbsp;
                </td>
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="Button group">
                        <a href="{{route('store.edit',$s->store_id)}}" class="btn btn-xs btn-link" title="Edit"><span class="fa fa-edit"></span></a>&nbsp;&nbsp;&nbsp;
                        <a href="#" data-target="#modal-hapus{{$s->store_id}}" data-toggle="modal" class="btn btn-xs btn-link" title="Hapus"><span class="fa fa-trash"></span></a>
                    </div>
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
            <form method="post" action="{{route('store.create')}}">
              @csrf
              <input type="hidden" name="kontrak" value="{{$kontrak->kontrak_id}}">
              <button class="btn btn-primary btn-sm float-left mt-2" type="submit"><span class="fa fa-plus">&nbsp;</span>Tambah Store</button>
              <a href="#" data-target="#importExcel" data-toggle="modal" class="btn btn-success btn-sm float-left mt-2 ml-2"><span class="fas fa-file-excel"></span> Import Store</a>
              <a href="#" data-target="#importExcel2" data-toggle="modal" class="btn btn-success float-left btn-sm mt-2 ml-2"><span class="fas fa-file-excel"></span> Import Tarif</a>
            </form>
          </div>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}

    </div>
  </section>
  {{-- /.content --}}

  <div class="modal fade" id="pic-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('pic.store')}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah PIC</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf

            <input type="hidden" name="kontrak" value="{{$kontrak->kontrak_id}}">

            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" id="nama" class="form-control" name="nama" value="{{old('nama')}}" required>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <select name="jabatan" class="form-control" required>
                  <option selected disabled>-- Pilih Jabatan --</option>
                  @foreach($jabatan as $j)
                  <option value="{{$j->jabatan_id}}">{{$j->jabatan_nama}}</option>
                  @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" class="form-control" name="keterangan">
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

  @foreach($pic as $p)
  <div class="modal fade" id="pic-edit{{$p->pic_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('pic.update',$p->pic_id)}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah PIC</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf @method('PUT')
            <div class="form-group">
              <label for="nama">Nama</label>
              <input type="text" id="nama" class="form-control" name="nama" value="{{$p->pic_nama}}" required>
            </div>

            <div class="form-group">
                <label for="jabatan">Jabatan</label>
                <select name="jabatan" class="form-control" required>
                  <option selected disabled>-- Pilih Jabatan --</option>
                  @foreach($jabatan as $j)
                  <option value="{{$j->jabatan_id}}" {{ $j->jabatan_id == $p->jabatan_id ? 'selected' : '' }}>{{$j->jabatan_nama}}</option>
                  @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <input type="text" id="keterangan" class="form-control" name="keterangan" value="{{$p->pic_keterangan}}">
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
  @endforeach

  @foreach($pic as $p)
  <div class="modal fade" id="pic-hapus{{$p->pic_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="post" action="{{route('pic.destroy',$p->pic_id)}}">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center text=danger">
          <h3>Apakah anda yakin ingin menghapus pic <u><strong>{{$p->pic_nama}}</strong></u> ?</h3>
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

  <div class="modal fade" id="koreksi-tambah">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('koreksi.store')}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Tambah Koreksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf

            <input type="hidden" name="kontrak" value="{{$kontrak->kontrak_id}}">

            <div class="form-group">
              <label for="nama">Koreksi Nama</label>
              <input type="text" id="nama" class="form-control" name="nama" value="{{old('nama')}}">
            </div>

            <div class="form-group">
              <label for="tarif">Koreksi Tarif</label>
              <input type="text" id="tarif" class="form-control uang" name="tarif" value="{{old('tarif')}}">
            </div>

            <div class="form-group">
              <label for="uang_jalan">Koreksi Uang Jalan</label>
              <input type="text" id="uang_jalan" class="form-control uang" name="uang_jalan" value="{{old('uang_jalan')}}">
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

  @foreach($koreksi as $k)
  <div class="modal fade" id="koreksi-edit{{$k->koreksi_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="{{route('koreksi.update',$k->koreksi_id)}}" method="POST">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">Edit Koreksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @csrf @method('PUT')
            
            <div class="form-group">
              <label for="nama">Koreksi Nama</label>
              <input type="text" id="nama" class="form-control" name="nama" value="{{$k->koreksi_nama}}">
            </div>

            <div class="form-group">
              <label for="tarif">Koreksi Tarif</label>
              <input type="text" id="tarif" class="form-control uang" name="tarif" value="{{$k->koreksi_tarif}}">
            </div>

            <div class="form-group">
              <label for="uang_jalan">Koreksi Uang Jalan</label>
              <input type="text" id="uang_jalan" class="form-control uang" name="uang_jalan" value="{{$k->koreksi_uang_jalan}}">
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
  @endforeach

  @foreach($koreksi as $k)
  <div class="modal fade" id="koreksi-hapus{{$k->koreksi_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="post" action="{{route('koreksi.destroy',$k->koreksi_id)}}">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center text=danger">
          <h3>Apakah anda yakin ingin menghapus koreksi <u><strong>{{$k->koreksi_nama}}</strong></u> ?</h3>
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

  @foreach($store as $s)
  <div class="modal fade" id="modal-hapus{{$s->store_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
      <form method="post" action="{{route('store.destroy',$s->store_id)}}">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center text=danger">
          <h3>Apakah anda yakin ingin menghapus store <u><strong>{{$s->store_nama}}</strong></u> ?</h3>
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

  <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{route('store.import')}}" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            <a href="{{route('download.file.store')}}" class="btn btn-link float-right text-success"><i class="fas fa-file-excel"></i> Download Template</a>
          </div>
          <div class="modal-body">

            {{ csrf_field() }}

            <label>Pilih file excel</label>
            <div class="form-group">
              <input type="file" name="file" required="required">
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
  
  <div class="modal fade" id="importExcel2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" action="{{route('tarif.import')}}" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            <a href="{{route('download.file.tarif')}}" class="btn btn-link float-right text-success"><i class="fas fa-file-excel"></i> Download Template</a>
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
  {{-- Select2 --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  {{-- daterange picker --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}">
  {{-- DataTables --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  {{-- Sweetalert --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush

@push('js')

  {{-- Select2 --}}
  <script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>
  {{-- date-range-picker --}}
  <script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
  {{-- DataTables --}}
  <script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

  <script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#example1").DataTable({
      "scrollX":true,
          });

    $("#example3").DataTable({
      "scrollX":true,
      "paging":false,
      "searching":false,
      "info":false,
    });

    $("#example4").DataTable({
      "scrollX":true,
      "paging":false,
      "searching":false,
      "info":false,
    });

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "scrollX": true,
    });

  })

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
