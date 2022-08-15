<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice MTI</title>

  {{-- Font Awesome --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  {{-- Ionicons --}}
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  {{-- overlayScrollbars --}}
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  {{-- Google Font: Source Sans Pro --}}
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  {{-- SweetAlert2 --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">

  {{-- DataTables --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
</head>
<body class="text-xs">

    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <img class="img-fluid float-right" width="250px" src="{{asset('MTI_Logo.png')}}" alt="">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger">
                        Sold To
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$invoice->kontrak->kontrak_klien_nama}}</h5>
                        <p class="card-text">{{$invoice->kontrak->kontrak_klien_alamat}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary">
                        Seller
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">PT.MARCOS TRANS INDONESIA</h5>
                        <p class="card-text">jl.WIJAYA KUSUMA</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">INVOICE</h1>
                <h2 class="text-center">{{$invoice->invoice_kode}}</h2>
            </div>
        </div>
        <div class="card mb-5">
            <div class="card-body p-0">
                <table class="table">
                    <thead>
                        <th>No</th>
                        <th>No. Surat Jalan</th>
                        <th>Tanggal</th>
                        <th>Tipe Mobil</th>
                        <th>Nopol</th>
                        <th>Store</th>
                        <th>MDK Ke</th>
                        <th>MDK Total</th>
                        <th></th>
                        <th>Harga</th>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($invoice->detail as $r)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                @if($r->reconcile->reconcile_sj == null)
                                    {{$r->reconcile->sj->surat_jalan_id}}
                                @else
                                    {{$r->reconcile->reconcile_sj}}
                                @endif
                            </td>
                            <td>{{$r->created_at}}</td>
                            <td>{{$r->reconcile->sj->budget->jenis->jenis_kendaraan_nama}}</td>
                            <td>{{$r->reconcile->sj->budget->kendaraan->kendaraan_nopol}}</td>
                            <td>
                              @foreach($r->reconcile->sj->budget->bstore as $store)
                                {{$store->store->store_kode}}
                              @endforeach
                            </td>
                            <td>{{$invoice->kontrak->kontrak_mdk_ke}}</td>
                            <td>Rp {{number_format($r->reconcile_mdk,0,',','.')}}</td>
                            <td></td>
                            <td>Rp {{number_format($r->reconcile->reconcile_klien_total,0,',','.')}}</td>
                        </tr>
                        @php $total = $total + $r->reconcile->reconcile_klien_total; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                       <tr>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th></th>
                           <th colspan="5" class="text-right">Total Harga</th>
                           <td>Rp {{number_format($total,0,',','.')}}</td>
                        </tr>
                        @php
                            $diskon = ($total * $invoice->kontrak->kontrak_pajak) / 100;
                        @endphp
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="5" class="text-right">ppn {{$invoice->kontrak->kontrak_pajak}}%</th>
                            <td>Rp {{number_format($diskon,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="5" class="text-right">Grand Total</th>
                            <td>Rp {{number_format($total + $diskon,0,',','.')}}</td>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                <p class="mb-5">
                    <b>
                        {{$invoice->karyawan->karyawan_kota}}, {{$invoice->invoice_tanggal}}
                    </b>
                </p>
                <p class="">{{$invoice->karyawan->karyawan_nama}}<p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-left">
                <p class="">
                    <b>
                        BANK MANDIRI
                    </b>
                </p>
                <p class="">A/N: PT MARCOS TRANS INDONESIA<p>
                <p class="">A/C: 167xxxxxxx<p>
            </div>
        </div>


    </div>



{{-- jQuery --}}
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
{{-- Bootstrap 4 --}}
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{-- AdminLTE App --}}
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
{{-- AdminLTE for demo purposes --}}
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
{{-- SweetAlert2 --}}
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>

<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>



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
            "lengthChange": true,
            "searching": true,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>
</body>
</html>
