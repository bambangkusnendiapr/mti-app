<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Gross Profit Armada</title>

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
        <h3 class="text-center">Laporan Gross Profit Armada</h3>
        <table class="table table-striped table-valign-middle text-nowrap">
          <thead>
          <tr>
            <th>Armada</th>
            <th>Revenue</th>
            <th>Expense</th>
            <th>Cicilan + Biaya</th>
            <th>Gross Profit</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($kendaraan as $kn)
            <tr>
              <td>{{$kn->kendaraan_nopol}} - {{$kn->jenis->jenis_kendaraan_nama}}</td>

              @php $revenue = 0; $expense = 0; $gp = 0; @endphp
              @foreach ($budget->where('kendaraan_id',$kn->kendaraan_id) as $b)
                @foreach ($sj->where('budget_id',$b->budget_id) as $sjk)
                  @foreach ($reconcile->where('surat_jalan_id',$sjk->surat_jalan_id) as $rc)
                    @php 
                      $revenue += $rc->reconcile_klien_total;
                      $expense += $rc->reconcile_mti_total;
                    @endphp
                  @endforeach
                @endforeach
              @endforeach

              {{-- Revenue --}}
              <td>Rp {{number_format($revenue,0,',','.')}}</td>

              {{-- Expense --}}
              <td>Rp {{number_format($expense,0,',','.')}}</td>

              {{-- Cicilan + Biaya --}}
              @php
                $cicilan  = $kn->kendaraan_angsuran;
                $biaya    = $purchasing->where('kendaraan_id',$kn->kendaraan_id)->sum('purchasing_jumlah');
                $totalcb  = $cicilan + $biaya;
                $gp       = $revenue - ($expense + $totalcb);
              @endphp
              <td>Rp {{number_format($totalcb,0,',','.')}}</td>

              {{-- Gross Profit --}}
              @if($gp == 0)
                <td class="text-dark">Rp {{number_format($gp,0,',','.')}}</td>
              @elseif($gp >= 0)
                <td class="text-success">Rp {{number_format($gp,0,',','.')}}</td>
              @else
                <td class="text-danger">Rp {{number_format($gp,0,',','.')}}</td>
              @endif
            </tr>
          @endforeach
          </tbody>
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