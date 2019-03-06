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

<body class="hold-transition skin-blue sidebar-mini">
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
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="nav-icon fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
        <li><a href="#"><i class="fas fa-user"></i> <span>Profile</span></a></li>
        <li><a href="#"><i class="fas fa-key"></i></i> <span>Şifre İşlemleri</span></a></li>
        <li>
            <a  href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </a>
            </a>
        </li>
        <li class="treeview">
          <a href="#"><i class="nav-icon fa fa-th"></i> <span>Yönetim</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fas fa-users nav-icon"></i> Kullanıcılar</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
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
    <strong>Copyright &copy; 2019 <a href="#">Yargıtay Web & Tasarım </a>.</strong> All rights reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>