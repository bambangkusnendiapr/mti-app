<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cash Flow</title>

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
    <h1 class="mb-5">Cash Flow</h1>
    <div class="row ">
      <table class="table mb-5 text-nowrap" width="100%">
        <thead>
          <tr>
            <td width="150px">Kode Akun</td>
            <td width="150px">Nama Akun</td>
            <td width="150px">Debet</td>
            <td width="150px">Kredit</td>
          </tr>
        </thead>
        <tbody>

        @php $totalkredit = 0; $totaldebet = 0; $debet = 0; $kredit = 0; @endphp

        @foreach ($trade as $r)
          @if ($r->akun->kode_akun >= 999 && $r->akun->kode_akun <= 1999)

            @foreach ($transaksi->where('kode_akun',$r->kode_akun)->whereBetween('tanggal',[$dari,$ke]) as $k)
              @php 
                $totalkredit  += $k->kredit; 
                $totaldebet   += $k->debet; 
              @endphp
            @endforeach

          @php
            $debet        = $r->where('kode_akun',$k->kode_akun)->whereBetween('tanggal',[$dari,$ke])->sum('debet');
            $kredit       = $r->where('kode_akun',$k->kode_akun)->whereBetween('tanggal',[$dari,$ke])->sum('kredit');
          @endphp

          <tr>
            <td width="150px">{{ $r->akun->kode_akun }}</td>
            <td width="150px">{{ $r->akun->nama_akun }}</td>
            <td width="150px">{{ number_format($debet,0,',','.')}}</td>
            <td width="150px">{{ number_format($kredit,0,',','.')}}</td>
          </tr>
          
          @endif

        @endforeach
        
        </tbody>
        <tfoot class="bg-danger">
          <tr>
            <th colspan="2">TOTAL Cash Flow</th>
            <td>{{ number_format($totaldebet,0,',','.')}}</td>
            <td>{{ number_format($totalkredit,0,',','.')}}</td>
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
