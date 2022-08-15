@extends('layouts.admin.master')

@section('laporan-open','menu-open')

@section('laporan-active','active')

@section('laporan-gp','active')

@section('content')

  {{-- Content Header (Page header) --}}
  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Gross Profit Kontrak</h1>
      </div>
      <div class="col-sm-12">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="#">Laporan</a></li>
          <li class="breadcrumb-item active">Laporan Gross Profit Kontrak</li>
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
              <div class="card-header">
                Laporan Gross Profit Kontrak
              </div>
              <div class="card-body">
                <form action="{{route('laporan.gp.cetak')}}" method="post" target="_blank">@csrf

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label for="dari">Dari</label>
                        <input id="dari" class="form-control" type="date" name="dari">
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label for="ke">Ke</label>
                        <input id="ke" class="form-control" type="date" name="ke">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <button class="btn btn-primary" type="submit">Cetak</button>
                      </div>
                    </div>
                  </div>

                </form>
              </div>
            </div>
          </div>
          {{-- /.col --}}
        </div>
        {{-- /.row --}}
      </div>
      {{-- /.container-fluid --}}
    </section>
    {{-- /.content --}}

@endsection
