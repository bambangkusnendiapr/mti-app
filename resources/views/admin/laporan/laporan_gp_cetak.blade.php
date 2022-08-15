<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Gross Profit Kontrak</title>

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
        <h3 class="text-center">Laporan Gross Profit Kontrak</h3>
          <table class="table table-light table-striped table-bordered text-nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Invoice Kode</th>
                <th>Revenue</th>
                <th>Expense</th>
                <th>Gross Profit</th>
              </tr>
            </thead>
            <tbody>
            @foreach($kontrak as $k)

              @php $pendapatan = 0; $pengeluaran = 0; $total = 0; @endphp
              
              @foreach ($invoice->where('kontrak_id',$k->kontrak_id)->where('invoice_status',1) as $r)

                @php
                  foreach($r->detail as $i){
                    $pendapatan   = $i->reconcile->sum('reconcile_klien_total');
                    $pengeluaran  = $i->reconcile->sum('reconcile_mti_total'); 
                  }
                  $total = $total + ($pendapatan - $pengeluaran);
                @endphp
              
              @endforeach

              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$k->kontrak_kode}}</td>
                <td>Rp {{number_format($pendapatan,0,',','.')}}</td>
                <td>Rp {{number_format($pengeluaran,0,',','.')}}</td>
                <td>Rp {{number_format($total,0,',','.')}}</td>
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