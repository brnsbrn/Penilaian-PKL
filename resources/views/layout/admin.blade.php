<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="{{ asset('logo_favi.ico') }}" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <<title>
    @hasSection('title')
        @yield('title')
    @endif
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.cs') }}s">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
  @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand" style="background-color: #5c7ebd">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #ffffff"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" >
        <a class="nav-link" style="color: #ffffff">Selamat datang di halaman  {{ session('peran')}}</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <a href='/logout'><button type="button" class="btn btn-primary center" style="background-color: #d5ac51"><i class="fa-solid fa-right-from-bracket"></i>  Logout</button></a>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4" style="background-color: #fff">
    <!-- Brand Logo -->
    <a class="brand-link">
      <img src="{{asset('img/logo_favi-removebg-preview.png')}}" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light" style="color: #5c7ebd"><b>Penilaian PKL</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        </div>
        <div class="info">
          <a href="#" class="d-block" style="color: #5c7ebd"> {{ session('nama') }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/admin/dashboard" class="nav-link">
              <i class="nav-icon fas fa-book" style="color: #5c7ebd"></i>
              <p style="color: #5c7ebd">
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/datauser" class="nav-link">
              <i class="nav-icon far fa-plus-square" style="color: #5c7ebd"></i>
              <p style="color: #5c7ebd">
                Data User
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/datasekolah" class="nav-link">
              <i class="nav-icon far fa-plus-square" style="color: #5c7ebd"></i>
              <p style="color: #5c7ebd">
                Data Sekolah
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer" style="background-color: #5c7ebd">
    <strong style="color:#ffffff">Copyright &copy; 2014-2021 <a href="https://adminlte.io" style="color:#ffffff">AdminLTE.io All rights reserved.</a>.</strong>
    
    <div class="float-right d-none d-sm-inline-block">
      <b style="color:#ffffff">Version 3.2.0</b> 
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('template/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('template/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('template/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('template/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('template/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('template/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('template/dist/js/pages/dashboard2.js')}}"></script>

{{-- Script for fontawesome-free --}}
<script src="https://kit.fontawesome.com/03fdf8347a.js" crossorigin="anonymous"></script>

@stack('scripts')

</body>
</html>
