<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Levcorp | </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('panel.registros.styles.css')
    @laravelPWA
  <style>
    [v-cloak] {
      display: none;
    }
  </style>
</head>
<body class="hold-transition skin-red sidebar-mini">
<!-- Site wrapper -->
  <div class="wrapper">

    @include('panel.secciones.header.header')

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    @include('panel.secciones.menu')

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
        @yield('titulo')
      </section> 

    <!-- Main content -->
      <section class="content" >
        @yield('contenido')
        <!-- /.row -->
        @include('panel.registros.usuarios.usuario')
      </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('panel.secciones.footer')

    <!-- Control Sidebar -->
    <!--code is here -->    
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
<!-- ./wrapper -->
@include('panel.registros.styles.js')
@yield('script')

</body>
</html>
