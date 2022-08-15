<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan Omset</title>

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
        <hr>
        @foreach ($kontrak as $k)
          <div class="row">
            <div class="col-6">
              <h3>{{$k->kontrak_kode}}</h3>
            </div>
          </div>
          <table class="table table-striped table-borderless text-nowrap">
            <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>Invoice Kode</th>
                <th>Revenue</th>
                <th>Expense</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($k->invoice->whereBetween('created_at',[$dari,$ke])->where('invoice_status',1) as $r)
              @php
                $pendapatan = 0; $pengeluaran = 0; $total = 0;
                foreach($r->detail as $i){
                  $pendapatan   = $i->reconcile->sum('reconcile_klien_total');
                  $pengeluaran  = $i->reconcile->sum('reconcile_mti_total'); 
                }
              @endphp
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$r->invoice_kode}}</td>
                <td>Rp {{number_format($pendapatan,0,',','.')}}</td>
                <td>Rp {{number_format($pengeluaran,0,',','.')}}</td>
                <td>Rp {{number_format($pendapatan - $pengeluaran,0,',','.')}}</td>
              </tr>
              @php
                $total = $total + ($pendapatan - $pengeluaran);
              @endphp
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <th>Rp {{number_format($total,0,',','.')}}</th>
              </tr>
            </tfoot>
          </table>
          <div class="row">
            <div class="col-12">
              <strong>Jumlah Ritase :</strong> {{$k->sj->count()}}
            </div>
          </div>
          <hr>
        @endforeach
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