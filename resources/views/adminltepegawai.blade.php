<!DOCTYPE html>
<html>
<head>
  @include('template.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  @include('template.header')
  <!-- Left side column. contains the logo and sidebar -->
  @include('template.main-sidebarpegawai')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   @yield('content')
    <!-- /.content -->
  </div> 
  <!-- /.content-wrapper -->
  @include('template.footer')

<!-- ./wrapper -->

<!-- jQuery 3 -->
  @include('template.script')
</body>
</html>
