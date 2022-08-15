<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>NERACA</title>

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
<body>
  <div class="container">
    <h1 class="mb-5">NERACA</h1>
    <div class="row">
      <label>AKTIVA</label>
      <table class="table mb-5 text-nowrap" width="100%">
        <thead>
          <tr>
            <th width="150px">Kode Akun</th>
            <th width="150px">Nama Akun</th>
            <th width="150px">Saldo</th>
          </tr>
        </thead>
        <tbody>

        @php $totalaktiva = 0; $bb = 0; $ta = 0; $bukubesar = 0; $kredit = 0; @endphp
          
        @foreach ($kode_akun->where('kelompok','NERACA')->whereBetween('kode_akun',[999,1999]) as $ka)
          
          @php
            $bukubesar = $ka->transaksi->sum('debet') - $ka->transaksi->sum('kredit');
            $ta = $ta + $bukubesar;
          @endphp

          
          @if ($bukubesar != null)
          <tr>
            <td width="150px">{{ $ka->kode_akun }}</td>
            <td width="150px">{{ $ka->nama_akun }}</td>
            <td width="150px">{{ number_format($bukubesar,0,',','.')}}</td>
          </tr>
          @endif
          

        @endforeach

        </tbody>
        <tfoot class="bg-danger">
          <tr>
            <th colspan="2">TOTAL AKTIVA</th>
            <td>{{ number_format($ta,0,',','.')}}</td>
          </tr>
        </tfoot>
      </table>

        @php $totalpendapatan = 0; $totalbiaya = 0; @endphp
        @foreach ($kode_akun->where('kelompok','LABA RUGI')->whereBetween('kode_akun',[4000,5999]) as $p)
          @foreach ($p->transaksi as $pendapatan)
            @php
              $totalpendapatan = $totalpendapatan + $pendapatan->kredit;
            @endphp
          @endforeach
        @endforeach

        @foreach ($kode_akun->where('kelompok','LABA RUGI')->whereBetween('kode_akun',[6000,6999]) as $p2)
          @foreach ($p2->transaksi as $biaya)
            @php
              $totalbiaya = $biaya->debet + $totalbiaya;
            @endphp
          @endforeach
        @endforeach

      <label>PASIVA</label>
      <table class="table mb-5 text-nowrap" width="100%">
        <thead>
          <tr>
            <th width="150px">Kode Akun</th>
            <th width="150px">Nama Akun</th>
            <th width="150px">Saldo</th>
          </tr>
        </thead>
        <tbody>

        @php $laba = $totalpendapatan - $totalbiaya; $tp = 0; $bukubesar2 = 0; @endphp
        
        @foreach ($kode_akun->where('kelompok','NERACA')->whereBetween('kode_akun',[2000,3999]) as $ka2)
        
          @php
            $bukubesar2 = $ka2->transaksi->sum('debet') - $ka2->transaksi->sum('kredit') * -1;
            $tp = $tp + $bukubesar2;
          @endphp
      
          <tr>
            <td width="150px">{{ $ka2->kode_akun }}</td>
            <td width="150px">{{ $ka2->nama_akun }}</td>
            <td width="150px">{{ number_format($bukubesar2,0,',','.')}}</td>
          </tr>

        @endforeach
          <tr>
            <td width="150px"></td>
            <td width="150px">SALDO LABA TAHUN BERJALAN</td>
            <td width="150px">{{ number_format($laba,0,',','.')}}</td>
          </tr>
        </tbody>

        <tfoot class="bg-warning">
          <tr>
            <th colspan="2">TOTAL PASIVA</th>
            <td>{{ number_format($tp + $laba,0,',','.')}}</td>
          </tr>
        </tfoot>
      </table>

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
