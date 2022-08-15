<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Surat Jalan</title>

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
<body>
    <div class="container">
      <div class="row mb-2">
        <div class="col-md-3">
          <img class="img-fluid float-left" width="250px" src="{{asset('admin/dist/img/AdminLTELogo.png')}}" alt="">
        </div>
        <div class="col-md-9 mt-4 text-sm">
          <h2><strong>PT MARCOS TRANS INDONESIA</strong></h2>

          <small>Office  : Komplek Kranggan Permai Jl.Wijaya Kusuma Bs. 6 No. 13 jatisampurna, Bekasi</small><br>
          <small>Workshop: Jl Gemalapik No. 11 Pasir Sari Cikarang Selatan Bekasi</small><br>
          <small>Telp    : (021) 2867491 - 89532043 Fax. (021) 84992430 Website : www.marcostrans.com</small><br>
          <small>E-mail  : office@marcostrans.com/trans.marcos@yahoo.co.id</small><br>
        </div>
      </div>

      <div class="card border border-dark">
        <div class="row">
          <div class="col-md-12 mt-2">
            <h2 class="text-center"><strong>SURAT JALAN</strong></h2>
          </div>
        </div>
        <div class="card-body  ">

          <div class="row">
            <div class="col-md-6">
              <label for="">No.SJ</label>
              <p for="">{{$sj->surat_jalan_id}}</p>
            </div>
            <div class="col-md-6 text-right">
              <label for="">Jenis Kendaraan</label>
              <p for="">{{$sj->budget->jenis->jenis_kendaraan_nama}}</p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <label for="">No Polisi</label>
              <p>{{$sj->budget->kendaraan->kendaraan_nopol}}</p>
            </div>
            <div class="col-md-4">
              <label for="">Pengirim</label>
              <p>{{\Auth::user()->name}}</p>
            </div>
            <div class="col-md-5">
              <label for="">Penerima</label>
              <p>
                @foreach($sj->budget->bstore as $r)
                  {{$r->store->store_kode}},
                @endforeach
              </p>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3">
              <label for="">Driver</label>
              <p>{{$sj->budget->driver->driver_nama}}</p>
            </div>
            <div class="col-md-9">
              <table class="table table-bordered table-striped" id="example2" width="100%" cellspacing="0">
                <thead class="thead-dark">
                  <tr>
                    <th class="text-center" width="100px">Banyaknya</th>
                    <th class="text-center" width="250px">Nama Barang</th>
                    <th width="50px">Berat KG</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($sj->barang as $b)
                <tr>
                  <td>{{$b->sj_barang_banyak}}</td>
                  <td>{{$b->sj_barang_nama}}</td>
                  <td>{{$b->sj_barang_berat}}</td>
                </tr>
                @empty
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <div class="col-md-3 text-center">

            </div>
            <div class="col-md-3 text-center">
              <label for="">Pengirim</label>
              <p></p>
              <p>________________</p>
            </div>
            <div class="col-md-3 text-center">
              <label for="">Penerima</label>
              <p></p>
              <p>________________</p>
            </div>
            <div class="col-md-3 text-right">
              <label for="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, {{\Carbon\Carbon::parse($sj->budget->created_at)->format('d/m/Y')}}</label>
            </div>
          </div>
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
