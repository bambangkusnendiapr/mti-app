<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan AP</title>

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  {{-- Ionicons --}}
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  {{-- overlayScrollbars --}}
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  {{-- Google Font: Source Sans Pro --}}
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
</head>
<body class="text-xs">

  <div class="container">
    <div class="card">
      <div class="card-header">
        Laporan tertanggal : {{\Carbon\Carbon::parse($dari)->format('d F Y')}} s/d {{\Carbon\Carbon::parse($ke)->format('d F Y')}}
      </div>
      <div class="card-body">
        <h3 class="text-center">Laporan Account Payable</h3>
        <table class="table table-striped table-valign-middle text-nowrap">
          <thead>
          <tr>
            <th>Patner</th>
            <th>Jumlah Bayar</th>
            <th>Total Belum Bayar</th>
          </tr>
          </thead>
          <tbody>
          @php
              $tap = 0; $lsisa = 0; $lbayar = 0; $count = 0;
          @endphp

          @foreach($leasing as $r)
            @php
              $count    = $r->payment->whereBetween('created_at',[$dari,$ke])->count();
              $lbayar   += $count * $r->kendaraan->kendaraan_angsuran;
              $lsisa    += ( $r->kendaraan->kendaraan_jangka_sisa - $count ) * $r->kendaraan->kendaraan_angsuran;
            @endphp
          @endforeach

            <tr>
              <td>Leasing</td>
              <td>Rp {{number_format($lbayar,0,',','.')}}</td>
              <td>Rp {{number_format($lsisa,0,',','.')}}</td>
            </tr>

          @foreach($partner as $p)
            @php $jumlah = 0; $total = 0; @endphp
            @foreach ($p->ap->whereBetween('created_at',[$dari,$ke]) as $ap)
              @php
                $jumlah += $ap->payment->sum('payment_partner_jumlah');
                $total  = $p->ap->sum('purchasing_jumlah') - $jumlah;
                $tap    += $total;
              @endphp
            @endforeach
            <tr>
              <td>{{$p->partner_nama}}</td>
              <td>Rp {{number_format($jumlah,0,',','.')}}</td>
              <td>Rp {{number_format($total,0,',','.')}}</td>
            </tr>
          @endforeach
          </tbody>
          <tfoot>
            <tr>
              <td colspan="3"><strong>Total AP : </strong>Rp {{number_format($tap + $lsisa,0,',','.')}}</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>  
  </div>

</body>
{{-- jQuery --}}
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
{{-- Bootstrap 4 --}}
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{-- AdminLTE App --}}
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
</html>