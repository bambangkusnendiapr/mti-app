@extends('layouts.admin.master')

@section('menu-op','menu-open')

@section('op','active')

@section('po','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6 mb-2">
          <h1>Persetujuan Budget</h1>
        </div>
        {{-- <div class="col-sm-6">
          <a href="{{route('po.create')}}" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah PO</a>

        </div> --}}
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><a href="#">Operasional</a></li>
            <li class="breadcrumb-item active">Persetujuan Budget</li>
          </ol>
        </div>
      </div>
    </div>{{-- /.container-fluid --}}
  </section>

  {{-- Main content --}}
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-12">
          <div class="card">
            {{-- <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
              <a href="/tambahklien" class="btn btn-primary float-right"><span class="fa fa-plus"></span>Tambah Klien</a>
            </div> --}}
            {{-- /.card-header --}}
            <div class="card-body">
              <table id="example1" class="table table-striped text-nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Detail</th>
                  <th>Koreksi</th>
                  <th>ID Kontrak</th>
                  <th>ID PO</th>
                  <th>Tanggal PO</th>
                  <th>Jenis Kendaraan</th>
                  <th>Driver</th>
                  <th>Tarif</th>
                  <th>MDK</th>
                  <th>Koreksi</th>
                  <th>Jumlah</th>
                  <th>Uang Jalan</th>
                  <th>MDI</th>
                  <th>Koreksi</th>
                  <th>Jumlah Uang Jalan</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php
                  $koreksi1 = 0;
                  $ttarif   = 0;
                  $koreksi2 = 0;
                  $tuj      = 0; 
                @endphp
                @foreach($budget as $b)
                <tr>
                  <td class="text-right">{{$loop->iteration}}</td>
                  <td class="text-center"><a href="#" class="btn btn-xs btn-link" data-target="#info{{$b->budget_id}}" data-toggle="modal"><span class="fa fa-eye"></span></a></td>
                  <td class="text-center">
                    <a href="#" class="btn btn-xs btn-link" data-target="#koreksi{{$b->budget_id}}" data-toggle="modal"><span class="fa fa-edit"></span></a>
                  </td>
                  <td>{{$b->po->kontrak->kontrak_kode}}</td>
                  <td>{{$b->po->po_kode}}</td>
                  <td>{{\Carbon\Carbon::parse($b->po->updated_at)->format('Y-m-d')}}</td>
                  <td>{{$b->jenis->jenis_kendaraan_nama}}</td>
                  <td>{{$b->driver->driver_nama}}</td>
                  <td>Rp {{number_format($b->budget_tarif,0,',','.')}}</td>
                  <td>Rp {{number_format($b->budget_mdk,0,',','.')}}</td>
                  <td>
                    @php
                      foreach($b->koreksi as $k){
                        $koreksi1 = $koreksi1 + $k->koreksi_po_tarif;
                      }
                    @endphp
                    Rp {{number_format($koreksi1,0,',','.')}}</td>
                  </td>
                  <td>Rp {{number_format($b->budget_tarif + $b->budget_mdk + $koreksi1,0,',','.')}}</td>
                  <td>Rp {{number_format($b->budget_uang_jalan,0,',','.')}}</td>
                  <td>Rp {{number_format($b->budget_mdi,0,',','.')}}</td>
                  <td>
                    @php
                      foreach($b->koreksi as $k){
                        $koreksi2 = $koreksi2 + $k->koreksi_po_uang_jalan;
                      }
                    @endphp
                    Rp {{number_format($koreksi2,0,',','.')}}</td>
                  </td>
                  <td>Rp {{number_format($b->budget_uang_jalan + $b->budget_mdi + $koreksi2,0,',','.')}}</td>
                  <td>
                    @if($b->budget_status == null)
                      <span class="btn btn-xs btn-warning">Pengajuan</span>
                    @else
                      <span class="btn btn-xs btn-success">Disetujui</span>
                    @endif
                  </td>
                  <td class="text-center">
                    @if($b->budget_status == null)
                      {{-- <a href="{{route('persetujuanbudget.edit',$b->budget_id)}}" class="btn btn-xs btn-link" title="Edit"><span class="fa fa-edit" ></span></a> --}}
                      <a href="{{route('persetujuanbudget.setujui',$b->budget_id)}}" onclick="return confirm('Setelah disetujui data akan dikunci, lanjutkan?')" class="btn btn-xs btn-link" title="Budget"><span class="fa fa-check" ></span></a>
                    @endif
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            {{-- /.card-body --}}
          </div>
          {{-- /.card --}}
        </div>
        {{-- /.col --}}
      </div>
      {{-- /.row --}}
    </div>
    {{-- /.container-fluid --}}
  </section>
  {{-- /.content --}}

  <div class="modal fade" id="modal-hapus">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h4 class="modal-title">Peringatan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center text=danger">
          <h3>Apakah anda yakin ingin menghapus Surat Jalan <u><strong>SJ001</strong></u> ?</h3>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger">YA! Hapus Data</button>
        </div>
      </div>
      {{-- /.modal-content --}}
    </div>
    {{-- /.modal-dialog --}}
  </div>
  {{-- /.modal --}}

  @foreach($budget as $b)
    <div class="modal fade" id="koreksi{{$b->budget_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Koreksi Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body p-0">
            <table class="table table-striped">
              <thead>
                  <tr>
                    <td>No</td>
                    <td>Nama Koreksi</td>
                    <td>Tarif</td>
                    <td>Uang Jalan</td>
                    <td>Aksi</td>
                  </tr>
              </thead>
              <tbody>
              @foreach($b->koreksi as $r)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$r->koreksi->koreksi_nama}}</td>
                  <td>Rp {{number_format($r->koreksi_po_tarif,0,',','.')}}</td>
                  <td>Rp {{number_format($r->koreksi_po_uang_jalan,0,',','.')}}</td>
                  <td>
                    @if($b->budget_status == null)
                    <a href="#" class="btn btn-link btn-xs" data-target="#edit-koreksi{{$r->koreksi_po_id}}" data-toggle="modal"><span class="fa fa-edit"></span></a>&nbsp;
                    <a href="{{route('koreksipo.hapus',$r->koreksi_po_id)}}" class="btn btn-link btn-xs"><span class="fa fa-trash"></span></a>
                    @endif
                  </td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div>
          <div class="modal-footer justify-content-between">
            @if($b->budget_status == null)
            <a href="#" class="btn btn-primary btn-md" data-target="#tambah-koreksi{{$b->budget_id}}" data-toggle="modal"><span class="fa fa-plus"></span> Tambah Koreksi</a>
            @endif
          </div>
        </div>
        {{-- /.modal-content --}}
      </div>
      {{-- /.modal-dialog --}}
    </div>
    {{-- /.modal --}}
  @endforeach

  @foreach($budget as $b)
  <div class="modal fade" id="tambah-koreksi{{$b->budget_id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <form action="{{route('koreksipo.store')}}" method="post">@csrf

        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="my-modal-title">Tambah Koreksi</h5>
            <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="budget" value="{{$b->budget_id}}">

          <input type="hidden" name="po" value="{{$b->po->po_id}}">

          <input type="hidden" name="kontrak" value="{{$b->po->kontrak->kontrak_id}}">

          <div class="form-group">
            <label for="koreksi">Nama Koreksi</label>
            <select id="koreksi" class="form-control koreksi" name="koreksi">
              <option disabled selected>-- Pilih Koreksi --</option>
              @foreach($koreksi as $k)
                <option value="{{$k->koreksi_id}}">{{$k->koreksi_nama}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="tarif">Tarif</label>
            <input id="tarif" class="form-control tarif uang" type="text" name="tarif">
          </div>

          <div class="form-group">
            <label for="uang_jalan">Uang Jalan</label>
            <input id="uang_jalan" class="form-control uang_jalan uang" type="text" name="uang_jalan">
          </div>

          <button class="btn btn-primary float-right" type="submit">Tambah</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>

        </div>

        </form>

      </div>
    </div>
  </div>
  @endforeach

  @foreach($budget as $b)
  @foreach($b->koreksi as $r)
  <div class="modal fade" id="edit-koreksi{{$r->koreksi_po_id}}">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

        <form action="{{route('koreksipo.update',$r->koreksi_po_id)}}" method="post">@csrf @method('PUT')

        <div class="modal-header bg-primary">
            <h5 class="modal-title" id="my-modal-title">Tambah Koreksi</h5>
            <button class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

          {{-- <input type="hidden" name="budget" value="{{$b->budget_id}}">

          <input type="hidden" name="po" value="{{$b->po->po_id}}">

          <input type="hidden" name="kontrak" value="{{$b->po->kontrak->kontrak_id}}"> --}}

          <div class="form-group">
            <label for="koreksi">Nama Koreksi</label>
            <select id="koreksi" class="form-control koreksi" name="koreksi">
              <option disabled selected>-- Pilih Koreksi --</option>
              @foreach($koreksi as $k)
                <option value="{{$k->koreksi_id}}" {{$k->koreksi_id == $r->koreksi_id ? "selected" : ""}}>{{$k->koreksi_nama}}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="tarif">Tarif</label>
            <input id="tarif" class="form-control tarif uang" type="text" name="tarif" value="{{$r->koreksi_po_tarif}}">
          </div>

          <div class="form-group">
            <label for="uang_jalan">Uang Jalan</label>
            <input id="uang_jalan" class="form-control uang_jalan uang" type="text" name="uang_jalan" value="{{$r->koreksi_po_uang_jalan}}">
          </div>

          <button class="btn btn-primary float-right" type="submit">Ubah</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>

        </div>

        </form>

      </div>
    </div>
  </div>
  @endforeach
  @endforeach

  @foreach($budget as $b)
  @foreach($b->koreksi as $r)
    <div class="modal fade" id="edit-koreksi{{$r->koreksi_po_id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('koreksipo.update',$r->koreksi_po_id)}}" method="post"> @csrf @method('PUT')
          <div class="modal-header bg-primary">
            <h4 class="modal-title">Koreksi Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="koreksi">Nama Koreksi</label>
              <select id="koreksi" class="form-control koreksi1" name="koreksi">
                <option disabled selected>-- Pilih Koreksi --</option>
                @foreach($koreksi as $k)
                  <option value="{{$k->koreksi_id}}" {{$k->koreksi_id == $r->koreksi_id ? "selected" : "" }} >{{$k->koreksi_nama}}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label for="tarif">Tarif</label>
              <input id="tarif" class="form-control tarif1 uang" type="text" name="tarif" value="{{$r->koreksi_po_tarif}}">
            </div>

            <div class="form-group">
              <label for="uang_jalan">Uang Jalan</label>
              <input id="uang_jalan" class="form-control uang_jalan1 uang" type="text" name="uang_jalan" value="{{$r->koreksi_po_uang_jalan}}">
            </div>

            <input type="hidden" name="budget" value="{{$r->budget_id}}">

            <input type="hidden" name="po" value="{{$r->po_id}}">

            <input type="hidden" name="kontrak" value="{{$r->kontrak_id}}">

          </div>

          <div class="modal-footer justify-content-between">
            <button class="btn btn-primary " type="submit">Save</button>
            <button class="btn btn-danger float-right" type="button" data-dismiss="modal">Batal</button>
          </div>
          </form>
        </div>
        {{-- /.modal-content --}}
      </div>
      {{-- /.modal-dialog --}}
    </div>
    {{-- /.modal --}}
  @endforeach
  @endforeach

  @foreach($budget as $r)
  <div class="modal fade" id="info{{$r->budget_id}}">
    <div class="modal-lg modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h4 class="modal-title">{{$r->po->kontrak->kontrak_kode}} - {{$r->po->po_kode}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <div class="form-group row">
            <label for="tarif" class="col-md-6">Tarif</label>
            <input id="tarif" class="form-control-plaintext col-md-6" type="text" name="" value="Rp {{number_format($r->budget_tarif,0,',','.')}}" readonly>
          </div>

          <div class="form-group row">
            <label for="uj" class="col-md-6">Uang Jalan</label>
            <input id="uj" class="form-control-plaintext col-md-6" type="text" name="" value="Rp {{number_format($r->budget_uang_jalan,0,',','.')}}" readonly>
          </div>
          
          <hr/>

          <div class="row">
            <label for="" class="col-md-6">Daftar Store</label>
            <label for="" class="col-md-6 text-right">MDK Ke = {{$r->po->po_mdk_ke}}, MDi Ke = {{$r->po->po_mdi_ke}}</label>
          </div>

          <table class="table table-striped">
            <thead class="thead-dark">
              <tr>
                <th>No</th>
                <th>Store</th>
                <th>MDK</th>
                <th>MDI</th>
              </tr>
            </thead>
            <tbody>
              @foreach($r->bstore as $b)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$b->store->store_kode}}</td>
                <td>
                  @if($loop->iteration == $r->po->po_mdk_ke)
                    Rp {{number_format($r->po->po_mdk_dasar,0,',','.')}}
                  @elseif($loop->iteration > $r->po->po_mdk_ke)
                    Rp {{number_format($r->po->po_mdk_tambahan,0,',','.')}}
                  @else
                    Rp 0
                  @endif
                </td>
                <td>
                  @if($loop->iteration == $r->po->po_mdi_ke)
                    Rp {{number_format($r->po->po_mdi_dasar,0,',','.')}}
                  @elseif($loop->iteration > $r->po->po_mdi_ke)
                    Rp {{number_format($r->po->po_mdi_tambahan,0,',','.')}}
                  @else
                    Rp 0
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2">Jumlah</th>
                <th>
                  @if($r->budget_mdk != null)
                    Rp  {{number_format($r->budget_mdk,0,',','.')}}
                  @else
                    <p class="text-danger"> Tidak ada MD </p>
                  @endif
                </th>
                <th>
                  @if($r->budget_mdi != null)
                    Rp  {{number_format($r->budget_mdi,0,',','.')}}
                  @else
                    <p class="text-danger"> Tidak ada MD </p>
                  @endif
                </th>
              </tr>
            </tfoot>
          </table>

          <hr/>

          <label for="">Daftar Koreksi</label>
          <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                  <th>No</th>
                  <th>Nama Koreksi</th>
                  <th>Tarif</th>
                  <th>Uang Jalan</th>
                </tr>
            </thead>
            <tbody>
              @foreach($r->koreksi as $k)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$k->kmain->koreksi_nama}}</td>
                <td>Rp {{number_format($k->koreksi_po_tarif,0,',','.')}}</td>
                <td>Rp {{number_format($k->koreksi_po_uang_jalan,0,',','.')}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
        </div>
      </div>
      {{-- /.modal-content --}}
    </div>
    {{-- /.modal-dialog --}}
  </div>
  {{-- /.modal --}}
  @endforeach


@push('css')
  {{-- DataTables --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  {{-- Sweetalert --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endpush

@push('js')

{{-- DataTables --}}
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

{{-- page script --}}
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

{{-- Sweetalert --}}
<script src="{{asset('admin/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script>
  $(function(){

      const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
      });

      @if ($message = Session::get('success'))
      Toast.fire({
          icon: 'success',
          title: '{{$message}}'
      })
      @endif

      @if ($message = Session::get('warning'))
      Toast.fire({
          icon: 'warning',
          title: '{{$message}}'
      })
      @endif

      @if ($message = Session::get('error'))
      Toast.fire({
          icon: 'error',
          title: '{{$message}}'
      })
      @endif

  });
</script>

<script>
  $(document).ready(function(){
  
  // $('#modal-tambah').on('click',function(){
    $('.koreksi').on('change', function(e){
      var id = e.target.value;
      $.get('{{url('/koreksi/get')}}/'+id, function(data){
        $('.tarif').empty();
        $('.uang_jalan').empty();
        $('.tarif').val(data.koreksi_tarif);
        $('.uang_jalan').val(data.koreksi_uang_jalan);
      });
    });
  // )};

  });
</script>

{{-- Input mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.date').mask('00/00/0000');
    $('.uang').mask('000.000.000.000', {reverse: true});
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
  });
</script>

@endpush

@endsection
