<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Levcorp | </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('panel.secciones.styles.css')
  @include('panel.dashboard.styles.css')
  @yield('css')
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
      <section class="content">
        @if(isset(Auth::user()->perfil->asignacionModulo))
        @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','4'))
        <div class="row">
          <div class="col-md-12">
            <!-- /.box -->
            @yield('opciones')
          </div>
        </div>
        @yield('body')
        @endif
        @endif

        <!-- /.row -->
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('panel.registros.usuarios.usuario')

    @include('panel.secciones.footer')

    <!-- Control Sidebar -->
    <!--code is here -->
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->
  <script src="{{asset('js/usuario.js')}}"></script>
  @include('panel.secciones.styles.js')
  @include('panel.dashboard.styles.js')
  @yield('script')
</body>

</html>
