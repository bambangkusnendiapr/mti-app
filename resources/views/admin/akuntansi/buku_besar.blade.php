<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku Besar</title>

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
  <style>
    @media print {
    .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }
  </style>
</head>
<body>
    <div class="container">
        <h1 class="">Buku Besar</h1>
        <div class="card">
            <div class="card-body">
            @foreach ($kode_akun as $ka)
                @php $jdebet = 0; $jkredit = 0; @endphp
            <label>{{ $ka->kode_akun }} | {{ $ka->nama_akun }}</label>
            <table class="table mb-5 text-nowrap" width="100%">
                <thead>
                    <tr>
                        <td width="150px">Tanggal</td>
                        <td width="500px">Uraian</td>
                        <td width="150px">Debet</td>
                        <td width="150px">Kredit</td>
                    </tr>
                    <tr>
                        <th colspan="2">Saldo Awal</th>
                            @php

                            if($ka->normal == "DEBET"){
                                $awaldebet = $ka->saldo_awal;
                                $awalkredit = 0;
                            }else{
                                $awaldebet = 0;
                                $awalkredit = $ka->saldo_awal;
                            }
                            @endphp
                            <td>{{ number_format($awaldebet,0,',','.') }}</td>
                            <td>{{ number_format($awalkredit,0,',','.') }}</td>
                    </tr>
                </thead>
                    @foreach ($ka->transaksi->whereBetween('tanggal',[$dari,$ke]) as $t)

                    <tbody>
                        <tr>
                            <td>{{ $t->posting->tanggal }}</td>
                            <td>{{ $t->posting->uraian }}</td>
                            <td>{{ number_format($t->debet,0,',','.')}}</td>
                            <td>{{ number_format($t->kredit,0,',','.')}}</td>
                        </tr>
                    </tbody>
                        @php
                            $jdebet = $t->debet + $jdebet;
                            $jkredit = $t->kredit + $jkredit;
                        @endphp
                    @endforeach
                        @php
                            $jdebet = $jdebet + $awaldebet;
                            $jkredit = $jkredit + $awalkredit;

                            if($jdebet >= $jkredit){
                                $akhirdebet = $jdebet - $jkredit; $akhirkredit = 0;
                            }else{
                                $akhirdebet = 0; $akhirkredit = $jkredit - $jdebet;
                            }

                        @endphp

                    <tfoot>
                        <tr>
                            <th>JUMLAH</th>
                            <td>&nbsp;</td>
                            <td>{{ number_format($jdebet,0,',','.') }}</td>
                            <td>{{ number_format($jkredit,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <th>SALDO AKHIR</th>
                            <td>&nbsp;</td>
                            <td>{{ number_format($akhirdebet,0,',','.') }}</td>
                            <td>{{ number_format($akhirkredit,0,',','.')}}</td>
                        </tr>
                    </tfoot>
            </table>
            <div class="pagebreak"> </div>
            @endforeach

        </div>
        </div>
        
    </div>



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
