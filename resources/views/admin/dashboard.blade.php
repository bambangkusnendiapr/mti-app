@extends('layouts.admin.master')

@section('dashboard', 'active')

@section('content')

@role('owner|admin|manager|lord')

{{-- Content Header (Page header) --}}
<section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Dashboard</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="#">Home</a></li>
           <li class="breadcrumb-item active">Dashboard</li>
         </ol>
       </div>
     </div>
   </div>{{-- /.container-fluid --}}
 </section>

 {{-- Main content --}}
 <section class="content">

  {{-- Small boxes (Stat box) --}}
  <div class="row">
    <div class="col-lg-3 col-6">
      {{-- small box --}}
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$kontrak->count()}}</h3>
          <p>Kontrak</p>
        </div>
        <div class="icon">
          <i class="fas fa-file"></i>
        </div>
        <a href="{{route('kontrak.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    {{-- ./col --}}
    <div class="col-lg-3 col-6">
      {{-- small box --}}
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$sj->count()}}</h3>
          <p>Ritase</p>
        </div>
        <div class="icon">
          <i class="fas fa-paper-plane"></i>
        </div>
        <a href="{{route('suratjalan.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    {{-- ./col --}}

    @php $pendapatan2 = 0; $total2 = 0; @endphp
    
    @foreach($kontrak as $k)

      @foreach($invoice->where('kontrak_id',$k->kontrak_id)->where('invoice_status','!=',1) as $r)

        @php
          foreach($r->detail as $i){
            $pendapatan2   = $i->reconcile->sum('reconcile_klien_total');
          }
          $total2 += $pendapatan2 - $r->payment->sum('payment_bayar');
        @endphp

      @endforeach

    @endforeach
   
    <div class="col-lg-3 col-6">
      {{-- small box --}}
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>Rp {{number_format($total2 / 1000000,1,',','.')}} Juta</h3>
          <p>Account Receiveable</p>
        </div>
        <div class="icon">
          <i class="fas fa-dollar-sign"></i>
        </div>
        <a href="{{route('invoice.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    {{-- ./col --}}


    @php
        $tap1 = 0; $lsisa1 = 0; $lbayar1 = 0; $count1 = 0;
    @endphp

    @foreach($leasing as $r)
      @php
        $count1    = $r->payment->count();
        $lbayar1   += $count1 * $r->kendaraan->kendaraan_angsuran;
        $lsisa1    += ( $r->kendaraan->kendaraan_jangka_sisa - $count1 ) * $r->kendaraan->kendaraan_angsuran;
      @endphp
    @endforeach

    @foreach($partner as $p1)
      @php $jumlah1 = 0; $total1 = 0; $ap = 0; @endphp
      @foreach ($p1->ap as $ap1)
        @php
          $jumlah1 += $ap1->payment->sum('payment_partner_jumlah');
          $total1  = $p1->ap->sum('purchasing_jumlah') - $jumlah1;
          $tap1    += $total1;
        @endphp
      @endforeach
    @endforeach

    @php
      $ap = ($tap1 + $lsisa1) / 1000000;
    @endphp

    <div class="col-lg-3 col-6">
      {{-- small box --}}
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>Rp {{number_format((float)$ap,1,',','.')}} Juta</h3>
          <p>Account Payable</p>
        </div>
        <div class="icon">
          <i class="fas fa-money-check"></i>
        </div>
        <a href="#" class="small-box-footer">&nbsp;</a>
      </div>
    </div>
    {{-- ./col --}}
  </div>
  {{-- /.row --}}
  
  <div class="row">
    {{-- Gross Profit --}}
    <div class="col-6">
      {{-- Default box --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Gross Profit</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-valign-middle text-nowrap">
            <thead>
            <tr>
              <th>Kontrak</th>
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
                <td>{{$k->kontrak_kode}}</td>
                <td>Rp {{number_format($pendapatan,0,',','.')}}</td>
                <td>Rp {{number_format($pengeluaran,0,',','.')}}</td>
                <td>Rp {{number_format($total,0,',','.')}}</td>
              </tr>

            @endforeach
            </tbody>
          </table>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>
    {{-- /.col-6 Gross Profit --}}

    {{-- Ritase --}}
    <div class="col-6">
      {{-- Default box --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Ritase</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-valign-middle text-nowrap">
            <thead>
            <tr>
              <th>Kontrak</th>
              <th>Jumlah</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($kontrak as $k)

              <tr>
                <td>{{$k->kontrak_kode}}</td>
                <td>{{$sj->where('kontrak_id',$k->kontrak_id)->count()}}</td>
              </tr>

            @endforeach
            </tbody>
          </table>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>
    {{-- /.col-6 Ritase --}}
  </div>
  {{-- /.row --}}

  <div class="row">
    {{-- Account Receiveable --}}
    <div class="col-6">
      {{-- Default box --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Account Receiveable</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-valign-middle text-nowrap">
            <thead>
            <tr>
              <th>Kontrak</th>
              <th>Kode Invoice</th>
              <th>Total Belum Bayar</th>
              <th>Usia Invoice</th>
            </tr>
            </thead>
            <tbody>
            
            @foreach($kontrak as $k)

              @php $pendapatan = 0; $pengeluaran = 0; $total = 0; @endphp
              
              @foreach($invoice->where('kontrak_id',$k->kontrak_id)->where('invoice_status','!=',1) as $r)

                @php
                  foreach($r->detail as $i){
                    $pendapatan   = $i->reconcile->sum('reconcile_klien_total');
                  }
                @endphp
              
              <tr>
                <td>{{$k->kontrak_kode}}</td>
                <td>{{$r->invoice_kode}}</td>
                <td>Rp {{number_format($pendapatan - $r->payment->sum('payment_bayar'),0,',','.')}}</td>
                <td>{{\Carbon\Carbon::createFromDate($r->invoice_tanggal)->diffForHumans()}}</td>
              </tr>
              @endforeach

            @endforeach
            </tbody>
          </table>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>
    {{-- /.col-6 Account Receiveable --}}

    {{-- Account Payable --}}
    <div class="col-6">
      {{-- Default box --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Account Payable</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
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
                $count    = $r->payment->count();
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
              @foreach ($p->ap as $ap)
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
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>
    {{-- /.col-6 Account Payable --}}
  </div>
  {{-- /. row --}}

  <div class="row">
    {{-- Surat Jalan  --}}
    <div class="col-6">
      {{-- Default box --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Laporan Surat Jalan</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
          <table class="table table-striped table-valign-middle text-nowrap">
            <thead>
            <tr>
              <th>Kontrak</th>
              <th>Surat Jalan Terbit</th>
              <th>Surat Jalan Reconcile</th>
              <th>Surat Jalan Belum Kembali</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($kontrak as $r)
              <tr>
                <td>{{$r->kontrak_kode}}</td>
                <td>{{$sj->where('kontrak_id',$k->kontrak_id)->count()}}</td>
                <td>{{$sj->where('kontrak_id',$k->kontrak_id)->where('surat_jalan_status','3')->count()}}</td>
                <td>{{$sj->where('kontrak_id',$k->kontrak_id)->where('surat_jalan_status','!=','3')->count()}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>

    {{-- Gross Profit by Armada  --}}
    <div class="col-6">
      {{-- Default box --}}
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Laporan Gross Profit by Armada</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body table-responsive">
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
                <td>Rp {{number_format($gp,0,',','.')}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        {{-- /.card-body --}}
      </div>
      {{-- /.card --}}
    </div>
  </div>

 </section>
 {{-- /.content --}}

@push('css')
  {{-- DataTables --}}
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
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
          "scrollX": true
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": false,

      });
    });
  </script>

@endpush

@endrole

@endsection
