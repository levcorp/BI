<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Levcorp | </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('panel.secciones.styles.css')
  @include('panel.dashboard.styles.css')
    @laravelPWA

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
      <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->
          @yield('opciones')
        </div>
      </div>
        @yield('boxes')
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            @yield('primero')
            <!-- /.box -->
          </div>

            <!-- DONUT CHART -->
          <div class="col-md-6">
            <!-- /.box -->
            @yield('segundo')
          </div>

          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            @yield('tercero')
            <!-- /.box -->
          </div>
          <div class="col-md-6">
            @yield('cuarto')
          </div>
            <div class="col-md-12">
            @yield('quinto')
          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->

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
  @include('panel.secciones.styles.js')
  @include('panel.dashboard.styles.js')
  @yield('script')
</body>
</html>
