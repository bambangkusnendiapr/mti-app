@extends('layouts.admin.master')

@section('master-open', 'menu-open')

@section('master-active', 'active')

@section('karyawan-active', 'active')

@section('content')

    {{-- Content Header (Page header) --}}
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Master Karyawan</h1>
          </div>
          <div class="col-sm-6">
            <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Karyawan</a>

          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
              <li class="breadcrumb-item active">Master Karyawan</li>
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
                <table id="example1" class="table table-striped" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>No Telpon</th>
                    <th>Agama</th>
                    <th>Jabatan</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach ($karyawan as $r)
                  <tr>
                    <td class="text-right">{{$no++}}</td>
                    <td>{{$r->karyawan_nama}}</td>
                    <td>{{$r->karyawan_alamat}}</td>
                    <td>{{$r->karyawan_kota}}</td>
                    <td>{{$r->karyawan_no_telp}}</td>
                    <td>{{$r->karyawan_agama}}</td>
                    <td>{{$r->jabatan->jabatan_nama}}</td>
                    <td class="text-center">

                      <div class="btn-group" role="group" aria-label="Button group">
                          <a href="#" data-target="#modal-edit{{$r->karyawan_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a>
                          <a href="#" data-target="#modal-hapus{{$r->karyawan_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a>
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
          <form action="{{route('karyawan.store')}}" method="POST">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Tambah Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
              @csrf
                
                <div class="form-group">
                    <label for="nama">Nama Karyawan</label>
                    <input type="text" id="nama" class="form-control" name="nama" value="{{old('nama')}}" required>
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat Karyawan</label>
                    <input type="text" id="alamat" class="form-control" name="alamat" value="{{old('alamat')}}">
                </div>

                <div class="form-group">
                  <label for="kota">Kota Karyawan</label>
                  <input type="text" id="kota" class="form-control" name="kota" value="{{old('kota')}}">
                </div>

                <div class="form-group">
                    <label for="telp">No Telpon Karyawan</label>
                    <input type="text" id="telp" class="form-control" name="telp" value="{{old('telp')}}">
                </div>

                <div class="form-group">
                  <label for="jk">Jenis Kelamin Karyawan</label>
                  <select name="jk" class="form-control" required>
                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jk') == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="P" {{ old('jk') == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="agama">Agama Karyawan</label>
                  <select name="agama" class="form-control" required>
                    <option selected disabled>-- Pilih Agama --</option>
                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jabatan">Jabatan Karyawan</label>
                  <select name="jabatan" class="form-control" required>
                    <option selected disabled>-- Pilih Jabatan --</option>
                    @foreach($jabatan as $j)
                    <option value="{{$j->jabatan_id}}">{{$j->jabatan_nama}}</option>
                    @endforeach
                  </select>
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
    
    @foreach ($karyawan as $r)
        
      <div class="modal fade" id="modal-edit{{$r->karyawan_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
          <form action="{{route('karyawan.update',$r->karyawan_id)}}" method="POST">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Karyawan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
              @csrf @method('PUT')

                <div class="form-group">
                  <label for="nama">Nama Karyawan</label>
                  <input type="text" id="nama" class="form-control" name="nama" value="{{$r->karyawan_nama}}" required>
                </div>

                <div class="form-group">
                  <label for="alamat">Alamat Karyawan</label>
                  <input type="text" id="alamat" class="form-control" name="alamat" value="{{$r->karyawan_alamat}}">
                </div>

                <div class="form-group">
                  <label for="kota">Kota Karyawan</label>
                  <input type="text" id="kota" class="form-control" name="kota" value="{{$r->karyawan_kota}}">
                </div>

                <div class="form-group">
                  <label for="telp">No Telpon Karyawan</label>
                  <input type="text" id="telp" class="form-control" name="telp" value="{{$r->karyawan_no_telp}}">
                </div>

                <div class="form-group">
                  <label for="jk">Jenis Kelamin Karyawan</label>
                  <select name="jk" class="form-control" required>
                    <option selected disabled>-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ $r->karyawan_jk == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                    <option value="P" {{ $r->karyawan_jk == 'P' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="agama">Agama Karyawan</label>
                  <select name="agama" class="form-control" required>
                    <option selected disabled>-- Pilih Agama --</option>
                    <option value="Islam" {{ $r->karyawan_agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $r->karyawan_agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Budha" {{ $r->karyawan_agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                    <option value="Hindu" {{ $r->karyawan_agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="jabatan">Jabatan Karyawan</label>
                  <select name="jabatan" class="form-control" required>
                    <option selected disabled>-- Pilih Jabatan --</option>
                    @foreach($jabatan as $j)
                    <option value="{{$j->jabatan_id}}" {{ $j->jabatan_id == $r->jabatan_id ? 'selected' : '' }}>{{$j->jabatan_nama}}</option>
                    @endforeach
                  </select>
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

    @foreach ($karyawan as $r)

    <div class="modal fade" id="modal-hapus{{$r->karyawan_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="{{route('karyawan.destroy',$r->karyawan_id)}}">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Peringatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center text=danger">
              <h3>Apakah anda yakin ingin menghapus Karyawan <u><strong>{{$r->karyawan_nama}}</strong></u> ?</h3>
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
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
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
