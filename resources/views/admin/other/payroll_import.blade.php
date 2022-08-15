@extends('layouts.admin.master')

@section('other-open', 'menu-open')

@section('other-active', 'active')

@section('payroll', 'active')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 mb-2">
            <h1>Payroll</h1>
          </div>
          <div class="col-sm-6">
            <!--<a href="{{route('payroll.clean',$pid->periode_id)}}" onclick="return confirm('Semuad data payroll pada periode ini akan di hapus lanjutkan?')" class="btn btn-danger btn-sm float-right"><span class="fa fa-trash">&nbsp;</span>Clean Data</a>-->
            <a href="#" data-toggle="modal" data-target="#modal-tambah" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Import Data</a>
          </div>
         <div class="col-sm-12">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item active"><a href="#">Other</a></li>
                <li class="breadcrumb-item active"><a href="#">Periode</a></li>
                <li class="breadcrumb-item active"><a href="#">Payroll</a></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <a href="{{route('payroll_bundle.print',$pid->periode_id)}}"  target="_blank"  class="btn btn-primary btn-sm float-right"><span class="fa fa-print">&nbsp;</span>Cetak Semua Data</a>
                <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Departemen</th>
                    <th>NIK</th>
                    <th>Gaji Pokok</th>
                    <th>Tunjangan Jabatan</th>
                    <th>Uang Makan</th>
                    <th>Transport</th>
                    <th>Insentif</th>
                    <th>Bonus</th>
                    <th>Total</th>
                    <th>Pinjaman</th>
                    <th>PPh 21</th>
                    <th>Lain - lain</th>
                    <th>Take Home Pay</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                @foreach ($karyawan  as $k)
                  <tr>
                    <td class="text-right">{{$loop->iteration}}</td>
                    <td>{{$k->karyawan_nama}}</td>
                    <td>{{ $k->karyawan_jabatan }}</td>
                    <td>{{ $k->karyawan_departemen }}</td>
                    <td>{{ $k->karyawan_nik }}</td>
                    <td>Rp. {{ number_format($k->karyawan_gapok,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_tunjangan_jabatan,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_uang_makan,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_transport,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_insentif,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_bonus,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_total,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_pinjaman,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_pph,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_lain,0,',','.') }}</td>
                    <td>Rp. {{ number_format($k->karyawan_take_home_pay,0,',','.') }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Button group">
                            {{-- <a href="#" data-target="#modal-edit{{$k->karyawan_id}}" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-edit"></span></a> --}}
                            <a href="{{route('payroll.print',$k->karyawan_id)}}" target="_blank" class="btn btn-xs btn-link"><span class="fa fa-print"></span></a>
                            {{-- <a href="#" data-target="#modal-hapus" data-toggle="modal" class="btn btn-xs btn-link"><span class="fa fa-trash"></span></a> --}}
                        </div>
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h4 class="modal-title">Import Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                @foreach ($periode as $p)
                    <label for="">Harap isi Angka ' <strong class="text-danger">{{ $p->periode_id }}</strong> ' Pada Kolom <strong class="text-danger">Periode</strong></label>
                    <input type="hidden" name="id" value="{{ $p->periode_id }}">
                    @endforeach
                <a class="btn btn-sm btn-primary" href="{{route('payroll.import')}}">Download Template</a>
                <form action="{{route('payroll.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="custom-file">
                    <input id="file" class="custom-file-input" type="file" name="file">
                    <label for="file" class="custom-file-label">Import xls</label>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Import</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      @foreach ($karyawan as $k)
      <div class="modal fade" id="modal-edit{{$k->karyawan_id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h4 class="modal-title">Edit Payroll</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" class="form-control" name="nama" value="{{ $k->karyawan_nama }}">
                </div>
                <div class="form-group">
                    <label for="jabatan">Jabatan</label>
                    <input type="text" id="jabatan" class="form-control" name="jabatan" value="{{ $k->karyawan_jabatan }}">
                </div>
                <div class="form-group">
                    <label for="dept">Departemen</label>
                    <input type="text" id="dept" class="form-control" name="dept" value="{{ $k->karyawan_departemen }}">
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" id="nik" class="form-control" name="nik" value="{{ $k->karyawan_nik }}">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gapok">Gapok</label>
                            <input type="text" id="gapok" class="form-control uang" name="gapok" value="{{ $k->karyawan_gapok}}">
                        </div>
                        <div class="form-group">
                            <label for="tunjangan">Tunjangan Jabatan</label>
                            <input type="text" id="tunjangan" class="form-control uang" name="tunjangan" value="{{ $k->karyawan_tunjangan_jabatan}}">
                        </div>
                        <div class="form-group">
                            <label for="makan">Uang Makan</label>
                            <input type="text" id="makan" class="form-control uang" name="makan" value="{{ $k->karyawan_uang_makan }}">
                        </div>
                        <div class="form-group">
                            <label for="transport">Transport</label>
                            <input type="text" id="transport" class="form-control uang" name="transport" value="{{ $k->karyawan_transport }}">
                        </div>
                        <div class="form-group">
                            <label for="insentif">Insentif</label>
                            <input type="text" id="insentif" class="form-control uang" name="insentif" value="{{ $k->karyawan_insentif }}">
                        </div>
                        <div class="form-group">
                            <label for="bonus">Bonus</label>
                            <input type="text" id="bonus" class="form-control uang" name="bonus" value="{{ $k->karyawan_bonus }}">
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" id="total" class="form-control uang" name="total" value="{{ $k->karyawan_total }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="pinjaman">Pinjaman</label>
                            <input type="text" id="pinjaman" class="form-control uang" name="pinjaman" value="{{ $k->karyawan_pinjaman}}">
                        </div>
                        <div class="form-group">
                            <label for="pph">PPh 21</label>
                            <input type="text" id="pph" class="form-control uang" name="pph" value="{{ $k->karyawan_pph}}">
                        </div>
                        <div class="form-group">
                            <label for="lain">Lain</label>
                            <input type="text" id="lain" class="form-control uang" name="lain" value="{{ $k->karyawan_lain }}">
                        </div>
                        <div class="form-group">
                            <label for="thp">Take Home Pay</label>
                            <input type="text" id="thp" class="form-control uang" name="thp" value="{{ $k->karyawan_take_home_pay }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      @endforeach
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4 class="modal-title">Peringatan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-center text=danger">
              <h3>Apakah anda yakin ingin menghapus Data ?</h3>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-danger" onclick="confirm('Data akan dihapus secara permanent, Lanjutkan?')">YA! Hapus Data</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

@push('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endpush

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<!-- DataTables -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- page script -->

<script type="text/javascript">
    $(document).ready(function(){
      $('.date').mask('00/00/0000');
      $('.uang').mask('000.000.000.000', {reverse: true});
      $('.time').mask('00:00:00');
      $('.date_time').mask('00/00/0000 00:00:00');
     });
</script>


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
@endpush

@endsection
