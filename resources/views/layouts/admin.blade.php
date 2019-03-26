<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Yargıtay Anket </title>

  <link rel="stylesheet" type="text/css" href="/css/app.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper" id="app">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Anket</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Ön Büro </b>Anket</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" data-toggle="push-menu" role="button" style="color: white">
        <i class="fas fa-angle-left"></i><i class="fas fa-angle-right"></i>
      </a>

      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
      
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="float-left image">
          <img src="/images/profile.png" class="img-circle" alt="User Image">
        </div>
        <div class="float-left info">
          <p>{{ Auth::user()->name }}</p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">USER MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{ url('/home') }}"><i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
        <li><a href="{{ route('profile') }}"><i class="fas fa-user"></i> <span>Profile</span></a></li>
        <li>
            <a  href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
        @if(Auth::user()->hasRole('Admin')) 
          <li class="header">ADMIN MENU</li>
          <li><a href="{{ route('admin.users') }}"><i class="nav-icon fas fa-users"></i> <span>Kullanıcılar</span></a></li>

          <li class="header">ANKET MENU</li>
          <li><a href="{{ route('admin.ankets') }}"><i class="nav-icon fas fa-poll"></i> <span>Anketler</span></a></li>
        @endif
        @if(Auth::user()->hasRole('Analytics')) 
          <li class="header">ANALYTICS MENU</li>
          <li><a href="{{ route('analytics.surveylist') }}"><i class="nav-icon fas fa-poll"></i> <span>Anketler</span></a></li>
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
    </div>
    @endif


    @if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
            <strong>{{ $message }}</strong>
    </div>
    @endif

    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Yargıtay Ön Büro Anketi
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019 Yargıtay Web & Tasarım.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<script type="text/javascript" src="/js/app.js"></script>
@yield('scripts')
</body>
</html>