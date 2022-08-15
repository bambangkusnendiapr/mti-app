@extends('layouts.admin.master')



@section('akuntansi-menu','menu-open')



@section('akuntansi-active','active')



@section('siklus-menu','menu-open')



@section('siklus-active','active')



@section('posting','active')



@section('content')



<!-- Content Header (Page header) -->

<section class="content-header">

  <div class="container-fluid">

  <div class="row mb-2">

    <div class="col-sm-6 mb-2">

    <h1>Jurnal</h1>

    </div>

    <div class="col-sm-6">

    <a href="#" data-target="#modal-tambah"  data-toggle="modal" class="btn btn-primary btn-sm float-right"><span class="fa fa-plus">&nbsp;</span>Tambah Jurnal</a>

    </div>

    <div class="col-sm-12">

    <ol class="breadcrumb float-sm-left">

      <li class="breadcrumb-item"><a href="#">Akuntansi</a></li>

      <li class="breadcrumb-item active">Jurnal</li>

    </ol>

    </div>

  </div>

  </div><!-- /.container-fluid -->

</section>



<!-- Main content -->

<section class="content">

  <div class="container-fluid">

    <div class="col-12">

    <div class="card">

        <!-- /.card-header -->

        <div class="card-body">

            <button type="button"  class="btn btn-md btn-success" data-target="#modal-bb" data-toggle="modal">Buku Besar</button>

            <button type="button"  class="btn btn-md btn-success" data-target="#modal-lr" data-toggle="modal">Laba Rugi</button>

            <button type="button"  class="btn btn-md btn-success" data-target="#modal-neraca" data-toggle="modal">Neraca</button>

            <button type="button"  class="btn btn-md btn-success" data-target="#modal-cf" data-toggle="modal">Cash Flow</button>
            
            <button type="button"  class="btn btn-md btn-success" data-target="#modal-buku-besar-export" data-toggle="modal">Buku Besar Excel</button>
            
            <button type="button"  class="btn btn-md btn-success" data-target="#modal-laba-rugi-export" data-toggle="modal">Laba Rugi Excel</button>

        </div>

        <!-- /.card-body -->

    </div>

    <!-- /.card -->

    <div class="card">

      <!-- /.card-header -->

      <div class="card-body">

        @if (count($errors) > 0)

        <div class="alert alert-danger">

            <ul>

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <div class="row">
          <div class="col-md-6">
            <form action="{{ route('posting.index') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari Uraian / Keterangan">
                <span class="input-group-append">
                  <button type="submit" class="btn btn-info btn-flat">Cari</button>
                </span>
              </div>
            </form>
          </div>
        </div>

      <table class="table table-bordered table-striped text-nowrap mt-3"  width="100%">

        <thead>

        <tr>

          <th>#</th>

          <th>Tanggal</th>
          
          <th>Tanggal Dibuat</th>

          <th>Uraian</th>

          <th>Keterangan</th>

          <th>Transaksi</th>

          <th>Aksi</th>

        </tr>

        </thead>

        <tbody>

        @foreach ($posting as $key => $p)

        <tr>

          <td>{{ $posting->firstItem() + $key }}</td>

          <td>{{ $p->tanggal }}</td>
          
          <td>{{ $p->created_at }}</td>

          <td>{{ $p->uraian }}</td>

          <td>{{ $p->keterangan }}</td>

          <td class="text-center">

              <button class="btn btn-link btn-xs" data-target="#modal-view-transaksi{{$p->id}}" data-toggle="modal"><i class="fas fa-eye"></i></button>

              <button class="btn btn-link btn-xs" data-target="#modal-transaksi{{$p->id}}" data-toggle="modal"><i class="fas fa-plus"></i></button>

          </td>

          <td class="text-center">

          <button class="btn btn-link btn-xs" data-target="#modal-edit{{$p->id}}" data-toggle="modal"><i class="fas fa-edit"></i></button>

          <a href="{{ route('posting.hapus',$p->id)}}" class="btn btn-link btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')"><i class="fas fa-trash"></i></a>

          

          </td>

        </tr>

        @endforeach

        </tbody>

        </table>

        <div class="d-flex justify-content-center mt-3">
          {{ $posting->links() }}
        </div>

      </div>

      <!-- /.card-body -->

    </div>

    <!-- /.card -->

    </div>

    <!-- /.col -->

  </div>

  <!-- /.row -->

  </div>

  <!-- /.container-fluid -->

</section>

<!-- /.content -->



<div class="modal fade" id="modal-tambah">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="modal-header bg-primary">

			  <h4 class="modal-title">Tambah Jurnal</h4>

			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

				  <span aria-hidden="true">&times;</span>

			  </button>

			</div>

			<div class="modal-body">

        <form action="{{ route('posting.store')}}" method="POST">

          @csrf

				  <div class="form-group">

            <label for="exampleInputEmail1">Tanggal</label>

            <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal">

				  </div>

				  <div class="form-group">

            <label for="exampleInputPassword1">Uraian</label>

            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Uraian" name="uraian" >

				  </div>

				  <div class="form-group">

            <label for="exampleInputEmail1">Keterangan</label>

            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" name="keterangan" >

				  </div>

			</div>

			<div class="modal-footer justify-content-between">

			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

            <button type="submit" class="btn btn-primary">Simpan Data</button>

        </form>

			</div>

		</div>

		<!-- /.modal-content -->

	</div>

	<!-- /.modal-dialog -->

</div>

<!-- /.modal -->



@foreach ($posting as $p)

<div class="modal fade" id="modal-edit{{$p->id}}">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="modal-header bg-primary">

			  <h4 class="modal-title">Edit Jurnal</h4>

			  <button type="button" class="close" data-dismiss="modal" aria-label="Close">

				  <span aria-hidden="true">&times;</span>

			  </button>

			</div>

			<div class="modal-body">

        <form action="{{ route('posting.update',$p->id)}}" method="POST">

          @csrf @method('PUT')
          <input type="hidden" name="search" id="" value="{{ request('search') }}">
          <input type="hidden" name="page" id="" value="{{ request('page') }}">

				  <div class="form-group">

            <label for="exampleInputEmail1">Tanggal</label>

            <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal" value="{{$p->tanggal}}">

				  </div>

				  <div class="form-group">

            <label for="exampleInputPassword1">Uraian</label>

            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Uraian" name="uraian" value="{{$p->uraian}}">

				  </div>

				  <div class="form-group">

            <label for="exampleInputEmail1">Keterangan</label>

            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" name="keterangan" value="{{$p->keterangan}}">

				  </div>

			</div>

			<div class="modal-footer justify-content-between">

			<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

            <button type="submit" class="btn btn-primary">Edit Data</button>

        </form>

			</div>

		</div>

		<!-- /.modal-content -->

	</div>

	<!-- /.modal-dialog -->

</div>

<!-- /.modal -->

@endforeach



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

		<!-- /.modal-content -->

	</div>

	<!-- /.modal-dialog -->

</div>

<!-- /.modal -->



@foreach ($posting as $p)

<div class="modal fade" id="modal-transaksi{{$p->id}}">

	<div class="modal-dialog modal-lg">

		<div class="modal-content">

			<div class="modal-header bg-primary">

			  <h4 class="modal-title">Tambah Transaksi</h4>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

			</div>

			<div class="modal-body p-0">

                <form action="{{ route('transaksi.store')}}" method="POST">

                @csrf



                <input type="hidden" name="id_posting" value="{{ $p->id }}">

                <input type="hidden" name="tanggal" value="{{ $p->tanggal }}">

        <table class="table table-bordered" style="width: 100%">

					<tr class="bg-secondary">

					  <th>Akun</th>

					  <th>Debet</th>

					  <th>Kredit</th>

					</tr>

					<tr>

					  <td>

                        <div class="form-group">

                            <select id="kd_1" class="form-control" style="width: 100%;" name="kode_akun_1" required>

                                <option disabled selected>--- Pilih Kode Akun ---</option>

                            @foreach ($ka as $k)

                                <option value="{{ $k->id }}">{{ $k->kode_akun }} || {{ $k->nama_akun }}</option>

                            @endforeach

                            </select>

                        </div>

					  </td>

					  <td>

                        <input type="text" class="form-control uang debit" id="debit{{$p->id}}" name="debet_1" required>

					  </td>

					  <td>

						  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="0" name="kredit_1" value="0" readonly>

					  </td>

					</tr>

					<tr>

					  <td>

                        <div class="form-group">

                            <select class="form-control" id="kd_2" style="width: 100%;" name="kode_akun_2" required>

                                <option disabled selected>--- Pilih Kode Akun ---</option>

                                @foreach ($ka as $k)

                                <option value="{{ $k->id }}">{{ $k->kode_akun }} || {{ $k->nama_akun }}</option>

                                @endforeach

                            </select>

                        </div>

					  </td>

					  <td>

						  <input type="text" class="form-control" id="exampleInputPassword1" placeholder="0" name="debet_2" value="0" readonly>

					  </td>

					  <td>

						  <input type="text" class="form-control uang kredit" id="kredit{{$p->id}}" name="kredit_2" required>

					  </td>

					</tr>

				  </table>

			</div>

			<div class="modal-footer justify-content-between">

			  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>

              <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Yakin Ingin Menyimpan Data?')">Simpan Transaksi</button>

            </form>

			</div>

		</div>

		<!-- /.modal-content -->

	</div>

  <!-- /.modal-dialog -->

</div>

<!-- /.modal -->

@endforeach





@foreach ($posting as $p)

<div class="modal fade" id="modal-view-transaksi{{$p->id}}">

		<div class="modal-dialog modal-lg">

		  <div class="modal-content">

        <div class="modal-header bg-primary">

          <h4 class="modal-title">View Transaksi</h4>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

        </div>

        <div class="modal-body p-0">

          <table class="table table-striped text-nowrap">

            <thead>

              <tr>

                <th>Kode Akun</th>

                <th>Nama Akun</th>

                <th>Debet</th>

                <th>Kredit</th>

                <th>Aksi</th>

              </tr>

            </thead>

            <tbody>

                @foreach ($p->transaksi as $t)

                <tr>

                    <td>{{ $t->akun->kode_akun}}</td>

                    <td>{{ $t->akun->nama_akun }}</td>

                    <td>{{ number_format($t->debet,0,',','.') }}</td>

                    <td>{{ number_format($t->kredit,0,',','.') }}</td>

                    <td><a href="{{ route('transaksi.hapus',$t->id)}}" class="btn btn-link btn-xs" onclick="return confirm('Apakah Yakin Ingin Menghapus Data?')"><i class="fas fa-trash"></i></a></td>

                </tr>

                @endforeach

            </tbody>

          </table>

        </div>

        <div class="modal-footer justify-content-between">



        </div>

		  </div>

		  <!-- /.modal-content -->

		</div>

		<!-- /.modal-dialog -->

	</div>

	  <!-- /.modal -->

@endforeach





<div id="modal-bb" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h4 class="modal-title">Buku Besar</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

            <div class="modal-body">

                <form action="{{route('buku-besar.view')}}" method="POST" target="_blank">

                    @csrf

                    <div class="form-group">

                        <label for="tgl1">Tanggal</label>

                        <div class="row">

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>

                            </div>

                            <div class="col-2 text-center">

                                S/D

                            </div>

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Buku Besar ?')">Cetak</button>

                </form>

            </div>

        </div>

    </div>

</div>



<div id="modal-lr" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h4 class="modal-title">Laba Rugi</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

            <div class="modal-body">

                <form action="{{route('laba-rugi.view')}}" method="POST" target="_blank">

                    @csrf

                    <div class="form-group">

                        <label for="tgl1">Tanggal</label>

                        <div class="row">

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>

                            </div>

                            <div class="col-2 text-center">

                                S/D

                            </div>

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Laba Rugi ?')">Cetak</button>

                </form>

            </div>

        </div>

    </div>

</div>



<div id="modal-neraca" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h4 class="modal-title">Neraca</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

            <div class="modal-body">

                <form action="{{route('neraca.view')}}" method="POST" target="_blank">

                    @csrf

                    <div class="form-group">

                        <label for="tgl1">Tanggal</label>

                        <div class="row">

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>

                            </div>

                            <div class="col-2 text-center">

                                S/D

                            </div>

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Neraca ?')">Cetak</button>

                </form>

            </div>

        </div>

    </div>

</div>



<div id="modal-cf" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h4 class="modal-title">Cash Flow</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

            <div class="modal-body">

                <form action="{{route('cash-flow.view')}}" method="POST" target="_blank">

                    @csrf

                    <div class="form-group">

                        <label for="tgl1">Tanggal</label>

                        <div class="row">

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>

                            </div>

                            <div class="col-2 text-center">

                                S/D

                            </div>

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Cetak Cash Flow ?')">Cetak</button>

                </form>

            </div>

        </div>

    </div>

</div>

<div id="modal-buku-besar-export" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h4 class="modal-title">Buku Besar Export Excel</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

            <div class="modal-body">

                <form action="{{route('buku.besar.export')}}" method="POST" target="_blank">

                    @csrf

                    <div class="form-group">

                        <label for="tgl1">Tanggal</label>

                        <div class="row">

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>

                            </div>

                            <div class="col-2 text-center">

                                S/D

                            </div>

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Export Excel Buku Besar ?')">Ya</button>

                </form>

            </div>

        </div>

    </div>

</div>

<div id="modal-laba-rugi-export" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header bg-primary">

                <h4 class="modal-title">Laba Rugi Export Excel</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

            <div class="modal-body">

                <form action="{{route('laba.rugi.export')}}" method="POST" target="_blank">

                    @csrf

                    <div class="form-group">

                        <label for="tgl1">Tanggal</label>

                        <div class="row">

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl1" required>

                            </div>

                            <div class="col-2 text-center">

                                S/D

                            </div>

                            <div class="col-5">

                                <input id="tgl1" class="form-control" type="date" name="tgl2" required>

                            </div>

                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary float-right" onclick="return confirm('Anda Yakin Ingin Export Excel Laba Rugi ?')">Ya</button>

                </form>

            </div>

        </div>

    </div>

</div>



@push('css')

  <!-- DataTables -->

  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

	<!-- Select2 -->

	<link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}">

	<link rel="stylesheet" href="{{asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

@endpush



@push('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<!-- DataTables -->

<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>

<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Select2 -->

<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- page script -->

{{-- <script>

	function sync()

	{

	  var kredit = document.getElementById('kredit');

	  var debit = document.getElementById('debit');

	  kredit.value = debit.value;

	}

</script> --}}







<script type="text/javascript">

    $(document).ready(function(){

      $('.date').mask('00/00/0000');

      $('.uang').mask('000.000.000.000', {reverse: true});

      $('.time').mask('00:00:00');

      $('.date_time').mask('00/00/0000 00:00:00');

     });

</script>



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

	//Initialize Select2 Elements

	$('.select2').select2();



	//Initialize Select2 Elements

	$('.select2bs4').select2({

	  theme: 'bootstrap4'

	});

	

	$('#kd_1').select2({

	  theme: 'bootstrap4'

	});

	

	$('#kd_2').select2({

	  theme: 'bootstrap4'

	});



	var $debit = $(".debit");



	$(".kredit").keyup(function() {

		$debit.val( this.value );

	});

	var $kredit = $(".kredit");



	$(".debit").keyup(function() {

		$kredit.val( this.value );

	});





  });



</script>

@endpush



@endsection

