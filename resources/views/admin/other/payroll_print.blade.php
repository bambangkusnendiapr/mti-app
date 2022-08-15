<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payroll</title>

     <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
</head>
<body onLoad="window.print();">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4"><img class="img-fluid" src="{{asset('admin/dist/img/MTI_Logo.png')}}" width="50%" alt=""></div>
                    <div class="col-md-4"><h1><i><strong>Salary Slip</strong></i></h1></div>
                    <div class="col-md-4"><label class="text-primary">PT Marcos Trans </label> <label class="text-danger">Indonesia</label><p><small>Jl. Wijaya Kusuma Bs.6 No.13, Jatisampurna, Bekasi</small></p></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                Nama
                            </div>
                            <div class="col-md-8">
                                {{ $data->karyawan_nama }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Jabatan
                            </div>
                            <div class="col-md-8">
                                {{ $data->karyawan_jabatan }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Departemen
                            </div>
                            <div class="col-md-8">
                                {{ $data->karyawan_departemen }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                NIK
                            </div>
                            <div class="col-md-8">
                                {{ $data->karyawan_nik }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Periode
                            </div>
                            <div class="col-md-8">
                                {{ \Carbon\Carbon::parse($data->periode->periode_tanggal)->format('d M Y') }}
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <label for="">PENDAPATAN</label>
                        <div class="row">
                            <div class="col-md-4">
                                Gaji Pokok
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_gapok,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Tunjangan Jabatan
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_tunjangan_jabatan,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Uang Makan
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_uang_makan,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Transport
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_transport,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Insentif
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_insentif,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Bonus
                            </div>
                            <div class="col-md-8 border-bottom border-dark">
                                Rp. {{ number_format($data->karyawan_bonus,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Total Salary
                            </div>
                            <div class="col-md-8 border-bottom border-dark">
                                Rp. {{ number_format($data->karyawan_total,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                    &nbsp;
                            </div>
                            <div class="col-md-8">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Take Home Pay
                            </div>
                            <div class="col-md-8 border-bottom border-dark">
                                Rp. {{ number_format($data->karyawan_take_home_pay,0,'.','.') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">POTONGAN</label>
                        <div class="row">
                            <div class="col-md-4">
                                Pinjaman
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_pinjaman,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                PPh 21
                            </div>
                            <div class="col-md-8">
                                Rp. {{ number_format($data->karyawan_pph,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                Lain - Lain
                            </div>
                            <div class="col-md-8 border-bottom border-dark">
                                Rp. {{ number_format($data->karyawan_lain,0,'.','.') }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-8 border-bottom border-dark">
                                Rp. {{ number_format($data->karyawan_lain + $data->karyawan_pinjaman + $data->karyawan_pph + $data->karyawan_lain,0,'.','.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>



<!-- DataTables -->
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
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": false,
          });
        });
      </script>
</body>
</html>
