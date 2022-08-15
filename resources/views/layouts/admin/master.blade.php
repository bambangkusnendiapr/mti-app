<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>PT MARCOS TRANS INDONESIA</title> <link rel="icon" type="image/icon" href="{{ asset('images/MTI_logo.png') }}">
  {{-- Tell the browser to be responsive to screen width --}}
  <meta name="viewport" content="width=device-width, initial-scale=1">
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

  @stack('css')

</head>
<body class="hold-transition sidebar-mini text-sm layout-fixed layout-navbar-fixed">
{{-- Site wrapper --}}
<div class="wrapper">

    @include('layouts.admin.header')

    @include('layouts.admin.sidebar')


  {{-- Content Wrapper. Contains page content --}}
  <div class="content-wrapper">

    @yield('content')

  </div>
  {{-- /.content-wrapper --}}

    @include('layouts.admin.footer')

  {{-- Control Sidebar --}}
  <aside class="control-sidebar control-sidebar-dark">
    {{-- Control sidebar content goes here --}}
  </aside>
  {{-- /.control-sidebar --}}
</div>
{{-- ./wrapper --}}

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


@stack('js')

</body>
</html>
